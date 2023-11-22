<?php

use App\Http\Controllers\Package\CurrencyController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('currency')->name('currency.')->group(function () {
        Route::controller(CurrencyController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('edit/{currency}', 'edit')->name('edit');
            Route::put('update/{currency}', 'update')->name('update');
            Route::delete('delete/{currency}', 'destroy')->name('delete');
        });
    });

});
