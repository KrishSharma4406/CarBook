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
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\ServicesPageController;
use App\Http\Controllers\Admin\BlogPageController;
use App\Http\Controllers\Admin\ContactPageController;

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
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');

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

Route::any('/admin/logout', [AdminLoginController::class, 'logout'])
    ->name('admin.logout');

Route::get('/admin/register', [AdminRegisterController::class, 'create'])
    ->name('admin.register');

Route::post('/admin/register', [AdminRegisterController::class, 'store'])
    ->name('admin.register.store');

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

    Route::get('/profile/car/add', [CarController::class, 'create'])
        ->name('car.create');

    Route::post('/profile/car/store', [CarController::class, 'save'])
        ->name('car.store');

    Route::get('/profile/car/{car}/edit', [CarController::class, 'editCar'])
        ->name('car.edit.single');

    Route::delete('/profile/car/{car}', [CarController::class, 'destroy'])
        ->name('car.delete');

    Route::delete('/profile/car/{car}', [CarController::class, 'destroy'])
        ->name('car.destroy');

    Route::get('/offer-ride', [RideController::class, 'create'])
        ->name('offer.ride');

    Route::post('/offer-ride', [RideController::class, 'store'])
        ->name('offer.ride.store');

    Route::get('/view-rides', [RideController::class, 'index'])
        ->name('rides.index');

    Route::get('/my-rides', [RideController::class, 'myRides'])
        ->name('rides.my');

    Route::get('/my-rides/{ride}/edit', [RideController::class, 'edit'])
        ->name('rides.edit');

    Route::put('/my-rides/{ride}', [RideController::class, 'update'])
        ->name('rides.update');

    Route::delete('/my-rides/{ride}', [RideController::class, 'destroy'])
        ->name('rides.destroy');

    Route::post(
        '/rides/{ride}/book',
        [RideBookingController::class, 'store']
    )
        ->name('rides.book');

    Route::post('/rides/{ride}/confirm', [BookingController::class, 'confirm'])
        ->name('booking.confirm');

    Route::get('/ride-requests', [RideBookingController::class, 'requests'])
        ->name('rides.requests');

    Route::get('/rides/search', [RideController::class, 'search'])
        ->name('rides.search');

    Route::get('/rides/{ride}', [RideController::class, 'show'])
        ->name('rides.show');

    Route::post('/booking/{booking}/accept', [RideBookingController::class, 'accept'])
        ->name('booking.accept');

    Route::post('/booking/{booking}/reject', [RideBookingController::class, 'reject'])
        ->name('booking.reject');

    Route::get('/dashboard', [RideController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/rides/{ride}/booking', [BookingController::class, 'summary'])
        ->name('booking.summary');

    Route::get('/my-bookings', [BookingController::class, 'myBookings'])
        ->name('booking.my');

    Route::post('/booking/{booking}/cancel',[BookingController::class, 'cancel']
    )
        ->name('booking.cancel');
});



Route::prefix('admin')
    ->middleware(['auth:admin'])
    ->group(function () {

        Route::get('/home', function () {
            return view('admin.frontend.webview.home');
        })->name('admin.home');

        Route::get('/tables', [HomeController::class, 'admintabels'])
            ->middleware('permission:tables.view')
            ->name('admin.tables');

        Route::get('/forms', [HomeController::class, 'adminforms'])
            ->middleware('permission:forms.view')
            ->name('admin.forms');

        // Access Control
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        // User Management
        Route::get('/users', [UserController::class, 'index'])
            ->name('admin-users');

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [UserController::class, 'store'])
            ->name('users.store');

        Route::get('/users/{user}/edit', [UserController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}/update', [UserController::class, 'update'])
            ->name('users.update');

        Route::put('/users/{user}', [UserController::class, 'update'])
            ->name('users.update.alt');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');

        Route::any('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('users.toggleStatus');

        Route::get('/users/{user}/role', [UserController::class, 'editRole'])
            ->name('users.role.edit');

        Route::put('/users/{user}/role', [UserController::class, 'updateRole'])
            ->name('users.role.update');

        // Cars Management
        Route::resource('cars', AdminCarController::class);

        // Rides Management
        Route::get('/rides', [AdminRideController::class, 'index'])
            ->name('admin.rides.index');

        Route::get('/rides/{ride}', [AdminRideController::class, 'show'])
            ->name('admin.rides.show');

        // Bookings Management
        Route::get('/bookings', [AdminBookingController::class, 'index'])
            ->name('admin.bookings.index');

        Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])
            ->name('admin.bookings.show');

        Route::get('/profile', [AdminProfileController::class, 'index'])
            ->name('admin.profile.index');

        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])
            ->name('admin.profile.edit');

        Route::put('/profile/update', [AdminProfileController::class, 'update'])
            ->name('admin.profile.update');

        // Homepage Management
        Route::get('/homepage', [HomePageController::class, 'index'])
            ->name('admin.homepage.index');

        Route::get('/homepage/edit', [HomePageController::class, 'edit'])
            ->name('admin.homepage.edit');

        Route::put('/homepage/update', [HomePageController::class, 'update'])
            ->name('admin.homepage.update');

        // About Page Management
        Route::get('/about-page', [AboutPageController::class, 'index'])
            ->name('admin.about.index');
        Route::get('/about-page/edit', [AboutPageController::class, 'edit'])
            ->name('admin.about.edit');
        Route::put('/about-page/update', [AboutPageController::class, 'update'])
            ->name('admin.about.update');

        // Services Page Management
        Route::get('/services-page', [ServicesPageController::class, 'index'])
            ->name('admin.services.index');
        Route::get('/services-page/edit', [ServicesPageController::class, 'edit'])
            ->name('admin.services.edit');
        Route::put('/services-page/update', [ServicesPageController::class, 'update'])
            ->name('admin.services.update');

        // Blog Page Management
        Route::get('/blog-page', [BlogPageController::class, 'index'])
            ->name('admin.blog.index');
        Route::get('/blog-page/edit', [BlogPageController::class, 'edit'])
            ->name('admin.blog.edit');
        Route::put('/blog-page/update', [BlogPageController::class, 'update'])
            ->name('admin.blog.update');

        // Contact Page Management
        Route::get('/contact-page', [ContactPageController::class, 'index'])
            ->name('admin.contact.index');
        Route::get('/contact-page/edit', [ContactPageController::class, 'edit'])
            ->name('admin.contact.edit');
        Route::put('/contact-page/update', [ContactPageController::class, 'update'])
            ->name('admin.contact.update');

        Route::get('/booking/{car}', [BookingController::class, 'summary'])
            ->name('booking.summary');

        Route::post('/booking/{car}/confirm', [BookingController::class, 'confirm'])
            ->name('booking.confirm');

        Route::get('/booking/success/{booking}', [BookingController::class, 'success'])
            ->name('booking.success');
    });

Route::get('/cars/{car}', [AdminCarController::class, 'show'])->name('admin.cars.show');

Route::get('/car/{car}', [CarController::class, 'show'])->name('car.show');

require __DIR__ . '/auth.php';
