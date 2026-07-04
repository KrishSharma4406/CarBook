<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RideBooking;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:bookings.view')->only([
            'index',
            'show'
        ]);
    }

    /**
     * Display all bookings
     */
    public function index()
    {
        $bookings = RideBooking::with([
            'user',
            'ride.user',
            'ride.car'
        ])->latest()->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Booking Details
     */
    public function show(RideBooking $booking)
    {
        $booking->load([
            'user',
            'ride.user',
            'ride.car'
        ]);

        return view('admin.bookings.show', compact('booking'));
    }
}