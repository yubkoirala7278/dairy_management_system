<?php

use App\Livewire\Frontend\Home\Home;
use Illuminate\Support\Facades\Route;

// Define the home route for frontend
Route::get('/', Home::class)->name('home');
