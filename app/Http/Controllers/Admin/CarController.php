<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display all cars
     */
    public function index()
    {
        $cars = Car::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Display single car details
     */
    public function show(Car $car)
    {
        $car->load('user');

        return view('admin.cars.show', compact('car'));
    }
}