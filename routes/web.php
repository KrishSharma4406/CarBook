<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UI\HomeController;


// Route::get('/', function () {
//     return view('Frontend.Layout.app');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');