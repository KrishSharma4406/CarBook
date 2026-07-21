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
            $admin = Auth::guard('admin')->user();

            // Super Admin gets unrestricted access
            if ($admin->hasRole('Super Admin')) {
                return true;
            }

            // Other admins: check permission on 'web' guard (where permissions are stored)
            if ($admin->hasPermissionTo($ability)) {
                return true;
            }

            return false;
        }

        return null;
    });

        view()->composer('frontend.common.header', function ($view) {
            if (Auth::check()) {
                $unreadBookingsCount = \App\Models\Notification::where('user_id', Auth::id())
                    ->where('target_tab', 'booking.my')
                    ->where('is_read', false)
                    ->count();

                $unreadRequestsCount = \App\Models\Notification::where('user_id', Auth::id())
                    ->where('target_tab', 'rides.requests')
                    ->where('is_read', false)
                    ->count();

                $unreadChatCount = Auth::user()->unreadChatCount();

                $totalUnreadCount = $unreadBookingsCount + $unreadRequestsCount + $unreadChatCount;

                $view->with([
                    'unreadBookingsCount' => $unreadBookingsCount,
                    'unreadRequestsCount' => $unreadRequestsCount,
                    'unreadChatCount' => $unreadChatCount,
                    'totalUnreadCount' => $totalUnreadCount,
                ]);
            }
        });
    }
}
