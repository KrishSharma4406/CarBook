<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function create()
    {
        return view('admin.auth.register');
    }

    public function store(Request $request)
    {
        // Check if admin already exists
        if (Admin::count() > 0) {

            return back()->withErrors([
                'admin' => 'Admin already exists.'
            ]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Auto login admin
        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.home');
    }
}