<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPage;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function index()
    {
        $blog = BlogPage::first();
        return view('admin.blog.index', compact('blog'));
    }

    public function edit()
    {
        $blog = BlogPage::first();
        if (!$blog) {
            $blog = BlogPage::create([
                'hero_title'    => 'Our Blog',
                'blog_subtitle' => 'Blog',
                'blog_title'    => 'Recent Blog',
            ]);
        }
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_title'      => 'required|string|max:255',
            'hero_background' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'blog_subtitle'   => 'nullable|string|max:255',
            'blog_title'      => 'nullable|string|max:255',
        ]);

        $blog = BlogPage::first() ?? new BlogPage();
        $data = $request->except(['_token', '_method', 'hero_background']);

        if (!file_exists(public_path('uploads/pages'))) {
            mkdir(public_path('uploads/pages'), 0777, true);
        }

        if ($request->hasFile('hero_background')) {
            $file = $request->file('hero_background');
            $filename = 'blog_hero_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $data['hero_background'] = 'uploads/pages/' . $filename;
        }

        $blog->fill($data);
        $blog->save();

        // Sync with HomePage
        $home = \App\Models\HomePage::first();
        if ($home) {
            $home->update([
                'blog_subtitle' => $blog->blog_subtitle,
                'blog_title' => $blog->blog_title,
            ]);
        } else {
            \App\Models\HomePage::create([
                'hero_title' => 'Fast & Easy Way To Rent A Car',
                'blog_subtitle' => $blog->blog_subtitle,
                'blog_title' => $blog->blog_title,
            ]);
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog page updated successfully.');
    }
}
