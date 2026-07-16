<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $attributes = [
        'travel_time' => '00:00:00',
    ];

    protected $fillable = [

        'user_id',

        'car_id',

        'pickup_location',

        'destination',

        'travel_date',

        'available_seats',

        'fare',

        'description',

        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(RideBooking::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
