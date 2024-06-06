<?php

namespace livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DeviceController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/limitswitchone', [DeviceController::class, 'onereceiveData']);
Route::post('/limitswitchtwo', [DeviceController::class, 'tworeceiveData']);
