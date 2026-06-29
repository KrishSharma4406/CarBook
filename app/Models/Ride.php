<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $fillable = [

        'user_id',

        'pickup_location',

        'destination',

        'travel_date',

        'travel_time',

        'available_seats',

        'fare',

        'vehicle_name',

        'vehicle_number',

        'description',

        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}