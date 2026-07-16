<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckController;

Route::get('/trucks/search', [TruckController::class, 'search'])->name('trucks.search');
Route::apiResource('trucks', TruckController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


