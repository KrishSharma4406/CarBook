<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

        'duration',

        'available_seats',

        'fare',

        'description',

        'status'
    ];

    /**
     * Auto-expire rides whose travel_date has passed.
     * Runs once per request cycle when Ride model is booted.
     */
    protected static function booted()
    {
        // Mark all past rides that are still 'active' as 'expired'
        static::where('status', 'active')
            ->whereDate('travel_date', '<', Carbon::today())
            ->update(['status' => 'expired']);
    }

    /**
     * Scope: only upcoming rides (travel_date >= today AND status = active).
     * Use this for regular user-facing queries.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'active')
            ->whereDate('travel_date', '>=', Carbon::today());
    }

    /**
     * Scope: only expired rides.
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    /**
     * Check if this ride has expired.
     */
    public function getIsExpiredAttribute(): bool
    {
        return $this->status === 'expired'
            || Carbon::parse($this->travel_date)->lt(Carbon::today());
    }

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
