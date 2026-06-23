<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
// dd("d");
        return view('frontend.webviews.index');
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
        return view('frontend.webviews.price');
    }
    public function car()
    {
        return view('frontend.webviews.car');
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
