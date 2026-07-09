<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\RideBooking;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:booking-summary.view')->only([
            'summary'
        ]);

        $this->middleware('permission:booking-summary.create')->only([
            'confirm'
        ]);

        $this->middleware('permission:my-bookings.view')->only([
            'myBookings'
        ]);

        $this->middleware('permission:my-bookings.cancel')->only([
            'cancel'
        ]);
    }

    /**
     * Booking Summary Page
     */
    public function summary(Ride $ride)
    {
        if ($ride->user_id == auth()->id()) {
            return back()->with('error', 'You cannot book your own ride.');
        }

        if ($ride->available_seats <= 0) {
            return back()->with('error', 'No seats available.');
        }

        return view('frontend.webviews.booking-summary', compact('ride'));
    }

    /**
     * Confirm Booking
     */
    public function confirm(Request $request, Ride $ride)
    {
        $request->validate([
            'seats' => 'required|integer|min:1|max:' . $ride->available_seats,
        ]);

        $alreadyBooked = RideBooking::where('ride_id', $ride->id)
            ->where('user_id', auth()->id())
            ->whereIn('booking_status', ['pending', 'accepted'])
            ->exists();

        if ($alreadyBooked) {
            return back()->with('error', 'You have already requested this ride.');
        }

        $booking = RideBooking::create([
            'ride_id' => $ride->id,
            'user_id' => auth()->id(),
            'seats' => $request->seats,
            'booking_status' => 'pending',
            'status' => 'pending'
        ]);

        Notification::create([
            'user_id' => $ride->user_id, // Driver
            'sender_id' => auth()->id(), // Passenger
            'ride_booking_id' => $booking->id,
            'type' => 'booked',
            'message' => auth()->user()->name . ' requested to book your ride to ' . $ride->destination . '.',
            'target_tab' => 'rides.requests',
            'is_read' => false,
        ]);

        return redirect()
            ->route('booking.my')
            ->with('success', 'Ride request sent successfully. Wait for the driver to approve it.');
    }

    /**
     * My Bookings
     */
    public function myBookings()
    {
        // Mark passenger bookings notifications as read
        Notification::where('user_id', Auth::id())
            ->where('target_tab', 'booking.my')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $bookings = RideBooking::with('ride')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.webviews.my-bookings', compact('bookings'));
    }

    /**
     * Cancel Booking
     */
    public function cancel(RideBooking $booking)
    {
        if ($booking->user_id != Auth::id()) {
            abort(403);
        }

        $booking->update([
            'booking_status' => 'cancelled'
        ]);

        Notification::create([
            'user_id' => $booking->ride->user_id, // Driver
            'sender_id' => Auth::id(), // Passenger
            'ride_booking_id' => $booking->id,
            'type' => 'cancelled',
            'message' => Auth::user()->name . ' cancelled their booking request for ride to ' . $booking->ride->destination . '.',
            'target_tab' => 'rides.requests',
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
}