<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VehicleManagementController;
use App\Http\Controllers\VehicleRequestController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DispatchController;

// --- AUTH ROUTES ---
// --- AUTH ROUTES ---
Route::get('/', [AuthController::class, 'showAuthForm'])->name('home');
Route::get('/login', [AuthController::class, 'showAuthForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

// OTP Routes
Route::get('/login/otp', [AuthController::class, 'showOtpForm'])->name('auth.showOtpForm');
Route::post('/login/otp', [AuthController::class, 'verifyOtp'])->name('auth.verifyOtp');

// ITO ANG IDADAGDAG MO:
Route::post('/login/otp/resend', [AuthController::class, 'resendOtp'])->name('auth.resendOtp');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- PROTECTED ROUTES ---
Route::middleware(['auth'])->group(function () {

//Settings
  Route::get('/settings', [AuthController::class, 'showSettings'])->name('settings.show');
    Route::post('/settings/profile', [AuthController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/password', [AuthController::class, 'updatePassword'])->name('settings.password');

    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- VEHICLE MANAGEMENT (Master List) ---
    // Ginawa nating dalawa ang name para suportado ang Sidebar at Form filters
    Route::get('/vehicle-management', [VehicleManagementController::class, 'index'])->name('vehicleslist.index');
    Route::get('/vehicles', [VehicleManagementController::class, 'index'])->name('vehicles.index');
    
    Route::post('/vehicles/store', [VehicleManagementController::class, 'store'])->name('vehicles.store');
    Route::put('/vehicles/{id}', [VehicleManagementController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{id}', [VehicleManagementController::class, 'destroy'])->name('vehicles.destroy');
    
    // Status & Monitoring
    Route::get('/vehicle-status', [VehicleManagementController::class, 'statusIndex'])->name('vehicles.status');
    Route::post('/vehicles/{id}/submit-status', [VehicleManagementController::class, 'setAvailable'])->name('vehicles.setAvailable');

    // --- VEHICLE REQUESTS (Yung dating Resource) ---
    // Manual nating ibinalik yung mga kailangan ng buttons mo sa Requests Tab
    Route::get('/vehicle-requests/create', [VehicleManagementController::class, 'create'])->name('vehicleslist.create');
    Route::get('/vehicle-requests/{id}/edit', [VehicleManagementController::class, 'edit'])->name('vehicleslist.edit');
    // Para sa Delete button sa Requests table
    Route::delete('/vehicle-requests/{id}', [VehicleManagementController::class, 'destroy'])->name('vehicleslist.destroy');

    // --- RESERVATION ---
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/reserve/{vehicle}', [ReservationController::class, 'reserve'])->name('reservations.reserve');

    // --- DISPATCH ---
    Route::get('/dispatch', [DispatchController::class, 'index'])->name('dispatch.index');
    Route::post('/dispatch', [DispatchController::class, 'dispatchFromReservation'])->name('dispatch.store');
    Route::post('/dispatch/{vehicle}/in-use', [DispatchController::class, 'inUse'])->name('dispatch.inuse');
});