<?php

use App\Livewire\Admin\Dairy\CreateUser;
use App\Livewire\Admin\Dairy\MilkDeposit;
use App\Livewire\Admin\Dairy\Setup;
use App\Livewire\Admin\Home\Home;
use Illuminate\Support\Facades\Route;

Route::get('/home', Home::class)->name('home');
Route::get('/farmer/create', CreateUser::class)->name('farmer.create');
Route::get('/farmer/milk/deposit', MilkDeposit::class)->name('farmer.milk.deposit');
Route::get('/setup', Setup::class)->name('setup');

