<?php

use App\Livewire\Frontend\About\About;
use App\Livewire\Frontend\Contact\Contact;
use App\Livewire\Frontend\Features\Features;
use App\Livewire\Frontend\Gallery\Gallery;
use App\Livewire\Frontend\Home\Home;
use App\Livewire\Frontend\Product\Product;
use App\Livewire\Frontend\Service\Service;
use App\Livewire\Frontend\Team\Team;
use App\Livewire\Frontend\Testimonial\Testimonial;
use Illuminate\Support\Facades\Route;

// Define the home route for frontend
Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/service', Service::class)->name('service');
Route::get('/product', Product::class)->name('product');
Route::get('/gallery', Gallery::class)->name('gallery');
Route::get('/features', Features::class)->name('feature');
Route::get('/team', Team::class)->name('team');
Route::get('/testimonial', Testimonial::class)->name('testimonial');
Route::get('/contact-us', Contact::class)->name('contact');