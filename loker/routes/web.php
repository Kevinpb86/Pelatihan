<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\AdminBookingController;

//User Booking Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/bookings', [UserBookingController::class, 'index'])->name('user.bookings.index');
    Route::get('/bookings/create', [UserBookingController::class, 'create'])->name('user.bookings.create');
    Route::post('/bookings', [UserBookingController::class, 'store'])->name('user.bookings.store');
});

//Admin Booking Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::patch('/admin/bookings/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
    Route::delete('/admin/bookings/{id}', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');
});

//Admin Unit Routes
Route::middleware(['auth', 'role:user'])->get('/units', [UserUnitController::class, 'index'])->name('user.units.index');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/units', [AdminUnitController::class, 'index'])->name('admin.units.index');
    Route::post('/admin/units', [AdminUnitController::class, 'store'])->name('admin.units.store');
    Route::put('/admin/units/{id}', [AdminUnitController::class, 'update'])->name('admin.units.update');
    Route::delete('/admin/units/{id}', [AdminUnitController::class, 'destroy'])->name('admin.units.destroy');
});

//User Unit Routes
Route::middleware(['auth', 'role:user'])->get('/units', [UserUnitController::class, 'index'])->name('user.units.index');

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
        return view('admin.dashboard');
    } else {
        return view('user.dashboard');
    }
})->middleware('auth')->name('dashboard');

// Settings routes (protected)
Route::get('/settings', [AuthController::class, 'showSettings'])->middleware('auth')->name('settings');
Route::put('/settings/profile', [AuthController::class, 'updateProfile'])->middleware('auth')->name('settings.profile.update');
Route::put('/settings/password', [AuthController::class, 'updatePassword'])->middleware('auth')->name('settings.password.update');
