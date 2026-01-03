<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleRequestController;
use App\Http\Controllers\VehicleManagementController;
use App\Http\Controllers\VehicleStatusController;

// Show login/register page
Route::get('/', [AuthController::class, 'showAuthForm'])->name('home');

// Add .name('login') to avoid route missing error
Route::get('/login', [AuthController::class, 'showAuthForm'])->name('login');
Route::get('/register', [AuthController::class, 'showAuthForm']);

// POST login/register
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/vehicle-management', [VehicleManagementController::class, 'index'])
    ->name('vehicleslist.index');

Route::resource('vehicleslist', VehicleRequestController::class)
    ->parameters(['vehicleslist' => 'vehicleRequest'])
    ->except(['index']);

Route::get('/vehicles', [VehicleStatusController::class, 'index'])->name('vehiclestatus.index');