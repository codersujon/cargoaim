<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\MenuController;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Core\Http\Controllers\DashboardController;
use Modules\Core\Http\Controllers\ColorManageController;
use Modules\Core\Http\Controllers\LanguageController;
use Modules\Core\Http\Controllers\LanguageSelectController;
use Modules\Core\Http\Controllers\AllSearchingController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('cores', CoreController::class)->names('core');
// });


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    Route::resource('color', ColorManageController::class);
    Route::get('/get-color-pattern/{pattern}', [ColorManageController::class, 'getColorPattern']);
    Route::get('save_as_color/{id}', [ColorManageController::class, 'saveColor']);

    Route::resource('language', LanguageController::class);
    Route::get('language_fetch', [LanguageController::class, 'fetch']);

    Route::get('lang/{locale}', [LanguageSelectController::class, 'switch'])->name('lang.switch');

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


// Menu
Route::middleware(['auth'])->group(function () {
    Route::resource('menu', MenuController::class)->except(['show']);
});