<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home');
    }

    public function page()
    {
        return view('site.page');
    }

    public function reviews()
    {
        return view('site.reviews');
    }

    public function unity()
    {
        return view('site.unity');
    }

    public function blog()
    {
        return view('site.blog.index');
    }

    public function blogShow()
    {
        return view('site.blog.show');
    }

    public function products()
    {
        return view('site.products.index');
    }

    public function productsShow()
    {
        return view('site.products.show');
    }

    public function services()
    {
        return view('site.services.index');
    }

    public function servicesShow()
    {
        return view('site.services.show');
    }



}
