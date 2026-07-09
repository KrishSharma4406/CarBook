<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\RideBooking;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RideBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ride-booking.create')->only([
            'store'
        ]);

        $this->middleware('permission:ride-booking.view')->only([
            'requests',
            'show'
        ]);

        $this->middleware('permission:ride-booking.edit')->only([
            'accept',
            'reject'
        ]);

        $this->middleware('permission:ride-booking.delete')->only([
            'destroy'
        ]);
    }

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

        $booking = RideBooking::create([
            'ride_id' => $ride->id,
            'user_id' => Auth::id(),
            'seats'   => 1,
            'status'  => 'pending'
        ]);

        Notification::create([
            'user_id' => $ride->user_id, // Driver
            'sender_id' => Auth::id(), // Passenger
            'ride_booking_id' => $booking->id,
            'type' => 'booked',
            'message' => Auth::user()->name . ' requested to book your ride to ' . $ride->destination . '.',
            'target_tab' => 'rides.requests',
            'is_read' => false,
        ]);

        return back()->with('success', 'Ride request sent successfully.');
    }

    /**
     * Ride requests for rides offered by current user
     */
    public function requests()
    {
        Notification::where('user_id', Auth::id())
            ->where('target_tab', 'rides.requests')
            ->where('is_read', false)
            ->update(['is_read' => true]);

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

        Notification::create([
            'user_id' => $booking->user_id, // Passenger
            'sender_id' => Auth::id(), // Driver
            'ride_booking_id' => $booking->id,
            'type' => 'accepted',
            'message' => 'Your booking request for ride to ' . $booking->ride->destination . ' has been accepted.',
            'target_tab' => 'booking.my',
            'is_read' => false,
        ]);

        return back()->with('success', 'Booking Accepted');
    }

    /**
     * Reject Request
     */
    public function reject(RideBooking $booking)
    {
        if ($booking->ride->user_id != Auth::id()) {
            abort(403);
        }

        $booking->update([
            'booking_status' => 'rejected',
            'status' => 'rejected'
        ]);

        Notification::create([
            'user_id' => $booking->user_id, // Passenger
            'sender_id' => Auth::id(), // Driver
            'ride_booking_id' => $booking->id,
            'type' => 'rejected',
            'message' => 'Your booking request for ride to ' . $booking->ride->destination . ' has been rejected.',
            'target_tab' => 'booking.my',
            'is_read' => false,
        ]);

        return back()->with('success', 'Booking rejected.');
    }

    /**
     * Show Ride Details
     */
    public function show(Ride $ride)
    {
        $ride->load('user');

        return view('frontend.webviews.ride-details', compact('ride'));
    }
}