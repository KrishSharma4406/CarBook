<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\adminabout;
use Illuminate\Http\Request;

class aboutcontroller extends Controller
{
    public function index()
    {
        $about = adminabout::first();
        return view('admin.about.index', compact('about'));
    }

    public function edit($id)
    {
        $about = adminabout::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'vehicle' => 'required|string',
            'title2' => 'required|string|max:255',
        ]);

        $about = adminabout::findOrFail($id);
        $about->update($request->all());

        return redirect()->route('admin.about.index')->with('success', 'About section updated successfully.');
    }
}
