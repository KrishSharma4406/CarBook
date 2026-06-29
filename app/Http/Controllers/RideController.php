<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RideBooking;

class RideController extends Controller
{
    public function create()
    {
        return view('frontend.webviews.offer-ride');
    }

    public function store(Request $request)
    {

        $request->validate([

            'pickup_location'=>'required',

            'destination'=>'required',

            'travel_date'=>'required|date',

            'travel_time'=>'required',

            'available_seats'=>'required|integer|min:1|max:8',

            'fare'=>'required|numeric|min:0',

            'vehicle_name'=>'required',

            'vehicle_number'=>'required',

            'description'=>'nullable'
        ]);

        Ride::create([

            'user_id'=>Auth::id(),

            'pickup_location'=>$request->pickup_location,

            'destination'=>$request->destination,

            'travel_date'=>$request->travel_date,

            'travel_time'=>$request->travel_time,

            'available_seats'=>$request->available_seats,

            'fare'=>$request->fare,

            'vehicle_name'=>$request->vehicle_name,

            'vehicle_number'=>$request->vehicle_number,

            'description'=>$request->description,

            'status'=>'active'
        ]);

        return redirect()
            ->back()
            ->with('success','Ride Offered Successfully!');
    }

    public function index(Request $request)
    {

        $rides = Ride::with('user')

        ->when($request->pickup,function($q) use($request){

            $q->where('pickup_location','LIKE','%'.$request->pickup.'%');

        })

        ->when($request->destination,function($q) use($request){

            $q->where('destination','LIKE','%'.$request->destination.'%');

        })

        ->when($request->travel_date,function($q) use($request){

            $q->where('travel_date',$request->travel_date);

        })

        ->where('status','active')

        ->latest()

        ->get();

        return view('frontend.webviews.view-rides',compact('rides'));
    }

    public function myRides()
    {
        $rides = Ride::where('user_id',Auth::id())
            ->latest()
            ->get();

        return view('frontend.webviews.my-rides',compact('rides'));
    }

    public function dashboard()
{
    $user = auth()->user();

    $totalRides = Ride::where('user_id',$user->id)->count();

    $activeRides = Ride::where('user_id',$user->id)
        ->where('status','active')
        ->count();

    $completedRides = Ride::where('user_id',$user->id)
        ->where('status','completed')
        ->count();

    $pendingRequests = RideBooking::whereHas('ride',function($query) use($user){

        $query->where('user_id',$user->id);

    })
    ->where('status','pending')
    ->count();

    $recentRides = Ride::where('user_id',$user->id)
        ->latest()
        ->take(5)
        ->get();

    $recentRequests = RideBooking::with(['user','ride'])
        ->whereHas('ride',function($query) use($user){

            $query->where('user_id',$user->id);

        })
        ->latest()
        ->take(5)
        ->get();

    return view('frontend.webviews.dashboard',compact(

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

        'pickup_location'=>'required',

        'destination'=>'required',

        'travel_date'=>'required',

        'travel_time'=>'required',

        'available_seats'=>'required',

        'fare'=>'required',

        'vehicle_name'=>'required',

        'vehicle_number'=>'required'
    ]);

    $ride->update($request->all());

    return redirect()
            ->route('rides.my')
            ->with('success','Ride Updated Successfully');
}

public function destroy(Ride $ride)
{
    if ($ride->user_id != auth()->id()) {
        abort(403);
    }

    $ride->delete();

    return back()->with('success','Ride Deleted Successfully');
}

public function show(Ride $ride)
{
    $ride->load('user');

    return view('frontend.webviews.ride-details', compact('ride'));
}
}