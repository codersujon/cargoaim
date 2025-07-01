<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\LoginController;

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
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');
});