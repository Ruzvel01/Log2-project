<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::get('/log2home', function () {
    return view('layouts.log2home');
})->middleware('auth');
