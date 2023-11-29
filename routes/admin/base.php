<?php

use App\Http\Controllers\Package\CurrencyController;
use App\Models\Agent;
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

    // Route::prefix('merchants')->name('merchant.')->group(function(){
    //     Route::controller(CurrencyController::class)->group(function(){
    //         Route::get('/','index')->name('index');
    //     });
    // });

});

Route::get('/agentList', function () {
    $agents = Agent::with('image')
    ->get();
    return response()->json($agents);
});
