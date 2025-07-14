<?php

use Illuminate\Support\Facades\Route;
use Modules\Customsfiling\Http\Controllers\CustomsfilingController;
use Modules\Customsfiling\Http\Controllers\IcsEnsController;
use Modules\Customsfiling\Http\Controllers\AllSearchingController;
use Modules\Customsfiling\Http\Controllers\CustomerAddressController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('customsfilings', CustomsfilingController::class)->names('customsfiling');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/get-hbl-eori-records', [AllSearchingController::class, 'getHBLEoriRecords']);
    Route::get('/get-mbl-eori-records', [AllSearchingController::class, 'getMBLEoriRecords']);
    Route::get('/get-country-code', [AllSearchingController::class, 'getCtryCdeRecords']);
    Route::get('/get-bill-filing', [AllSearchingController::class, 'getBillFileRecords']);
    Route::get('/get-container-size', [AllSearchingController::class, 'getCntrSizeRecords']);
    Route::get('/get-pkg', [AllSearchingController::class, 'getPKGrecords']);
    Route::get('/get-customer-details', [AllSearchingController::class, 'getCstDtlRecords']);
    Route::post('/get-pol-pod-details', [AllSearchingController::class, 'getPolPodDtlRecords']);
    Route::post('get-city', [AllSearchingController::class, 'getCityRecords']);


    Route::resource('ics_ens', IcsEnsController::class);
    Route::post('/filing_fetch', [IcsEnsController::class, 'filingFetch']);

    Route::resource('customer_address', CustomerAddressController::class);
});