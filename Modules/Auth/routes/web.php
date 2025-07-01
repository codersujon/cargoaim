<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\LoginController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('auths', AuthController::class)->names('auth');
// });

Route::get('/', [LoginController::class, 'index'])->name('user.login');
Route::post('/auth/login', [LoginController::class, 'store'])->name('user.login.store');


Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('user.dashboard');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

