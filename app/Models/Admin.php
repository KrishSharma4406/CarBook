<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard_name = 'web';

    protected static function booted()
    {
        static::created(function ($admin) {
            try {
                if (\Spatie\Permission\Models\Role::where('name', 'Super Admin')->exists()) {
                    if (\App\Models\Admin::count() === 1) {
                        $admin->assignRole('Super Admin');
                    } else {
                        $admin->assignRole('Admin');
                    }
                }
            } catch (\Exception $e) {
                // Ignore
            }
        });
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}