<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ride;

class RideController extends Controller
{
    /**
     * Display all rides
     */
    public function index()
    {
        $rides = Ride::with([
            'user',
            'car',
            'bookings'
        ])
        ->latest()
        ->paginate(10);

        return view('admin.rides.index', compact('rides'));
    }

    /**
     * Show ride details
     */
    public function show(Ride $ride)
    {
        $ride->load([
            'user',
            'car',
            'bookings.user'
        ]);

        return view('admin.rides.show', compact('ride'));
    }
}