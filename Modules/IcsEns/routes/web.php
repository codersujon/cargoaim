<?php

use Illuminate\Support\Facades\Route;
use Modules\IcsEns\Http\Controllers\IcsEnsController;
use Modules\IcsEns\Http\Controllers\IcsEnsAssetController;
use Modules\IcsEns\Http\Controllers\AllSearchingController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('icsens', IcsEnsController::class)->names('icsens');
// });


Route::middleware(['auth'])->group(function () {

    Route::resource('ics_ens', IcsEnsController::class);
    Route::post('/filing_fetch', [IcsEnsController::class, 'filingFetch']);

    Route::get('/get-hbl-eori-records', [AllSearchingController::class, 'getHBLEoriRecords']);
    Route::get('/get-mbl-eori-records', [AllSearchingController::class, 'getMBLEoriRecords']);
    Route::get('/get-country-code', [AllSearchingController::class, 'getCtryCdeRecords']);
    Route::get('/get-bill-filing', [AllSearchingController::class, 'getBillFileRecords']);
    Route::get('/get-container-size', [AllSearchingController::class, 'getCntrSizeRecords']);
    Route::get('/get-pkg', [AllSearchingController::class, 'getPKGrecords']);
    Route::get('/get-customer-details', [AllSearchingController::class, 'getCstDtlRecords']);
    Route::post('/get-pol-pod-details', [AllSearchingController::class, 'getPolPodDtlRecords']);
    Route::post('get-city', [AllSearchingController::class, 'getCityRecords']);
});