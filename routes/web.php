<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SiteController;


Route::get('/',[SiteController::class, 'home'])->name('home');
Route::get('/page/{slug}',[SiteController::class, 'page'])->name('page.show');
Route::get('/reviews',[SiteController::class, 'reviews'])->name('reviews.index');
Route::get('/unity',[SiteController::class, 'unity'])->name('unity');

Route::get('/blog',[SiteController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}',[SiteController::class, 'blogShow'])->name('blog.show');

Route::get('/products',[SiteController::class, 'products'])->name('products.index');
Route::get('/products/{slug}',[SiteController::class, 'productsShow'])->name('products.show');
Route::post('/lead', [LeadController::class, 'store'])->name('lead.store');

Route::get('/services',[SiteController::class, 'services'])->name('services.index');
Route::get('/services/{slug}',[SiteController::class, 'servicesShow'])->name('services.show');

//Route::post('/lead',[SiteController::class, 'lead'])->name('lead');



