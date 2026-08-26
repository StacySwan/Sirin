<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Product;
use App\Models\Review;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home', [
            'services' => Service::published()->orderBy('sort')->take(4)->get(),
            'posts' => BlogPost::published()->latest('published_at')->take(3)->get(),
            'reviews' => Review::published()->latest('published_at')->take(3)->get(),
            'products' => Product::published()->orderBy('sort')->take(6)->get(),
        ]);
    }

    public function page(string $slug): View
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('site.page', ['page' => $page]);
    }

    public function reviews(): View
    {
        return view('site.reviews', [
            'reviews' => Review::published()->latest('published_at')->paginate(20),
        ]);
    }

    public function unity()
    {
        return view('site.unity');
    }

    public function blog(): View
    {
        return view('site.blog.index', [
            'posts' => BlogPost::published() //заготовка, которую используем.
                ->with('category')
                ->latest('published_at')
                ->paginate(9),
        ]);
    }

    public function blogShow(string $slug): View
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();

        return view('site.blog.show', ['post' => $post]);
    }

    public function products(): View
    {
        return view('site.products.index', [
            'products' => Product::published()->with('category')->orderBy('sort')->paginate(12),
        ]);
    }

    public function productsShow(string $slug): View
    {
        $product = Product::published()->where('slug', $slug)->firstOrFail();

        return view('site.products.show', ['product' => $product]);
    }

    public function services(): View
    {
        return view('site.services.index', [
            'services' => Service::published()->orderBy('sort')->get(),
        ]);
    }

    public function servicesShow(string $slug): View
    {
        $service = Service::published()->where('slug', $slug)->firstOrFail();

        return view('site.services.show', ['service' => $service]);
    }



}
