<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class HomeController extends Controller
{
    //
    public function index()
{
    $cars = Car::with('user')->latest()->get();

    return view('frontend.webviews.index', compact('cars'));
}
    public function about()
    {
        return view('frontend.webviews.about');
    }
    public function contact()
    {
        return view('frontend.webviews.contact');
    }
    public function blog()
    {
        return view('frontend.webviews.blog');
    }
    public function service()
    {
        return view('frontend.webviews.service');
    }
    public function price()
{
    $cars = Car::all();

    return view('frontend.webviews.price', compact('cars'));
}

    public function car()
    {
    $cars = Car::with('user')
        ->latest()
        ->paginate(9);

    return view('frontend.webviews.car', compact('cars'));
    }
    public function carDetails()
    {
        return view('frontend.webviews.car-details');
    }
    public function blogDetails()
    {
        return view('frontend.webviews.blog-details');
    }
    public function adminHome()
    {
        return view('admin.frontend.webview.home');
    }
    public function admintabels()
    {
        return view('admin.frontend.webview.tabels');
    }
    public function adminforms()
    {
        return view('admin.frontend.webview.forms');
    }
}
