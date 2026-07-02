<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [

        'user_id',

        'car_name',

        'brand',

        'model',

        'registration_number',

        'manufacturing_year',

        'fuel_type',

        'transmission',

        'color',

        'rent_per_hour',

        'rent_per_day',

        'rent_per_month',

        'fuel_surcharge',

        'description',

        'image'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function rides()
    {
        return $this->hasMany(Ride::class);
    }
}
