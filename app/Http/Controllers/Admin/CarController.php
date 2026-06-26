<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('user')->latest()->paginate(10);

        return view('admin.cars.index', compact('cars'));
    }

    public function destroy(Car $car)
    {
        if ($car->image && file_exists(public_path('uploads/cars/' . $car->image))) {
            unlink(public_path('uploads/cars/' . $car->image));
        }

        $car->delete();

        return back()->with('success', 'Car deleted successfully.');
    }

    public function show(\App\Models\Car $car)
    {
        $car->load('user');

        return view('admin.cars.show', compact('car'));
    }
}
