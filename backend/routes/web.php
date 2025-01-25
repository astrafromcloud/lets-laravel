<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('locations.index');
});

Route::resource('locations', LocationController::class)->only([
    'index', 'store', 'update', 'destroy'
]);
