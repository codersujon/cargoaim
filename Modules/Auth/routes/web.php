<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\Auth\Http\Controllers\LoginPageSliderController;
use Modules\Auth\Http\Controllers\ProfileController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('auths', AuthController::class)->names('auth');
// });


// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('user.login');
    Route::post('/user/login', [LoginController::class, 'store'])->name('user.login.store');
});

// Authenticated Routes 
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

    Route::resource('login_page_slider', LoginPageSliderController::class);
    Route::get('lps_fetch', [LoginPageSliderController::class, 'fetch']);
    Route::post('active_status', [LoginPageSliderController::class, 'status'])->name('active.status');
    
    Route::resource('profile', ProfileController::class);
    Route::get('profile_fetch', [ProfileController::class, 'fetch']);
});