<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        $about = AboutPage::first();
        return view('admin.about.index', compact('about'));
    }

    public function edit()
    {
        $about = AboutPage::first();
        if (!$about) {
            $about = AboutPage::create([
                'hero_title'           => 'About Us',
                'about_subtitle'       => 'About us',
                'about_title'          => 'Welcome to Carbook',
                'about_description'    => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'cta_title'            => 'Do You Want To Earn With Us? So Don\'t Be Late.',
                'cta_button_text'      => 'Become A Driver',
                'cta_button_url'       => '#',
                'testimonial_subtitle' => 'Testimonial',
                'testimonial_title'    => 'Happy Clients',
                'counter_1_number'     => 60,
                'counter_1_label'      => 'Year Experienced',
                'counter_2_number'     => 1090,
                'counter_2_label'      => 'Total Cars',
                'counter_3_number'     => 2590,
                'counter_3_label'      => 'Happy Customers',
                'counter_4_number'     => 67,
                'counter_4_label'      => 'Total Branches',
            ]);
        }
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_title'           => 'required|string|max:255',
            'hero_background'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'about_subtitle'       => 'nullable|string|max:255',
            'about_title'          => 'nullable|string|max:255',
            'about_description'    => 'nullable|string',
            'about_image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cta_title'            => 'nullable|string|max:255',
            'cta_button_text'      => 'nullable|string|max:255',
            'cta_button_url'       => 'nullable|string|max:255',
            'cta_background'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'testimonial_subtitle' => 'nullable|string|max:255',
            'testimonial_title'    => 'nullable|string|max:255',
            'counter_1_number'     => 'nullable|numeric',
            'counter_1_label'      => 'nullable|string|max:255',
            'counter_2_number'     => 'nullable|numeric',
            'counter_2_label'      => 'nullable|string|max:255',
            'counter_3_number'     => 'nullable|numeric',
            'counter_3_label'      => 'nullable|string|max:255',
            'counter_4_number'     => 'nullable|numeric',
            'counter_4_label'      => 'nullable|string|max:255',
        ]);

        $about = AboutPage::first() ?? new AboutPage();
        $data = $request->except(['_token', '_method', 'hero_background', 'about_image', 'cta_background']);

        // Handlers for image uploads
        if (!file_exists(public_path('uploads/pages'))) {
            mkdir(public_path('uploads/pages'), 0777, true);
        }

        if ($request->hasFile('hero_background')) {
            $file = $request->file('hero_background');
            $filename = 'about_hero_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $data['hero_background'] = 'uploads/pages/' . $filename;
        }

        if ($request->hasFile('about_image')) {
            $file = $request->file('about_image');
            $filename = 'about_img_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $data['about_image'] = 'uploads/pages/' . $filename;
        }

        if ($request->hasFile('cta_background')) {
            $file = $request->file('cta_background');
            $filename = 'about_cta_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $data['cta_background'] = 'uploads/pages/' . $filename;
        }

        $about->fill($data);
        $about->save();

        // Sync with HomePage
        $home = \App\Models\HomePage::first();
        $homeData = [
            'about_subtitle' => $about->about_subtitle,
            'about_title' => $about->about_title,
            'about_description' => $about->about_description,
            'cta_title' => $about->cta_title,
            'cta_button_text' => $about->cta_button_text,
            'cta_button_url' => $about->cta_button_url,
            'testimonial_subtitle' => $about->testimonial_subtitle,
            'testimonial_title' => $about->testimonial_title,
            'counter_1_number' => $about->counter_1_number,
            'counter_1_label' => $about->counter_1_label,
            'counter_2_number' => $about->counter_2_number,
            'counter_2_label' => $about->counter_2_label,
            'counter_3_number' => $about->counter_3_number,
            'counter_3_label' => $about->counter_3_label,
            'counter_4_number' => $about->counter_4_number,
            'counter_4_label' => $about->counter_4_label,
        ];
        if ($about->about_image) {
            $homeData['about_image'] = $about->about_image;
        }
        if ($about->cta_background) {
            $homeData['cta_background'] = $about->cta_background;
        }
        if ($home) {
            $home->update($homeData);
        } else {
            $homeData['hero_title'] = 'Fast & Easy Way To Rent A Car';
            \App\Models\HomePage::create($homeData);
        }

        return redirect()->route('admin.about.index')->with('success', 'About page updated successfully.');
    }
}
