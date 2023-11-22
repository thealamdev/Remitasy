<?php

use App\Http\Controllers\Auth\Merchant\AuthenticatinController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthenticatinController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
});
