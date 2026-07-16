<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\StationController;


Route::get('/trucks/search', [TruckController::class, 'search'])->name('trucks.search');
Route::apiResource('trucks', TruckController::class);
Route::apiResource('stations', StationController::class);
Route::apiResource('companies', CompanyController::class);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


