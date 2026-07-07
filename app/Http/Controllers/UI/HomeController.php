<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\HomePage;
use App\Models\AboutPage;
use App\Models\ServicesPage;
use App\Models\BlogPage;
use App\Models\ContactPage;

class HomeController extends Controller
{
    //
    public function index()
{
    $home = HomePage::first();
    $cars = Car::with('user')->latest()->get();

    return view('frontend.webviews.index', compact('home', 'cars'));
}
    public function about()
    {
        $about = AboutPage::first();
        return view('frontend.webviews.about', compact('about'));
    }
    public function contact()
    {
        $contact = ContactPage::first();
        return view('frontend.webviews.contact', compact('contact'));
    }
    public function blog()
    {
        $blog = BlogPage::first();
        return view('frontend.webviews.blog', compact('blog'));
    }
    public function service()
    {
        $services = ServicesPage::first();
        return view('frontend.webviews.service', compact('services'));
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
