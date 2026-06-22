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
}
