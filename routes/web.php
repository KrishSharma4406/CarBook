<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UI\HomeController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminRegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\RideBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\RideController as AdminRideController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [App\Http\Controllers\UI\HomeController::class, 'index'])->name('home');
route::get('/about', [App\Http\Controllers\UI\HomeController::class, 'about'])->name('about');
route::get('/contact', [App\Http\Controllers\UI\HomeController::class, 'contact'])->name('contact');
route::get('/blog', [App\Http\Controllers\UI\HomeController::class, 'blog'])->name('blog');
route::get('/service', [App\Http\Controllers\UI\HomeController::class, 'service'])->name('service');
route::get('/price', [App\Http\Controllers\UI\HomeController::class, 'price'])->name('price');
route::get('/car', [App\Http\Controllers\UI\HomeController::class, 'car'])->name('car');
route::get('/car-details', [App\Http\Controllers\UI\HomeController::class, 'carDetails'])->name('car-details');
route::get('/blog-details', [App\Http\Controllers\UI\HomeController::class, 'blogDetails'])->name('blog-details');
route::get('/admin-home', [App\Http\Controllers\UI\HomeController::class, 'adminHome'])->name('admin-home');
route::get('/admin-tabels', [App\Http\Controllers\UI\HomeController::class, 'admintabels'])->name('admin-tabels');
route::get('/admin-forms', [App\Http\Controllers\UI\HomeController::class, 'adminforms'])->name('admin-forms');
Route::get('/admin/login', [AdminLoginController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/pricing',[HomeController::class,'pricing'])->name('pricing');

// Route::middleware('admin')->group(function () {

//     Route::get('/admin/home', function () {
//         return view('admin.frontend.webview.home');
//     })->name('admin.home');

// });
Route::get('/dashboard', function () {

    return redirect()->route('home');
})->name('dashboard');

//  Route::get('/dashboard', function () {
// // dd(dd);
//     return view('frontend.webviews.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/home', function () {
    return view('admin.frontend.webview.home');
})->name('admin.home');

Route::get('/admin/login', [AdminLoginController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'login'])
    ->name('admin.login.submit');

Route::any('/admin/logout', [AdminLoginController::class, 'logout'])
    ->name('admin.logout');

Route::get('/admin/register', [AdminRegisterController::class, 'create'])
    ->name('admin.register');

Route::post('/admin/register', [AdminRegisterController::class, 'store'])
    ->name('admin.register.store');

Route::middleware('permission:users.view')->group(function () {

    Route::get('/admin/users', [UserController::class, 'index'])
        ->name('admin-users');

});

Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit');

Route::any('/admin/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
    ->name('users.toggleStatus');

Route::put('/admin/users/{user}/update', [UserController::class, 'update'])
    ->name('users.update');

Route::middleware('permission:rides.view')->group(function () {

    Route::resource('rides', RideController::class);

});

Route::get('/admin/rides/{ride}', [AdminRideController::class,'show'])
    ->name('admin.rides.show');

Route::middleware('permission:bookings.view')->group(function () {

    Route::resource('bookings', BookingController::class);

});

Route::get('/admin/bookings/{booking}',[AdminBookingController::class,'show'])
    ->name('admin.bookings.show');

Route::post('/register/send-otp', [RegisteredUserController::class, 'sendOtp'])->name('register.otp');

Route::get('/verify-otp', function () {
    return view('auth.verify-otp');
})->name('verify.otp');

Route::post('/verify-otp', [RegisteredUserController::class, 'verifyOtp'])->name('verify.otp.post');

Route::get('/test-mail', function () {

    try {

        Mail::raw('Laravel Test Email', function ($message) {
            $message->to('sharmasourav320@gmail.com')
                ->subject('Laravel Test');
        });

        return 'Mail Sent Successfully';
    } catch (\Exception $e) {

        return $e->getMessage();
    }
});

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::get('/profile/car', [CarController::class, 'edit'])->name('car.edit');

Route::post('/profile/car', [CarController::class, 'save'])->name('car.save');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Car
    Route::get('/profile/car', [CarController::class, 'edit'])
        ->name('car.edit');

    Route::post('/profile/car', [CarController::class, 'save'])
        ->name('car.save');

    Route::get('/profile/car/add', [CarController::class,'create'])
        ->name('car.create');

    Route::post('/profile/car/store', [CarController::class,'save'])
        ->name('car.store');

    Route::get('/profile/car/{car}/edit',[CarController::class,'editCar'])
        ->name('car.edit.single');

    Route::delete('/profile/car/{car}',[CarController::class,'destroy'])
        ->name('car.delete');

    Route::delete('/profile/car/{car}', [CarController::class, 'destroy'])
        ->name('car.destroy');

    Route::get('/offer-ride',[RideController::class,'create'])
        ->name('offer.ride');

    Route::post('/offer-ride',[RideController::class,'store'])
        ->name('offer.ride.store');

    Route::get('/view-rides',[RideController::class,'index'])
        ->name('rides.index');

    Route::get('/my-rides',[RideController::class,'myRides'])
        ->name('rides.my');

    Route::get('/my-rides/{ride}/edit', [RideController::class, 'edit'])
        ->name('rides.edit');

    Route::put('/my-rides/{ride}', [RideController::class, 'update'])
        ->name('rides.update');

    Route::delete('/my-rides/{ride}', [RideController::class, 'destroy'])
        ->name('rides.destroy');

    Route::post('/rides/{ride}/book',
        [RideBookingController::class,'store'])
        ->name('rides.book');

    Route::post('/rides/{ride}/confirm',[BookingController::class,'confirm'])
        ->name('booking.confirm');

    Route::get('/ride-requests',[RideBookingController::class,'requests'])
        ->name('rides.requests');

    Route::get('/rides/search', [RideController::class, 'search'])
        ->name('rides.search');

    Route::get('/rides/{ride}', [RideController::class, 'show'])
        ->name('rides.show');

    Route::post('/booking/{booking}/accept',[RideBookingController::class,'accept'])
        ->name('booking.accept');

    Route::post('/booking/{booking}/reject',[RideBookingController::class,'reject'])
        ->name('booking.reject');

    Route::get('/dashboard',[RideController::class,'dashboard'])
        ->name('dashboard');

           Route::get('/rides/{ride}/booking', [BookingController::class, 'summary'])
        ->name('booking.summary');

    Route::get('/my-bookings', [BookingController::class, 'myBookings'])
        ->name('booking.my');

    Route::post('/booking/{booking}/cancel',
    [BookingController::class,'cancel'])
    ->name('booking.cancel');
});

// Route::middleware('permission:roles.view')->group(function () {

//     Route::resource('roles', RoleController::class);

// });

// Route::middleware(['permission:permissions.view'])->group(function () {
//     Route::resource('permissions', PermissionController::class);
// });

Route::get('/admin/users/{user}/role',[UserController::class,'editRole'])
    ->name('users.role.edit');

Route::put('/admin/users/{user}/role',[UserController::class,'updateRole'])->name('users.role.update');


Route::get('permission:cars.view', [AdminCarController::class, 'index'])->name('admin.cars.index');

Route::get('/cars/{car}', [AdminCarController::class, 'show'])->name('admin.cars.show');

Route::get('/car/{car}', [CarController::class, 'show'])->name('car.show');

Route::middleware('/cars')->group(function () {

    Route::resource('cars', CarController::class);

});

Route::middleware(['permission:users.view'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])
        ->name('admin-users');
});

Route::middleware(['permission:users.create'])->group(function () {
    Route::get('/admin/users/create', [UserController::class, 'create']);
    Route::post('/admin/users', [UserController::class, 'store']);
});

Route::middleware(['permission:users.edit'])->group(function () {
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit']);
    Route::put('/admin/users/{user}', [UserController::class, 'update']);
});

Route::middleware(['permission:users.delete'])->group(function () {
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy']);
});

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {

        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

    });

require __DIR__ . '/auth.php';
