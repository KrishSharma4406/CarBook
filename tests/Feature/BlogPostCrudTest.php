<?php

use App\Models\BlogPost;
use App\Models\Admin;
use App\Models\HomePage;
use App\Models\BlogPage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Seed all sidebar menu permissions checked in header2.blade.php to prevent Spatie PermissionDoesNotExist exceptions
    foreach ([
        'dashboard.view', 
        'forms.view', 
        'tables.view', 
        'users.view', 
        'cars.view', 
        'rides.view', 
        'bookings.view', 
        'roles.view', 
        'permissions.view'
    ] as $permission) {
        Permission::findOrCreate($permission, 'web');
    }

    // Bypass authorization gates during tests
    Gate::before(fn () => true);

    // Create an Admin user for auth
    $this->admin = Admin::create([
        'name' => 'Admin User',
        'email' => 'admin_test@example.com',
        'password' => bcrypt('password'),
    ]);
});

test('admin can view blog posts index', function () {
    $this->actingAs($this->admin, 'admin');

    $response = $this->get(route('blog-posts.index'));
    $response->assertStatus(200);
});

test('admin can create a blog post', function () {
    $this->actingAs($this->admin, 'admin');

    Storage::fake('public');
    $file = UploadedFile::fake()->image('cover.jpg');

    $response = $this->post(route('blog-posts.store'), [
        'title'       => 'My First Blog Post',
        'description' => 'A brief summary of my first blog post.',
        'content'     => 'The actual long body contents of the blog post.',
        'author'      => 'John Doe',
        'image'       => $file,
    ]);

    $response->assertRedirect(route('blog-posts.index'));

    $this->assertDatabaseHas('blog_posts', [
        'title'       => 'My First Blog Post',
        'slug'        => 'my-first-blog-post',
        'description' => 'A brief summary of my first blog post.',
        'content'     => 'The actual long body contents of the blog post.',
        'author'      => 'John Doe',
    ]);

    $post = BlogPost::first();
    expect($post->image)->not->toBeNull();
    // Clean up file if created outside fake disk
    if ($post->image && file_exists(public_path($post->image))) {
        @unlink(public_path($post->image));
    }
});

test('admin can edit a blog post', function () {
    $this->actingAs($this->admin, 'admin');

    $post = BlogPost::create([
        'title'       => 'Old Post Title',
        'slug'        => 'old-post-title',
        'description' => 'Old description.',
        'content'     => 'Old content.',
        'author' => 'Admin',
    ]);

    $response = $this->put(route('blog-posts.update', $post->id), [
        'title'       => 'New Post Title',
        'description' => 'New description.',
        'content'     => 'New content.',
        'author'      => 'Editor User',
    ]);

    $response->assertRedirect(route('blog-posts.index'));

    $this->assertDatabaseHas('blog_posts', [
        'id'          => $post->id,
        'title'       => 'New Post Title',
        'slug'        => 'new-post-title',
        'description' => 'New description.',
        'content'     => 'New content.',
        'author'      => 'Editor User',
    ]);
});

test('admin can delete a blog post', function () {
    $this->actingAs($this->admin, 'admin');

    $post = BlogPost::create([
        'title'       => 'Delete Me',
        'slug'        => 'delete-me',
        'description' => 'summary',
        'content'     => 'body',
    ]);

    $response = $this->delete(route('blog-posts.destroy', $post->id));
    $response->assertRedirect(route('blog-posts.index'));

    $this->assertDatabaseMissing('blog_posts', [
        'id' => $post->id,
    ]);
});

test('users can view dynamic blog posts in frontend', function () {
    // Seed templates setting and homepage setting so pages load
    HomePage::create(['hero_title' => 'Fast & Easy', 'blog_title' => 'Our Blogs', 'blog_subtitle' => 'Blog']);
    BlogPage::create(['hero_title' => 'Blog Listing', 'blog_subtitle' => 'Blog']);

    $post = BlogPost::create([
        'title'       => 'Dynamic Frontend Post',
        'slug'        => 'dynamic-frontend-post',
        'description' => 'Frontend post description',
        'content'     => 'Frontend post content',
    ]);

    // Check homepage
    $response = $this->get(route('home'));
    $response->assertStatus(200);
    $response->assertSee('Dynamic Frontend Post');

    // Check blog page
    $response = $this->get(route('blog'));
    $response->assertStatus(200);
    $response->assertSee('Dynamic Frontend Post');

    // Check blog details
    $response = $this->get(route('blog-details', $post->slug));
    $response->assertStatus(200);
    $response->assertSee('Dynamic Frontend Post');
    $response->assertSee('Frontend post content');
});
