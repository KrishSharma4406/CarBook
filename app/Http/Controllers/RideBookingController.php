<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\RideBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RideBookingController extends Controller
{
    /**
     * Book a Ride
     */
    public function store(Ride $ride)
    {
        // Prevent booking your own ride
        if ($ride->user_id == Auth::id()) {
            return back()->with('error', 'You cannot book your own ride.');
        }

        // Ride must be active
        if ($ride->status != 'active') {
            return back()->with('error', 'This ride is no longer available.');
        }

        // Seats available?
        if ($ride->available_seats <= 0) {
            return back()->with('error', 'No seats available.');
        }

        // Already booked?
        $alreadyBooked = RideBooking::where('ride_id', $ride->id)
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'accepted'])
            ->exists();

        if ($alreadyBooked) {
            return back()->with('error', 'You have already requested this ride.');
        }

        RideBooking::create([
            'ride_id' => $ride->id,
            'user_id' => Auth::id(),
            'seats'   => 1,
            'status'  => 'pending'
        ]);

        return back()->with('success', 'Ride request sent successfully.');
    }

    /**
     * Ride requests for rides offered by current user
     */
    public function requests()
    {
        $bookings = RideBooking::with(['ride', 'user'])
            ->whereHas('ride', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('frontend.webviews.ride-requests', compact('bookings'));
    }

    /**
     * Accept Request
     */
    public function accept(RideBooking $booking)
{
    $booking->update([
        'booking_status' => 'accepted',
        'status' => 'accepted'
    ]);

    $booking->ride->decrement('available_seats');

    return back()->with('success','Booking Accepted');
}

    /**
     * Reject Request
     */
    public function reject(RideBooking $booking)
    {
        $ride = $booking->ride;

        if ($ride->user_id != Auth::id()) {
            abort(403);
        }

        $booking->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Booking rejected.');
    }

    public function show(Ride $ride)
{
    $ride->load('user');

    return view('frontend.webviews.ride-details', compact('ride'));
}
}