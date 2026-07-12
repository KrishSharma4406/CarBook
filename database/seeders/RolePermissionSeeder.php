<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            // Dashboard
            'dashboard.view',

            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // Cars
            'cars.view',
            'cars.create',
            'cars.edit',
            'cars.delete',

            // Rides
            'rides.view',
            'rides.create',
            'rides.edit',
            'rides.delete',

            // Bookings
            'bookings.view',
            'bookings.create',
            'bookings.edit',
            'bookings.delete',

            // Pricing
            'pricing.view',
            'pricing.edit',
            'price.view',

            // Contact
            'contact.view',
            'contact.delete',

            // Feedback
            'feedback.view',
            'feedback.delete',

            // Roles
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            // Permissions
            'permissions.view',
            'permissions.create',
            'permissions.edit',
            'permissions.delete',

            // Profile
            'profile.view',
            'profile.edit',
            'profile.delete',

            // Ride Booking
            'ride-booking.create',
            'ride-booking.view',
            'ride-booking.edit',
            'ride-booking.delete',

            // Booking Summary
            'booking-summary.view',
            'booking-summary.create',

            // My Bookings
            'my-bookings.view',
            'my-bookings.cancel',

            // Extra Admin Views
            'forms.view',
            'tables.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $user = Role::firstOrCreate([
            'name' => 'User',
            'guard_name' => 'web',
        ]);

        // Super Admin gets every permission
        $superAdmin->syncPermissions(Permission::all());

        // Default Admin permissions
        $admin->syncPermissions([
            'dashboard.view',

            'users.view',
            'users.create',
            'users.edit',

            'cars.view',
            'cars.create',
            'cars.edit',

            'rides.view',
            'rides.create',
            'rides.edit',

            'bookings.view',
            'bookings.edit',

            'pricing.view',
            'price.view',

            'contact.view',

            'feedback.view',

            'forms.view',
            'tables.view',
        ]);

        // User gets all frontend/interaction permissions
        $user->syncPermissions([
            'dashboard.view',
            
            'profile.view',
            'profile.edit',
            'profile.delete',

            'cars.view',
            'cars.create',
            'cars.edit',
            'cars.delete',

            'rides.view',
            'rides.create',
            'rides.edit',
            'rides.delete',

            'ride-booking.create',
            'ride-booking.view',
            'ride-booking.edit',
            'ride-booking.delete',

            'price.view',

            'booking-summary.view',
            'booking-summary.create',

            'my-bookings.view',
            'my-bookings.cancel',
        ]);
    }
}