<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\RideBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
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
     * Payment Page
     */

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

    RideBooking::create([
        'ride_id' => $ride->id,
        'user_id' => auth()->id(),
        'seats' => $request->seats,
        'booking_status' => 'pending',
        'status' => 'pending'
    ]);

    return redirect()
        ->route('booking.my')
        ->with('success', 'Ride request sent successfully. Wait for the driver to approve it.');
}

    /**
     * Booking Success
     */

    /**
     * My Bookings
     */
    public function myBookings()
    {
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

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
}