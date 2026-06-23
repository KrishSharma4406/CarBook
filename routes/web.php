<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UI\HomeController;


// Route::get('/', function () {
//     return view('Frontend.Layout.app');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/service', [HomeController::class, 'service'])->name('service');
Route::get('/price', [HomeController::class, 'price'])->name('price');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/car', [HomeController::class, 'car'])->name('car');
Route::get('/car-details', [HomeController::class, 'carDetails'])->name('car-details');
Route::get('/blog-details', [HomeController::class, 'blogDetails'])->name('blog-details');

Route::get('/admin', function () {return view('admin.frontend.webview.home');})->name('admin-home');
Route::get('/admin/forms', function () {return view('admin.frontend.webview.forms');})->name('admin-forms');

Route::get('/admin/tabels', function () {return view('admin.frontend.webview.tabels');})->name('admin-tabels');
