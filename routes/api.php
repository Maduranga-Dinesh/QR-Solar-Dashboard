<?php

namespace livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ESP32DataController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


