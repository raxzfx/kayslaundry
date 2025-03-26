<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

// Customer routes
Route::prefix('customer')->middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    });
});

// Operator routes
Route::prefix('operator')->middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/dashboard', function () {
        return view('operator.dashboard');
    });
});

// Pelaksana routes
Route::prefix('pelaksana')->middleware(['auth', 'role:pelaksana'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pelaksana.dashboard');
    });
});

// Direktur routes
Route::prefix('direktur')->middleware(['auth', 'role:direktur'])->group(function () {
    Route::get('/dashboard', function () {
        return view('direktur.dashboard');
    });
});

