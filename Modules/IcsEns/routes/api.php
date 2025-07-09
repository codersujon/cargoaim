<?php

use Illuminate\Support\Facades\Route;
use Modules\IcsEns\Http\Controllers\IcsEnsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('icsens', IcsEnsController::class)->names('icsens');
});
