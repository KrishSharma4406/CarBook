<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Car;
use App\Models\Ride;
use App\Models\RideBooking;
use App\Models\Booking;
use App\Models\ContactMessage;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard with initial data.
     */
    public function index()
    {
        $data = $this->getDashboardData();
        return view('admin.frontend.webview.home', $data);
    }

    /**
     * Return dashboard stats as JSON for real-time AJAX polling.
     */
    public function stats()
    {
        $data = $this->getDashboardData();
        return response()->json($data);
    }

    /**
     * Gather all dashboard metrics from the database.
     */
    private function getDashboardData(): array
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();

        // ── Core Counts ────────────────────────────────────────────
        $totalUsers = User::count();
        $totalCars = Car::count();
        $totalRides = Ride::count();
        $totalBookings = Booking::count();
        $totalRideBookings = RideBooking::count();
        $totalContactMessages = ContactMessage::count();
        $totalBlogPosts = BlogPost::count();

        // ── This Month Counts ──────────────────────────────────────
        $usersThisMonth = User::where('created_at', '>=', $startOfMonth)->count();
        $carsThisMonth = Car::where('created_at', '>=', $startOfMonth)->count();
        $ridesThisMonth = Ride::where('created_at', '>=', $startOfMonth)->count();
        $bookingsThisMonth = Booking::where('created_at', '>=', $startOfMonth)->count();
        $rideBookingsThisMonth = RideBooking::where('created_at', '>=', $startOfMonth)->count();
        $messagesThisMonth = ContactMessage::where('created_at', '>=', $startOfMonth)->count();

        // ── Last Month Counts (for percentage change) ──────────────
        $usersLastMonth = User::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        $bookingsLastMonth = Booking::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();
        $ridesLastMonth = Ride::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->count();

        // ── Percentage Changes ─────────────────────────────────────
        $userChange = $usersLastMonth > 0
            ? round((($usersThisMonth - $usersLastMonth) / $usersLastMonth) * 100, 1)
            : ($usersThisMonth > 0 ? 100 : 0);

        $bookingChange = $bookingsLastMonth > 0
            ? round((($bookingsThisMonth - $bookingsLastMonth) / $bookingsLastMonth) * 100, 1)
            : ($bookingsThisMonth > 0 ? 100 : 0);

        $rideChange = $ridesLastMonth > 0
            ? round((($ridesThisMonth - $ridesLastMonth) / $ridesLastMonth) * 100, 1)
            : ($ridesThisMonth > 0 ? 100 : 0);

        // ── Booking Status Distribution ────────────────────────────
        $bookingsByStatus = Booking::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $rideBookingsByStatus = RideBooking::selectRaw('booking_status, COUNT(*) as count')
            ->groupBy('booking_status')
            ->pluck('count', 'booking_status')
            ->toArray();

        // ── Ride Status Distribution ───────────────────────────────
        $ridesByStatus = Ride::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // ── Monthly Trends (last 6 months) ─────────────────────────
        $monthlyLabels = [];
        $monthlyUsers = [];
        $monthlyBookings = [];
        $monthlyRides = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $monthlyLabels[] = $month->format('M Y');

            $monthlyUsers[] = User::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $monthlyBookings[] = Booking::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $monthlyRides[] = Ride::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        // ── Recent Users ───────────────────────────────────────────
        $recentUsers = User::orderBy('created_at', 'desc')
            ->take(5)
            ->get(['id', 'name', 'email', 'created_at', 'status']);

        // ── Recent Bookings ────────────────────────────────────────
        $recentBookings = Booking::with(['user:id,name', 'car:id,car_name'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // ── Recent Rides ───────────────────────────────────────────
        $recentRides = Ride::with(['user:id,name', 'car:id,car_name'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // ── Recent Contact Messages ────────────────────────────────
        $recentMessages = ContactMessage::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // ── Revenue Estimate ───────────────────────────────────────
        $totalRevenue = Booking::sum('total_amount') ?? 0;
        $revenueThisMonth = Booking::where('created_at', '>=', $startOfMonth)->sum('total_amount') ?? 0;

        $rideRevenue = RideBooking::join('rides', 'ride_bookings.ride_id', '=', 'rides.id')
            ->sum('rides.fare') ?? 0;

        // ── Top Cars ──────────────────────────────────────────────
        $topCars = Car::withCount('bookings')
            ->orderByDesc('bookings_count')
            ->take(5)
            ->get(['id', 'car_name', 'brand', 'model']);

        return [
            // Core stats
            'totalUsers' => $totalUsers,
            'totalCars' => $totalCars,
            'totalRides' => $totalRides,
            'totalBookings' => $totalBookings,
            'totalRideBookings' => $totalRideBookings,
            'totalContactMessages' => $totalContactMessages,
            'totalBlogPosts' => $totalBlogPosts,

            // This month
            'usersThisMonth' => $usersThisMonth,
            'carsThisMonth' => $carsThisMonth,
            'ridesThisMonth' => $ridesThisMonth,
            'bookingsThisMonth' => $bookingsThisMonth,
            'rideBookingsThisMonth' => $rideBookingsThisMonth,
            'messagesThisMonth' => $messagesThisMonth,

            // % Changes
            'userChange' => $userChange,
            'bookingChange' => $bookingChange,
            'rideChange' => $rideChange,

            // Status distributions
            'bookingsByStatus' => $bookingsByStatus,
            'rideBookingsByStatus' => $rideBookingsByStatus,
            'ridesByStatus' => $ridesByStatus,

            // Monthly trends
            'monthlyLabels' => $monthlyLabels,
            'monthlyUsers' => $monthlyUsers,
            'monthlyBookings' => $monthlyBookings,
            'monthlyRides' => $monthlyRides,

            // Recent items
            'recentUsers' => $recentUsers,
            'recentBookings' => $recentBookings,
            'recentRides' => $recentRides,
            'recentMessages' => $recentMessages,

            // Revenue
            'totalRevenue' => $totalRevenue,
            'revenueThisMonth' => $revenueThisMonth,
            'rideRevenue' => $rideRevenue,

            // Top cars
            'topCars' => $topCars,

            // Timestamp
            'lastUpdated' => now()->format('H:i:s'),
        ];
    }
}
