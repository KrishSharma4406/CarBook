<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.index', compact('admin'));
    }

    public function edit()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request)
{
    $admin = Auth::guard('admin')->user();

    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:admins,email,' . $admin->id,
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $admin->name = $request->name;
    $admin->email = $request->email;

    if ($request->hasFile('profile_image')) {

        // Delete old image
        if ($admin->profile_image &&
            file_exists(public_path('uploads/adminimg/' . $admin->profile_image))) {

            unlink(public_path('uploads/adminimg/' . $admin->profile_image));
        }

        $image = $request->file('profile_image');

        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('uploads/adminimg'), $filename);

        // Save filename in DB
        $admin->profile_image = $filename;
    }

    $admin->save();

    return redirect()
        ->route('admin.profile.index')
        ->with('success', 'Profile updated successfully.');
}
}