<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('user')->latest()->get();

        return view('frontend.cars.index', compact('cars'));
    }

    public function destroy(Car $car)
    {
        if ($car->image && file_exists(public_path('uploads/cars/'.$car->image))) {
            unlink(public_path('uploads/cars/'.$car->image));
        }

        $car->delete();

        return back()->with('success','Car deleted successfully.');
    }

    public function show(\App\Models\Car $car)
{
    $car->load('user');

    return view('frontend.cars.show', compact('car'));
}
}