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
        } else {
            $updated = false;
            if (is_null($home->rent_title)) {
                $home->rent_title = 'Better Way to Rent Your Perfect Cars';
                $updated = true;
            }
            if (is_null($home->rent_step_1_icon)) {
                $home->rent_step_1_icon = 'flaticon-route';
                $updated = true;
            }
            if (is_null($home->rent_step_1_title)) {
                $home->rent_step_1_title = 'Choose Your Pickup Location';
                $updated = true;
            }
            if (is_null($home->rent_step_2_icon)) {
                $home->rent_step_2_icon = 'flaticon-handshake';
                $updated = true;
            }
            if (is_null($home->rent_step_2_title)) {
                $home->rent_step_2_title = 'Select the Best Deal';
                $updated = true;
            }
            if (is_null($home->rent_step_3_icon)) {
                $home->rent_step_3_icon = 'flaticon-rent';
                $updated = true;
            }
            if (is_null($home->rent_step_3_title)) {
                $home->rent_step_3_title = 'Reserve Your Rental Car';
                $updated = true;
            }
            if (is_null($home->rent_button_text)) {
                $home->rent_button_text = 'Reserve Your Perfect Car';
                $updated = true;
            }
            if (is_null($home->rent_button_url)) {
                $home->rent_button_url = '#';
                $updated = true;
            }
            if ($updated) {
                $home->save();
            }
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

            // Rent Steps
            'rent_title' => 'nullable|string|max:255',
            'rent_step_1_icon' => 'nullable|string|max:255',
            'rent_step_1_title' => 'nullable|string|max:255',
            'rent_step_2_icon' => 'nullable|string|max:255',
            'rent_step_2_title' => 'nullable|string|max:255',
            'rent_step_3_icon' => 'nullable|string|max:255',
            'rent_step_3_title' => 'nullable|string|max:255',
            'rent_button_text' => 'nullable|string|max:255',
            'rent_button_url' => 'nullable|string|max:255',
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

        // Sync with AboutPage
        $about = \App\Models\AboutPage::first();
        $aboutData = [
            'about_subtitle' => $home->about_subtitle,
            'about_title' => $home->about_title,
            'about_description' => $home->about_description,
            'cta_title' => $home->cta_title,
            'cta_button_text' => $home->cta_button_text,
            'cta_button_url' => $home->cta_button_url,
            'testimonial_subtitle' => $home->testimonial_subtitle,
            'testimonial_title' => $home->testimonial_title,
            'counter_1_number' => $home->counter_1_number,
            'counter_1_label' => $home->counter_1_label,
            'counter_2_number' => $home->counter_2_number,
            'counter_2_label' => $home->counter_2_label,
            'counter_3_number' => $home->counter_3_number,
            'counter_3_label' => $home->counter_3_label,
            'counter_4_number' => $home->counter_4_number,
            'counter_4_label' => $home->counter_4_label,
        ];
        if ($home->about_image) {
            $aboutData['about_image'] = $home->about_image;
        }
        if ($home->cta_background) {
            $aboutData['cta_background'] = $home->cta_background;
        }
        if ($about) {
            $about->update($aboutData);
        } else {
            $aboutData['hero_title'] = 'About Us';
            \App\Models\AboutPage::create($aboutData);
        }

        // Sync with ServicesPage
        $services = \App\Models\ServicesPage::first();
        $servicesData = [
            'services_subtitle' => $home->services_subtitle,
            'services_title' => $home->services_title,
            'service_1_icon' => $home->service_1_icon,
            'service_1_title' => $home->service_1_title,
            'service_1_desc' => $home->service_1_desc,
            'service_2_icon' => $home->service_2_icon,
            'service_2_title' => $home->service_2_title,
            'service_2_desc' => $home->service_2_desc,
            'service_3_icon' => $home->service_3_icon,
            'service_3_title' => $home->service_3_title,
            'service_3_desc' => $home->service_3_desc,
            'service_4_icon' => $home->service_4_icon,
            'service_4_title' => $home->service_4_title,
            'service_4_desc' => $home->service_4_desc,
            'cta_title' => $home->cta_title,
            'cta_button_text' => $home->cta_button_text,
            'cta_button_url' => $home->cta_button_url,
        ];
        if ($home->cta_background) {
            $servicesData['cta_background'] = $home->cta_background;
        }
        if ($services) {
            $services->update($servicesData);
        } else {
            $servicesData['hero_title'] = 'Our Services';
            \App\Models\ServicesPage::create($servicesData);
        }

        // Sync with BlogPage
        $blog = \App\Models\BlogPage::first();
        $blogData = [
            'blog_subtitle' => $home->blog_subtitle,
            'blog_title' => $home->blog_title,
        ];
        if ($blog) {
            $blog->update($blogData);
        } else {
            $blogData['hero_title'] = 'Our Blog';
            \App\Models\BlogPage::create($blogData);
        }

        return redirect()
            ->route('admin.homepage.index')
            ->with('success', 'Home page updated successfully.');
    }
}
