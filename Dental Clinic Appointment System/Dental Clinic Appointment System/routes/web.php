<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AuthController;

// Public Routes (Accessible to Guests)
Route::middleware('guest')->group(function () {
    Route::get('/', function () { 
        return view('landingpage'); 
    });
    
    Route::post('/', [LandingpageController::class, 'landingpage'])->name('landingpage');

    Route::get('signup', [SignupController::class, 'signup'])->name('signup');
    Route::post('signup', [SignupController::class, 'save'])->name('signup.save');

    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'submit'])->name('login.submit');
});

// Protected Routes for Authenticated Users
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // User-specific Routes
    Route::get('user', [AppointmentController::class, 'user'])->name('user');
    Route::post('user', [AppointmentController::class, 'submit'])->name('user.submit');
    
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::post('/appointments/update-status/{id}', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    
    // Admin-specific Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::get('/store-report', [StoreController::class, 'storeReport'])->name('store_report');
    Route::post('/store-report', [StoreController::class, 'storeReport']);
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
});
