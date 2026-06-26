<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function edit()
    {
        $car = Auth::user()->car;

        return view('profile.car', compact('car'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'car_name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'manufacturing_year' => 'required',
            'fuel_type' => 'required',
            'transmission' => 'required',
            'color' => 'required',
            'rent_per_day' => 'required|numeric',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $car = Auth::user()->car;

        if (!$car) {
            $car = new Car();
            $car->user_id = Auth::id();
        }

        $car->fill($request->except('image'));

        if ($request->hasFile('image')) {

            if ($car->image && file_exists(public_path('uploads/cars/'.$car->image))) {
                unlink(public_path('uploads/cars/'.$car->image));
            }

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('uploads/cars'), $imageName);

            $car->image = $imageName;
        }

        $car->save();

        return redirect()->route('profile.edit')
            ->with('success','Car details saved successfully.');
    }

    public function show(\App\Models\Car $car)
{
    $car->load('user');

    return view('frontend.webviews.car-details', compact('car'));
}
}