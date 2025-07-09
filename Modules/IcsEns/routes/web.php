<?php

use Illuminate\Support\Facades\Route;
use Modules\IcsEns\Http\Controllers\IcsEnsController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('icsens', IcsEnsController::class)->names('icsens');
// });


Route::middleware(['auth'])->group(function () {
    Route::resource('ics_ens', IcsEnsController::class);
    Route::post('/filing_fetch', [IcsEnsController::class, 'filingFetch']);
});