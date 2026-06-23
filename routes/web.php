<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UI\HomeController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;

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
Route::get('/admin/login', [AdminLoginController::class,'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class,'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class,'logout'])->name('admin.logout');
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


Route::get('/admin/register', function () {
    return view('admin.auth.register');
})->name('admin.register');

Route::get('/admin/login', [AdminLoginController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'login'])
    ->name('admin.login.submit');

Route::any('/admin/logout', [AdminLoginController::class, 'logout'])
    ->name('admin.logout');

require __DIR__.'/auth.php';
