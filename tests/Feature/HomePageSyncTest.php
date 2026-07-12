<?php

use App\Models\HomePage;
use App\Models\AboutPage;
use App\Models\ServicesPage;
use App\Models\BlogPage;
use App\Models\Admin;

beforeEach(function () {
    // Create Super Admin role
    $superAdminRole = \Spatie\Permission\Models\Role::findOrCreate('Super Admin', 'web');

    // Create an Admin user for auth
    $this->admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password'),
    ]);
    $this->admin->assignRole($superAdminRole);
});

test('updating homepage syncs data to other pages', function () {
    $this->actingAs($this->admin, 'admin');

    // Make request to update homepage
    $response = $this->put(route('admin.homepage.update'), [
        'hero_title' => 'Updated Hero Title',
        'about_subtitle' => 'Updated About Subtitle',
        'about_title' => 'Updated About Title',
        'about_description' => 'Updated About Description',
        'services_subtitle' => 'Updated Services Subtitle',
        'services_title' => 'Updated Services Title',
        'service_1_icon' => 'updated-icon-1',
        'service_1_title' => 'Updated Service 1',
        'service_1_desc' => 'Updated Service 1 Desc',
        'service_2_icon' => 'updated-icon-2',
        'service_2_title' => 'Updated Service 2',
        'service_2_desc' => 'Updated Service 2 Desc',
        'service_3_icon' => 'updated-icon-3',
        'service_3_title' => 'Updated Service 3',
        'service_3_desc' => 'Updated Service 3 Desc',
        'service_4_icon' => 'updated-icon-4',
        'service_4_title' => 'Updated Service 4',
        'service_4_desc' => 'Updated Service 4 Desc',
        'blog_subtitle' => 'Updated Blog Subtitle',
        'blog_title' => 'Updated Blog Title',
        'cta_title' => 'Updated CTA Title',
        'cta_button_text' => 'Updated CTA Button Text',
        'cta_button_url' => 'http://updated-cta-url.com',
    ]);

    $response->assertRedirect(route('admin.homepage.index'));

    // Check about_pages
    $about = AboutPage::first();
    expect($about->about_subtitle)->toBe('Updated About Subtitle');
    expect($about->about_title)->toBe('Updated About Title');
    expect($about->about_description)->toBe('Updated About Description');
    expect($about->cta_title)->toBe('Updated CTA Title');

    // Check services_pages
    $services = ServicesPage::first();
    expect($services->services_subtitle)->toBe('Updated Services Subtitle');
    expect($services->services_title)->toBe('Updated Services Title');
    expect($services->service_1_title)->toBe('Updated Service 1');

    // Check blog_pages
    $blog = BlogPage::first();
    expect($blog->blog_subtitle)->toBe('Updated Blog Subtitle');
    expect($blog->blog_title)->toBe('Updated Blog Title');
});

test('updating about page syncs data to homepage', function () {
    $this->actingAs($this->admin, 'admin');

    // Seed initial Homepage
    HomePage::create([
        'hero_title' => 'Fast & Easy Way To Rent A Car',
    ]);

    // Make request to update About Page
    $response = $this->put(route('admin.about.update'), [
        'hero_title' => 'About Hero Title',
        'about_subtitle' => 'New About Subtitle',
        'about_title' => 'New About Title',
        'about_description' => 'New About Description',
        'cta_title' => 'New About CTA Title',
        'cta_button_text' => 'New About CTA Button Text',
        'cta_button_url' => '#',
        'testimonial_subtitle' => 'New Testimonial Subtitle',
        'testimonial_title' => 'New Testimonial Title',
        'counter_1_number' => 10,
        'counter_1_label' => 'New Counter 1',
    ]);

    $response->assertRedirect(route('admin.about.index'));

    $home = HomePage::first();
    expect($home->about_subtitle)->toBe('New About Subtitle');
    expect($home->about_title)->toBe('New About Title');
    expect($home->about_description)->toBe('New About Description');
    expect($home->cta_title)->toBe('New About CTA Title');
    expect($home->testimonial_subtitle)->toBe('New Testimonial Subtitle');
    expect($home->counter_1_number)->toBe(10);
    expect($home->counter_1_label)->toBe('New Counter 1');
});

test('updating services page syncs data to homepage', function () {
    $this->actingAs($this->admin, 'admin');

    // Seed initial Homepage
    HomePage::create([
        'hero_title' => 'Fast & Easy Way To Rent A Car',
    ]);

    // Make request to update Services Page
    $response = $this->put(route('admin.services.update'), [
        'hero_title' => 'Services Hero Title',
        'services_subtitle' => 'New Services Subtitle',
        'services_title' => 'New Services Title',
        'service_1_icon' => 'new-icon-1',
        'service_1_title' => 'New Service 1',
        'service_1_desc' => 'New Service 1 Desc',
        'service_2_icon' => 'new-icon-2',
        'service_2_title' => 'New Service 2',
        'service_2_desc' => 'New Service 2 Desc',
        'service_3_icon' => 'new-icon-3',
        'service_3_title' => 'New Service 3',
        'service_3_desc' => 'New Service 3 Desc',
        'service_4_icon' => 'new-icon-4',
        'service_4_title' => 'New Service 4',
        'service_4_desc' => 'New Service 4 Desc',
        'cta_title' => 'New Services CTA Title',
        'cta_button_text' => 'New Services CTA Button Text',
        'cta_button_url' => '#',
    ]);

    $response->assertRedirect(route('admin.services.index'));

    $home = HomePage::first();
    expect($home->services_subtitle)->toBe('New Services Subtitle');
    expect($home->services_title)->toBe('New Services Title');
    expect($home->service_1_title)->toBe('New Service 1');
    expect($home->cta_title)->toBe('New Services CTA Title');
});

test('updating blog page syncs data to homepage', function () {
    $this->actingAs($this->admin, 'admin');

    // Seed initial Homepage
    HomePage::create([
        'hero_title' => 'Fast & Easy Way To Rent A Car',
    ]);

    // Make request to update Blog Page
    $response = $this->put(route('admin.blog.update'), [
        'hero_title' => 'Blog Hero Title',
        'blog_subtitle' => 'New Blog Subtitle',
        'blog_title' => 'New Blog Title',
    ]);

    $response->assertRedirect(route('admin.blog.index'));

    $home = HomePage::first();
    expect($home->blog_subtitle)->toBe('New Blog Subtitle');
    expect($home->blog_title)->toBe('New Blog Title');
});
