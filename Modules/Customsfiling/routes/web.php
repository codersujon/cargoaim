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

    Route::post('/get-hbl-eori-records', [AllSearchingController::class, 'getHBLEoriRecords']);
    Route::post('/get-mbl-eori-records', [AllSearchingController::class, 'getMBLEoriRecords']);
    Route::post('/get-country-code', [AllSearchingController::class, 'getCtryCdeRecords']);
    Route::post('/get-bill-filing', [AllSearchingController::class, 'getBillFileRecords']);
    Route::post('/get-container-size', [AllSearchingController::class, 'getCntrSizeRecords']);
    Route::post('/get-pkg', [AllSearchingController::class, 'getPKGrecords']);
    Route::post('/get-customer-details', [AllSearchingController::class, 'getCstDtlRecords']);

    Route::post('/get-pol-pod-details', [AllSearchingController::class, 'getPolPodDtlRecords']);
    Route::post('get-city', [AllSearchingController::class, 'getCityRecords']);
 
    Route::resource('ics_ens', IcsEnsController::class);

    Route::post('/filing_fetch', [IcsEnsController::class, 'filingFetch']);
    Route::post('/liner', [IcsEnsController::class, 'liner']);

    Route::resource('customer_address', CustomerAddressController::class);
});