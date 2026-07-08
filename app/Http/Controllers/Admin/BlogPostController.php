<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = BlogPost::latest()->paginate(10);
        return view('admin.blog.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'author'      => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'description', 'content', 'author']);
        
        // Generate unique slug
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (BlogPost::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            if (!file_exists(public_path('uploads/blogs'))) {
                mkdir(public_path('uploads/blogs'), 0777, true);
            }
            $file = $request->file('image');
            $filename = 'blog_post_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $filename);
            $data['image'] = 'uploads/blogs/' . $filename;
        }

        if (empty($data['author'])) {
            $data['author'] = 'Admin';
        }

        BlogPost::create($data);

        return redirect()
            ->route('blog-posts.index')
            ->with('success', 'Blog post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog.posts.edit', compact('blogPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'content'     => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'author'      => 'nullable|string|max:255',
        ]);

        $data = $request->only(['title', 'description', 'content', 'author']);

        // Generate unique slug if title has changed
        if ($blogPost->title !== $request->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            while (BlogPost::where('slug', $slug)->where('id', '!=', $blogPost->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $data['slug'] = $slug;
        }

        if ($request->hasFile('image')) {
            if (!file_exists(public_path('uploads/blogs'))) {
                mkdir(public_path('uploads/blogs'), 0777, true);
            }
            
            // Delete old image
            if ($blogPost->image && file_exists(public_path($blogPost->image))) {
                @unlink(public_path($blogPost->image));
            }

            $file = $request->file('image');
            $filename = 'blog_post_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $filename);
            $data['image'] = 'uploads/blogs/' . $filename;
        }

        if (empty($data['author'])) {
            $data['author'] = 'Admin';
        }

        $blogPost->update($data);

        return redirect()
            ->route('blog-posts.index')
            ->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogPost)
    {
        // Delete image
        if ($blogPost->image && file_exists(public_path($blogPost->image))) {
            @unlink(public_path($blogPost->image));
        }

        $blogPost->delete();

        return redirect()
            ->route('blog-posts.index')
            ->with('success', 'Blog post deleted successfully.');
    }
}
