<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\BookingController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard route (protected)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Settings routes (protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [AuthController::class, 'showSettings'])->name('settings');
    Route::put('/settings/profile', [AuthController::class, 'updateProfile'])->name('settings.profile.update');
    Route::put('/settings/password', [AuthController::class, 'updatePassword'])->name('settings.password.update');

    // Unit routes
    Route::get('/units', [UnitController::class, 'index'])->name('home');
    Route::get('/units/{unit}', [UnitController::class, 'show'])->name('units.show');
    Route::post('/units/{unit}/book', [BookingController::class, 'store'])->name('bookings.store');
});
