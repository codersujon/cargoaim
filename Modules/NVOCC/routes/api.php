<?php

use Illuminate\Support\Facades\Route;
use Modules\NVOCC\Http\Controllers\NVOCCController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('nvoccs', NVOCCController::class)->names('nvocc');
});
