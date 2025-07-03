<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\MenuController;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Core\Http\Controllers\DashboardController;
use Modules\Core\Http\Controllers\ColorManageController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('cores', CoreController::class)->names('core');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    Route::resource('color', ColorManageController::class);
    Route::get('/get-color-pattern/{pattern}', [ColorManageController::class, 'getColorPattern']);
    Route::get('save_as_color/{id}', [ColorManageController::class, 'saveColor']);
});


// Menu
Route::middleware(['auth'])->group(function () {
    Route::resource('menu', MenuController::class)->except(['show']);
});