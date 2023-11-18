<?php

use App\Http\Controllers\Package\CurrencyController;
use Illuminate\Support\Facades\Route;

Route::prefix('currency')->name('currency.')->group(function () {
    Route::controller(CurrencyController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
    });
});
