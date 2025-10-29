<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUnitController;
use App\Http\Controllers\UserDashboardController;

// Redirect root to login
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
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return app(UserDashboardController::class)->index();
    }
})->middleware('auth')->name('dashboard');

// Admin routes (protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Admin bookings route (placeholder view)
    Route::get('/bookings', function () { return view('Admin.booking.index'); })->name('bookings.index');

    // Kelola Loker routes
    Route::get('/kelolaloker', [AdminUnitController::class, 'index'])->name('kelolaloker.index');
    Route::post('/kelolaloker', [AdminUnitController::class, 'store'])->name('kelolaloker.store');
    Route::put('/kelolaloker/{unit}', [AdminUnitController::class, 'update'])->name('kelolaloker.update');
    Route::put('/kelolaloker/{unit}/status', [AdminUnitController::class, 'updateStatus'])->name('kelolaloker.status');
});

// Settings routes (protected)
Route::get('/settings', [AuthController::class, 'showSettings'])->middleware('auth')->name('settings');
Route::put('/settings/profile', [AuthController::class, 'updateProfile'])->middleware('auth')->name('settings.profile.update');
Route::put('/settings/password', [AuthController::class, 'updatePassword'])->middleware('auth')->name('settings.password.update');

// Store Item routes (protected)
Route::get('/store-item', [ItemController::class, 'showStoreItem'])->middleware('auth')->name('store-item');
Route::get('/payment', [ItemController::class, 'showPayment'])->middleware('auth')->name('payment');
Route::post('/payment', [ItemController::class, 'processPayment'])->middleware('auth')->name('payment.process');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/take-item/{id}', [ItemController::class, 'show'])->name('items.show');
    Route::post('/take-item/{id}', [ItemController::class, 'retrieve'])->name('items.retrieve');
});
