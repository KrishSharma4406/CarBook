<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function index()
    {
        $contact = ContactPage::first();
        return view('admin.contact.index', compact('contact'));
    }

    public function edit()
    {
        $contact = ContactPage::first();
        if (!$contact) {
            $contact = ContactPage::create([
                'hero_title'       => 'Contact Us',
                'contact_subtitle' => 'Contact',
                'contact_title'    => 'Contact Us',
                'contact_address'  => '198 West 21th Street, Suite 721 New York NY 10016',
                'contact_phone'    => '+ 1235 2355 98',
                'contact_email'    => 'info@yoursite.com',
            ]);
        }
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_title'       => 'required|string|max:255',
            'hero_background'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'contact_subtitle' => 'nullable|string|max:255',
            'contact_title'    => 'nullable|string|max:255',
            'contact_address'  => 'nullable|string|max:255',
            'contact_phone'    => 'nullable|string|max:255',
            'contact_email'    => 'nullable|string|max:255',
        ]);

        $contact = ContactPage::first() ?? new ContactPage();
        $data = $request->except(['_token', '_method', 'hero_background']);

        if (!file_exists(public_path('uploads/pages'))) {
            mkdir(public_path('uploads/pages'), 0777, true);
        }

        if ($request->hasFile('hero_background')) {
            $file = $request->file('hero_background');
            $filename = 'contact_hero_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $data['hero_background'] = 'uploads/pages/' . $filename;
        }

        $contact->fill($data);
        $contact->save();

        return redirect()->route('admin.contact.index')->with('success', 'Contact page updated successfully.');
    }
}
