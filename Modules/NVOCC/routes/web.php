<?php

use Illuminate\Support\Facades\Route;
use Modules\NVOCC\Http\Controllers\NVOCCController;

// NVOCC
Route::middleware(['auth'])->group(function () {
    Route::get('/nvocc/index', [NVOCCController::class, 'index']);
});