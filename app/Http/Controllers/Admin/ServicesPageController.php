<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicesPage;
use Illuminate\Http\Request;

class ServicesPageController extends Controller
{
    public function index()
    {
        $services = ServicesPage::first();
        return view('admin.services.index', compact('services'));
    }

    public function edit()
    {
        $services = ServicesPage::first();
        if (!$services) {
            $services = ServicesPage::create([
                'hero_title'        => 'Our Services',
                'services_subtitle' => 'Services',
                'services_title'    => 'Our Latest Services',
                'service_1_icon'    => 'flaticon-wedding-car',
                'service_1_title'   => 'Wedding Ceremony',
                'service_1_desc'    => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'service_2_icon'    => 'flaticon-transportation',
                'service_2_title'   => 'City Transfer',
                'service_2_desc'    => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'service_3_icon'    => 'flaticon-car',
                'service_3_title'   => 'Airport Transfer',
                'service_3_desc'    => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'service_4_icon'    => 'flaticon-transportation',
                'service_4_title'   => 'Whole City Tour',
                'service_4_desc'    => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'cta_title'         => 'Do You Want To Earn With Us? So Don\'t Be Late.',
                'cta_button_text'   => 'Become A Driver',
                'cta_button_url'    => '#',
            ]);
        }
        return view('admin.services.edit', compact('services'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_title'        => 'required|string|max:255',
            'hero_background'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'services_subtitle' => 'nullable|string|max:255',
            'services_title'    => 'nullable|string|max:255',
            'service_1_icon'    => 'nullable|string|max:255',
            'service_1_title'   => 'nullable|string|max:255',
            'service_1_desc'    => 'nullable|string',
            'service_2_icon'    => 'nullable|string|max:255',
            'service_2_title'   => 'nullable|string|max:255',
            'service_2_desc'      => 'nullable|string',
            'service_3_icon'    => 'nullable|string|max:255',
            'service_3_title'   => 'nullable|string|max:255',
            'service_3_desc'    => 'nullable|string',
            'service_4_icon'    => 'nullable|string|max:255',
            'service_4_title'   => 'nullable|string|max:255',
            'service_4_desc'    => 'nullable|string',
            'cta_title'         => 'nullable|string|max:255',
            'cta_button_text'   => 'nullable|string|max:255',
            'cta_button_url'    => 'nullable|string|max:255',
            'cta_background'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $services = ServicesPage::first() ?? new ServicesPage();
        $data = $request->except(['_token', '_method', 'hero_background', 'cta_background']);

        if (!file_exists(public_path('uploads/pages'))) {
            mkdir(public_path('uploads/pages'), 0777, true);
        }

        if ($request->hasFile('hero_background')) {
            $file = $request->file('hero_background');
            $filename = 'services_hero_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $data['hero_background'] = 'uploads/pages/' . $filename;
        }

        if ($request->hasFile('cta_background')) {
            $file = $request->file('cta_background');
            $filename = 'services_cta_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $data['cta_background'] = 'uploads/pages/' . $filename;
        }

        $services->fill($data);
        $services->save();

        return redirect()->route('admin.services.index')->with('success', 'Services page updated successfully.');
    }
}
