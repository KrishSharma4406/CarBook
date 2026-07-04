<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Schema::defaultStringLength(125);
        Gate::before(function ($user, $ability) {

        if (Auth::guard('admin')->check()) {

            return Auth::guard('admin')
                ->user()
                ->hasPermissionTo($ability, 'admin');
        }

        return null;

        
    });
    }
}
