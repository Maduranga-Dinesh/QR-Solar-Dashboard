<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Route::get('/about', [UserController::class, 'about'])->name('about');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Route::get('/profile', [UserController::class, 'userprofile'])->name('profile');
});

// Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');

    Route::get('/admin/profile', [AdminController::class, 'profilepage'])->name('admin/profile');

    Route::get('/admin/recharge', [AdminController::class, 'recharge'])->name('admin/recharge');

    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin/reports');

    Route::get('/admin/qr', [QrController::class, 'index'])->name('admin/qr');

    Route::get('/admin/qr/create', [QrController::class, 'create'])->name('admin/qr/create');
    Route::post('/admin/qr/store', [QrController::class, 'store'])->name('admin/qr/store');
    Route::get('/admin/qr/show/{id}', [QrController::class, 'show'])->name('admin/qr/show');
    Route::get('/admin/qr/edit/{id}', [QrController::class, 'edit'])->name('admin/qr/edit');
    Route::put('/admin/qr/edit/{id}', [QrController::class, 'update'])->name('admin/qr/update');
    Route::delete('/admin/qr/destroy/{id}', [QrController::class, 'destroy'])->name('admin/qr/destroy');
});
