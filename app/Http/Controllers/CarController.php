<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function edit()
    {
        $cars = auth()->user()->cars;

        return view('profile.car', compact('cars'));
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

        $car = new Car();

        $car->user_id = Auth::id();

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

public function create()
{
    return view('profile.add-car');
}

public function editCar(Car $car)
{
    abort_if($car->user_id != auth()->id(),403);

    return view('profile.edit-car',compact('car'));
}

public function destroy(Car $car)
{
    // Ensure the logged-in user owns the car
    if ($car->user_id != auth()->id()) {
        abort(403);
    }

    // Delete image from uploads folder
    if ($car->image && file_exists(public_path('uploads/cars/'.$car->image))) {
        unlink(public_path('uploads/cars/'.$car->image));
    }

    // Delete database record
    $car->delete();

    return redirect()
        ->route('profile.edit')
        ->with('success', 'Car deleted successfully.');
}
}