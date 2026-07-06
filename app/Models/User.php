<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Ride;
use App\Models\RideBooking;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'profile_image',
        'email_verified_at',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * A user has one car.
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function bookings()
{
    return $this->hasMany(Booking::class);
}

    public function rides()
{
    return $this->hasMany(Ride::class);
}

public function rideBookings()
{
    return $this->hasMany(RideBooking::class);
}

    public function profileImageUrl(): string
    {
        if ($this->profile_image && $this->profile_image !== '0') {
            $filename = basename($this->profile_image);
            $path = public_path('uploads/profile-images/' . $filename);

            if (file_exists($path)) {
                return '/uploads/profile-images/' . $filename;
            }
        }

        return '/UI/images/person_1.jpg';
    }
}