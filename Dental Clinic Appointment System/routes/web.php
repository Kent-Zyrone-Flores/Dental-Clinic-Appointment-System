<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserpageController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AuthController;


Route::get('/', function () { 
    return view('landingpage'); 
});
Route::post('/', [LandingpageController::class, 'landingpage'])->name('landingpage');


Route::get('signup', [SignupController::class, 'signup'])->name('signup');
Route::post('signup', [SignupController::class, 'save'])->name('signup.save');


Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'submit'])->name('login.submit');
Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('user', [AppointmentController::class, 'user'])->name('user');
Route::post('user', [AppointmentController::class, 'submit'])->name('user.submit');

// Login form page
Route::view('/login', 'login')->name('login');

// Handle login submission
Route::post('/admin', [AuthController::class, 'login'])->name('admin');

// Signup page
Route::view('/signup', 'signup')->name('signup');



Route::get('/history', [HistoryController::class, 'index'])->name('history');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
Route::get('/store-report', [StoreController::class, 'storeReport'])->name('store_report');
Route::post('/store-report', [StoreController::class, 'storeReport'])->name('store_report');

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');


Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

Route::post('/appointments/update-status/{id}', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');