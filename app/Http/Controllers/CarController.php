<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:profile.edit')->only([
            'edit',
            'save',
            'create',
            'editCar',
            'destroy',
        ]);

        $this->middleware('permission:cars.view')->only([
            'show',
        ]);

        $this->middleware('permission:price.view')->only([
            'pricing',
        ]);
    }

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
            'pickup_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'travel_date' => 'required|date',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $carId = $request->input('car_id');
        if ($carId) {
            $car = Car::where('user_id', Auth::id())->findOrFail($carId);
        } else {
            $car = new Car();
            $car->user_id = Auth::id();
        }

        $car->fill($request->except(['image', 'car_id', 'pickup_location', 'destination', 'travel_date']));

        if ($request->hasFile('image')) {
            // Delete old image if updating and new image uploaded
            if ($car->image && file_exists(public_path('uploads/cars/' . $car->image))) {
                unlink(public_path('uploads/cars/' . $car->image));
            }

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('uploads/cars'), $imageName);

            $car->image = $imageName;
        }

        $car->save();

        // Create or update corresponding active ride
        \App\Models\Ride::updateOrCreate(
            ['car_id' => $car->id],
            [
                'user_id' => $car->user_id,
                'pickup_location' => $request->pickup_location,
                'destination' => $request->destination,
                'travel_date' => $request->travel_date,
                'available_seats' => 4,
                'fare' => $car->rent_per_day,
                'vehicle_name' => $car->brand . ' ' . $car->model,
                'vehicle_number' => $car->registration_number,
                'status' => 'active'
            ]
        );

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Car details saved successfully.');
    }

    public function show(Car $car)
    {
        $car->load('user');

        return view('frontend.webviews.car-details', compact('car'));
    }

    public function create()
    {
        return view('profile.car');
    }

    public function editCar(Car $car)
    {
        if ($car->user_id != auth()->id()) {
            abort(403);
        }

        return view('profile.car', compact('car'));
    }

    public function destroy(Car $car)
    {
        if ($car->user_id != auth()->id()) {
            abort(403);
        }

        if ($car->image && file_exists(public_path('uploads/cars/' . $car->image))) {
            unlink(public_path('uploads/cars/' . $car->image));
        }

        $car->delete();

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Car deleted successfully.');
    }

    public function pricing()
    {
        $cars = Car::latest()->get();

        return view('frontend.price', compact('cars'));
    }
}