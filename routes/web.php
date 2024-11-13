<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// =========== frontend ============
Route::name('frontend.')->group(function () {
    require __DIR__ . '/frontend.php';
});
// ========= end of frontend ========

// ======= auth =======
Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);
// ==== end of auth ====

// ======= admin =========
Route::middleware(['auth', 'auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    require __DIR__ . '/admin.php';
});
// ======== end of admin ====

// Fallback route to handle unmatched URLs
Route::fallback(function () {
   return view('livewire.frontend.error.error-page');
});
