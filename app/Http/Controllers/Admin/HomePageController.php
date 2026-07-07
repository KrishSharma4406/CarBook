<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePage;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Display the current home page settings.
     */
    public function index()
    {
        $home = HomePage::first();

        return view('admin.homepage.index', compact('home'));
    }

    /**
     * Show the edit form for all home page sections.
     */
    public function edit()
    {
        $home = HomePage::first();

        // If no record exists yet, create one with defaults
        if (! $home) {
            $home = HomePage::create([
                'hero_title' => 'Fast & Easy Way To Rent A Car',
                'hero_subtitle' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'video_url' => '#',
                'video_text' => 'Easy steps for renting a car',
                'about_subtitle' => 'About us',
                'about_title' => 'Welcome to Carbook',
                'about_description' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'services_subtitle' => 'Services',
                'services_title' => 'Our Latest Services',
                'service_1_icon' => 'flaticon-wedding-car',
                'service_1_title' => 'Wedding Ceremony',
                'service_1_desc' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'service_2_icon' => 'flaticon-transportation',
                'service_2_title' => 'City Transfer',
                'service_2_desc' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'service_3_icon' => 'flaticon-car',
                'service_3_title' => 'Airport Transfer',
                'service_3_desc' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'service_4_icon' => 'flaticon-transportation',
                'service_4_title' => 'Whole City Tour',
                'service_4_desc' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'cta_title' => 'Do You Want To Earn With Us? So Don\'t Be Late.',
                'cta_button_text' => 'Become A Driver',
                'cta_button_url' => '#',
                'testimonial_subtitle' => 'Testimonial',
                'testimonial_title' => 'Happy Clients',
                'blog_subtitle' => 'Blog',
                'blog_title' => 'Recent Blog',
                'counter_1_number' => 60,
                'counter_1_label' => 'Year Experienced',
                'counter_2_number' => 1090,
                'counter_2_label' => 'Total Cars',
                'counter_3_number' => 2590,
                'counter_3_label' => 'Happy Customers',
                'counter_4_number' => 67,
                'counter_4_label' => 'Total Branches',
            ]);
        }

        return view('admin.homepage.edit', compact('home'));
    }

    /**
     * Update the home page settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            // Hero
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'video_url' => 'nullable|string|max:255',
            'video_text' => 'nullable|string|max:255',
            'hero_background' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // About
            'about_subtitle' => 'nullable|string|max:255',
            'about_title' => 'nullable|string|max:255',
            'about_description' => 'nullable|string',
            'about_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // Services
            'services_subtitle' => 'nullable|string|max:255',
            'services_title' => 'nullable|string|max:255',
            'service_1_icon' => 'nullable|string|max:255',
            'service_1_title' => 'nullable|string|max:255',
            'service_1_desc' => 'nullable|string',
            'service_2_icon' => 'nullable|string|max:255',
            'service_2_title' => 'nullable|string|max:255',
            'service_2_desc' => 'nullable|string',
            'service_3_icon' => 'nullable|string|max:255',
            'service_3_title' => 'nullable|string|max:255',
            'service_3_desc' => 'nullable|string',
            'service_4_icon' => 'nullable|string|max:255',
            'service_4_title' => 'nullable|string|max:255',
            'service_4_desc' => 'nullable|string',

            // CTA
            'cta_title' => 'nullable|string|max:255',
            'cta_button_text' => 'nullable|string|max:255',
            'cta_button_url' => 'nullable|string|max:255',
            'cta_background' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // Testimonials
            'testimonial_subtitle' => 'nullable|string|max:255',
            'testimonial_title' => 'nullable|string|max:255',

            // Blog
            'blog_subtitle' => 'nullable|string|max:255',
            'blog_title' => 'nullable|string|max:255',

            // Counters
            'counter_1_number' => 'nullable|integer',
            'counter_1_label' => 'nullable|string|max:255',
            'counter_2_number' => 'nullable|integer',
            'counter_2_label' => 'nullable|string|max:255',
            'counter_3_number' => 'nullable|integer',
            'counter_3_label' => 'nullable|string|max:255',
            'counter_4_number' => 'nullable|integer',
            'counter_4_label' => 'nullable|string|max:255',
        ]);

        $home = HomePage::first();

        if (! $home) {
            $home = new HomePage;
        }

        $data = $request->except(['_token', '_method', 'hero_background', 'about_image', 'cta_background']);

        if ($request->hasFile('hero_background')) {
            $file = $request->file('hero_background');
            $filename = 'hero_bg_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/homepage'), $filename);
            $data['hero_background'] = 'uploads/homepage/'.$filename;
        }
x
        if ($request->hasFile('about_image')) {
            $file = $request->file('about_image');
            $filename = 'about_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/homepage'), $filename);
            $data['about_image'] = 'uploads/homepage/'.$filename;
        }

        if ($request->hasFile('cta_background')) {
            $file = $request->file('cta_background');
            $filename = 'cta_bg_'.time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/homepage'), $filename);
            $data['cta_background'] = 'uploads/homepage/'.$filename;
        }

        $home->fill($data);
        $home->save();

        return redirect()
            ->route('admin.homepage.index')
            ->with('success', 'Home page updated successfully.');
    }
}
