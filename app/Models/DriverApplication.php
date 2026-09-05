<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DriverApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'dob',
        'city',
        'state',
        'postal_code',
        'address',
        'license_number',
        'license_expiry',
        'experience_years',
        'license_document',
        'vehicle_type',
        'vehicle_make_model',
        'vehicle_year',
        'vehicle_number',
        'message',
        'status',
        'admin_notes',
        'contacted_at',
    ];

    protected $casts = [
        'dob' => 'date',
        'license_expiry' => 'date',
        'contacted_at' => 'datetime',
        'experience_years' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the badge color class for the application status.
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'badge-warning',
            'contacted' => 'badge-info',
            'approved' => 'badge-success',
            'rejected' => 'badge-danger',
            default => 'badge-secondary',
        };
    }

    public function messages()
    {
        return $this->hasMany(DriverApplicationMessage::class, 'driver_application_id')->oldest();
    }

    public function unreadMessagesForAdmin()
    {
        return $this->messages()->where('sender_type', 'driver')->where('is_read', false)->count();
    }

    public function unreadMessagesForDriver()
    {
        return $this->messages()->where('sender_type', 'admin')->where('is_read', false)->count();
    }
}

