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
        $home = HomePage::first() ?? new HomePage([
            'hero_title' => 'Fast & Easy Way To Rent A Car',
            'hero_subtitle' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'video_url' => '#',
            'video_text' => 'Easy steps for renting a car',
            'about_subtitle' => 'About us',
            'about_title' => 'Welcome to Carbook',
            'about_description' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'services_subtitle' => 'Services',
            'services_title' => 'Our Latest Services',
            'service_1_icon' => 'flaticon-wedding-car',
            'service_1_title' => 'Wedding Ceremony',
            'service_1_desc' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'service_2_icon' => 'flaticon-transportation',
            'service_2_title' => 'City Transfer',
            'service_2_desc' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'service_3_icon' => 'flaticon-car',
            'service_3_title' => 'Airport Transfer',
            'service_3_desc' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'service_4_icon' => 'flaticon-transportation',
            'service_4_title' => 'Whole City Tour',
            'service_4_desc' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'cta_title' => 'Do You Want To Earn With Us? So Don\'t Be Late.',
            'cta_button_text' => 'Become A Driver',
            'cta_button_url' => '#',
            'testimonial_subtitle' => 'Testimonial',
            'testimonial_title' => 'Happy Clients',
            'blog_subtitle' => 'Blog',
            'blog_title' => 'Recent Blog',
            'counter_1_number' => 60,
            'counter_1_label' => 'Year Experienced',
            'counter_2_number' => 1090,
            'counter_2_label' => 'Total Cars',
            'counter_3_number' => 2590,
            'counter_3_label' => 'Happy Customers',
            'counter_4_number' => 67,
            'counter_4_label' => 'Total Branches',
        ]);
        $cars = Car::with('user')->latest()->get();

        return view('frontend.webviews.index', compact('home', 'cars'));
    }
    public function about()
    {
        $about = AboutPage::first() ?? new AboutPage([
            'hero_title'           => 'About Us',
            'about_subtitle'       => 'About us',
            'about_title'          => 'Welcome to Carbook',
            'about_description'    => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'cta_title'            => 'Do You Want To Earn With Us? So Don\'t Be Late.',
            'cta_button_text'      => 'Become A Driver',
            'cta_button_url'       => '#',
            'testimonial_subtitle' => 'Testimonial',
            'testimonial_title'    => 'Happy Clients',
            'counter_1_number'     => 60,
            'counter_1_label'      => 'Year Experienced',
            'counter_2_number'     => 1090,
            'counter_2_label'      => 'Total Cars',
            'counter_3_number'     => 2590,
            'counter_3_label'      => 'Happy Customers',
            'counter_4_number'     => 67,
            'counter_4_label'      => 'Total Branches',
        ]);
        return view('frontend.webviews.about', compact('about'));
    }
    public function contact()
    {
        $contact = ContactPage::first() ?? new ContactPage([
            'hero_title'       => 'Contact Us',
            'contact_subtitle' => 'Contact',
            'contact_title'    => 'Contact Us',
            'contact_address'  => '198 West 21th Street, Suite 721 New York NY 10016',
            'contact_phone'    => '+ 1235 2355 98',
            'contact_email'    => 'info@yoursite.com',
        ]);
        return view('frontend.webviews.contact', compact('contact'));
    }
    public function blog()
    {
        $blog = BlogPage::first() ?? new BlogPage([
            'hero_title'    => 'Our Blog',
            'blog_subtitle' => 'Blog',
            'blog_title'    => 'Recent Blog',
        ]);
        return view('frontend.webviews.blog', compact('blog'));
    }
    public function service()
    {
        $services = ServicesPage::first() ?? new ServicesPage([
            'hero_title'        => 'Our Services',
            'services_subtitle' => 'Services',
            'services_title'    => 'Our Latest Services',
            'service_1_icon'    => 'flaticon-wedding-car',
            'service_1_title'   => 'Wedding Ceremony',
            'service_1_desc'    => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'service_2_icon'    => 'flaticon-transportation',
            'service_2_title'   => 'City Transfer',
            'service_2_desc'    => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'service_3_icon'    => 'flaticon-car',
            'service_3_title'   => 'Airport Transfer',
            'service_3_desc'    => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'service_4_icon'    => 'flaticon-transportation',
            'service_4_title'   => 'Whole City Tour',
            'service_4_desc'    => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.',
            'cta_title'         => 'Do You Want To Earn With Us? So Don\'t Be Late.',
            'cta_button_text'   => 'Become A Driver',
            'cta_button_url'    => '#',
        ]);
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
