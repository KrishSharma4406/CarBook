<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RideBooking;
use Carbon\Carbon;
use App\Models\Car;

class RideController extends Controller
{
    public function __construct()
{
    $this->middleware('permission:rides.view')->only([
        'index',
        'myRides',
        'show'
    ]);

    $this->middleware('permission:rides.create')->only([
        'create',
        'store'
    ]);

    $this->middleware('permission:rides.edit')->only([
        'edit',
        'update'
    ]);

    $this->middleware('permission:rides.delete')->only([
        'destroy'
    ]);

    $this->middleware('permission:dashboard.view')->only([
        'dashboard'
    ]);
}

    public function create()
    {
        $cars = auth()->user()->cars;

        return view('frontend.webviews.offer-ride', compact('cars'));
    }

    public function store(Request $request)
    {
        $car = auth()->user()->cars()->findOrFail($request->car_id);

        $request->validate([

            'pickup_location' => 'required',

            'car_id' => 'required|exists:cars,id',

            'destination' => 'required',

            'travel_date' => 'required|date',

            'travel_time' => 'required',

            'available_seats' => 'required|integer|min:1|max:8',

            'fare' => 'required|numeric|min:0',

            'description' => 'nullable'
        ]);

        Ride::create([
            'user_id' => auth()->id(),
            'car_id' => $request->car_id,

            'pickup_location' => $request->pickup_location,
            'destination' => $request->destination,

            'travel_date' => $request->travel_date,
            'travel_time' => $request->travel_time,

            'available_seats' => $request->available_seats,

            'fare' => $request->fare,

            'vehicle_name' => $car->brand . ' ' . $car->model,

            'vehicle_number' => $car->registration_number,

            'description' => $request->description,

            'status' => 'active',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Ride Offered Successfully!');
    }

    public function index(Request $request)
    {
        $rides = Ride::with('user')

            ->when($request->pickup, function ($q) use ($request) {

                $q->where('pickup_location', 'LIKE', '%' . $request->pickup . '%');
            })

            ->when($request->destination, function ($q) use ($request) {

                $q->where('destination', 'LIKE', '%' . $request->destination . '%');
            })

            ->when($request->travel_date, function ($q) use ($request) {

                $q->where('travel_date', $request->travel_date);
            })

            ->where('status', 'active')

            ->latest()

            ->get();

        return view('frontend.webviews.view-rides', compact('rides'));
    }

    public function myRides()
    {
        $rides = Ride::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.webviews.my-rides', compact('rides'));
    }

    public function dashboard()
    {
        $user = auth()->user();

        $totalRides = Ride::where('user_id', $user->id)->count();

        $activeRides = Ride::where('user_id', $user->id)
            ->where('status', 'active')
            ->count();

        $completedRides = Ride::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
            $pendingRequests = null;

        // $pendingRequests = RideBooking::whereHas('ride', function ($query) use ($user) {

        //     $query->where('user_id', $user->id);
        // })
        //     ->where('status', 'pending')
        //     ->count();

        $recentRides = Ride::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $recentRequests = RideBooking::with(['user', 'ride'])
            ->whereHas('ride', function ($query) use ($user) {

                $query->where('user_id', $user->id);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.webviews.dashboard', compact(

            'totalRides',
            'activeRides',
            'completedRides',
            'pendingRequests',
            'recentRides',
            'recentRequests'

        ));
    }

    public function edit(Ride $ride)
    {
        if ($ride->user_id != auth()->id()) {
            abort(403);
        }

        return view('frontend.webviews.edit-ride', compact('ride'));
    }

    public function update(Request $request, Ride $ride)
    {
        if ($ride->user_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'pickup_location' => 'required',
            'destination' => 'required',
            'travel_date' => 'required|date',
            'travel_time' => 'required',
            'available_seats' => 'required|integer|min:1|max:8',
            'fare' => 'required|numeric|min:0',
            'car_id' => 'required|exists:cars,id',
            'description' => 'nullable',
        ]);

        $ride->update($request->all());

        return redirect()
            ->route('rides.my')
            ->with('success', 'Ride Updated Successfully');
    }

    public function destroy(Ride $ride)
    {
        if ($ride->user_id != auth()->id()) {
            abort(403);
        }

        $ride->delete();

        return back()->with('success', 'Ride Deleted Successfully');
    }

    public function show(Ride $ride)
    {
        $ride->load('user', 'car');

        return view('frontend.webviews.ride-details', compact('ride'));
    }

    public function search(Request $request)
    {
        $query = Ride::with('user')
            ->where('status', 'active');

        if ($request->filled('pickup_location')) {
            $query->where('pickup_location', 'LIKE', '%' . $request->pickup_location . '%');
        }

        if ($request->filled('destination')) {
            $query->where('destination', 'LIKE', '%' . $request->destination . '%');
        }

        if ($request->filled('travel_date')) {
            $date = Carbon::parse($request->travel_date)->format('Y-m-d');
            $query->whereDate('travel_date', $date);
        }

        if ($request->filled('travel_time')) {
            try {
                $time = Carbon::parse($request->travel_time)->format('H:i:s');
                $query->whereTime('travel_time', $time);
            } catch (\Exception $e) {
                $query->whereTime('travel_time', $request->travel_time);
            }
        }

        $rides = $query->get();

        return view('frontend.webviews.search', compact('rides'));
    }
}
