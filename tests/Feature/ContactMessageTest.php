<?php

use App\Models\ContactMessage;
use App\Models\Admin;
use App\Models\ContactPage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Seed Spatie permissions checked in views/middleware to prevent PermissionDoesNotExist exception
    foreach ([
        'dashboard.view', 
        'forms.view', 
        'tables.view', 
        'users.view', 
        'cars.view', 
        'rides.view', 
        'bookings.view', 
        'roles.view', 
        'permissions.view',
        'contact.view',
        'contact.delete'
    ] as $permission) {
        Permission::findOrCreate($permission, 'web');
    }

    // Create an Admin user for auth
    $this->admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin_test@example.com',
        'password' => bcrypt('password'),
    ]);

    // Assign permissions to the admin user directly to pass Spatie middleware checks
    $this->admin->givePermissionTo('contact.view', 'contact.delete');
});

test('visitors can view contact page', function () {
    ContactPage::create([
        'hero_title' => 'Contact Us',
    ]);

    $response = $this->get(route('contact'));
    $response->assertStatus(200);
});

test('visitors can submit contact message', function () {
    $response = $this->post(route('contact.store'), [
        'name'    => 'John Doe',
        'email'   => 'john@example.com',
        'subject' => 'Rent inquiry',
        'message' => 'Hello, I want to rent a car.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('contact_messages', [
        'name'    => 'John Doe',
        'email'   => 'john@example.com',
        'subject' => 'Rent inquiry',
        'message' => 'Hello, I want to rent a car.',
    ]);
});

test('submitting contact form with invalid inputs fails validation', function () {
    $response = $this->post(route('contact.store'), [
        'name'    => '',
        'email'   => 'invalid-email',
        'subject' => '',
        'message' => 'hello',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'subject']);
    $this->assertDatabaseCount('contact_messages', 0);
});

test('admin can view contact messages listing', function () {
    $this->actingAs($this->admin, 'admin');

    ContactMessage::create([
        'name'    => 'Jane Smith',
        'email'   => 'jane@example.com',
        'subject' => 'Support',
        'message' => 'Need help',
    ]);

    $response = $this->get(route('contact-messages.index'));
    $response->assertStatus(200);
    $response->assertSee('Jane Smith');
    $response->assertSee('Support');
});

test('admin can read a contact message details', function () {
    $this->actingAs($this->admin, 'admin');

    $msg = ContactMessage::create([
        'name'    => 'Jane Smith',
        'email'   => 'jane@example.com',
        'subject' => 'Support',
        'message' => 'Need help',
    ]);

    $response = $this->get(route('contact-messages.show', $msg->id));
    $response->assertStatus(200);
    $response->assertSee('Need help');
});

test('admin can delete a contact message', function () {
    $this->actingAs($this->admin, 'admin');

    $msg = ContactMessage::create([
        'name'    => 'Jane Smith',
        'email'   => 'jane@example.com',
        'subject' => 'Support',
        'message' => 'Need help',
    ]);

    $response = $this->delete(route('contact-messages.destroy', $msg->id));
    $response->assertRedirect(route('contact-messages.index'));

    $this->assertDatabaseMissing('contact_messages', [
        'id' => $msg->id,
    ]);
});
