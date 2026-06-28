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

Route::get('/admin/users', [UserController::class, 'index'])
    ->name('admin-users');

Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit');

Route::any('/admin/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
    ->name('users.toggleStatus');

Route::put('/admin/users/{user}/update', [UserController::class, 'update'])
    ->name('users.update');

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
});


Route::get('/cars', [AdminCarController::class, 'index'])->name('admin.cars.index');

Route::delete('/cars/{car}', [AdminCarController::class, 'destroy'])->name('admin.cars.destroy');

Route::get('/cars/{car}', [AdminCarController::class, 'show'])->name('admin.cars.show');

Route::get('/car/{car}', [CarController::class, 'show'])->name('car.show');

Route::get('admin/cars', [AdminCarController::class, 'index'])->name('admin.cars.index');

require __DIR__ . '/auth.php';
