<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:cars.view')->only([
            'index',
            'show'
        ]);

        $this->middleware('permission:cars.create')->only([
            'create',
            'store'
        ]);

        $this->middleware('permission:cars.edit')->only([
            'edit',
            'update'
        ]);

        $this->middleware('permission:cars.delete')->only([
            'destroy'
        ]);
    }

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