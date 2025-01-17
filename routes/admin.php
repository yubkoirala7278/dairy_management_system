<?php

use App\Livewire\Admin\Dairy\Accounting;
use App\Livewire\Admin\Dairy\CreateUser;
use App\Livewire\Admin\Dairy\MilkDeposit;
use App\Livewire\Admin\Dairy\MilkReport;
use App\Livewire\Admin\Dairy\Setup;
use App\Livewire\Admin\Financial\Transaction;
use App\Livewire\Admin\Home\Home;
use App\Livewire\Admin\Pdf\MilkDeposit as PdfMilkDeposit;
use App\Livewire\Admin\Pdf\PrintUsers;
use App\Livewire\Admin\Product\Order;
use App\Livewire\Admin\Product\Product;
use Illuminate\Support\Facades\Route;

Route::get('/home', Home::class)->name('home');
Route::get('/farmer/create', CreateUser::class)->name('farmer.create');
Route::get('/farmer/milk/deposit', MilkDeposit::class)->name('farmer.milk.deposit');
Route::get('/setup', Setup::class)->name('setup');
Route::get('/milk-deposit-report',MilkReport::class)->name('milk.deposit.report');
Route::get('/product',Product::class)->name('product');
Route::get('/orders',Order::class)->name('order');
Route::get('/transaction',Transaction::class)->name('transaction');
Route::get('/milk-deposit-income',Accounting::class)->name('accounting');


// print
Route::get('/users/print/{search?}', PrintUsers::class)->name('users.print');
Route::get('/milk-deposit/print/{milk_deposit_date}/{milk_deposit_time}/{search?}', PdfMilkDeposit::class)->name('milk.deposit.print');
