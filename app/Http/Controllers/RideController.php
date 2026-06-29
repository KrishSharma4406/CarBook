<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}