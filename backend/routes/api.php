<?php

use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/locations/{ipAddress}', [LocationController::class, 'show']);
Route::post('/locations', [LocationController::class, 'store']);
Route::put('/locations/{location}', [LocationController::class, 'update']);
Route::delete('/locations/{location}', [LocationController::class, 'destroy']);
