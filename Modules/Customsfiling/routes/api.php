<?php

use Illuminate\Support\Facades\Route;
use Modules\Customsfiling\Http\Controllers\CustomsfilingController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('customsfilings', CustomsfilingController::class)->names('customsfiling');
});
