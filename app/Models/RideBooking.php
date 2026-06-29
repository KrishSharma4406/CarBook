<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideBooking extends Model
{
    protected $fillable = [
    'ride_id',
    'user_id',
    'seats',
    'booking_status',
    'status'
];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function ride()
    {
        return $this->belongsTo(Ride::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}