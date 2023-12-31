<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('admin')->name('admin.')->group(function () {
    require __DIR__ . '/admin/auth.php';
    require __DIR__ . '/admin/base.php';
});

Route::prefix('merchant')->name('merchant.')->group(function () {
    require __DIR__ . '/merchant/auth.php';
    require __DIR__ . '/merchant/base.php';
});

Route::prefix('agent')->name('agent.')->group(function () {
    require __DIR__ . '/agent/auth.php';
    require __DIR__ . '/agent/base.php';
});


 
