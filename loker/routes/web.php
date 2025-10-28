<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

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
        return view('Admin.dashboard');
    } else {
        return view('User.dashboard');
    }
})->middleware('auth')->name('dashboard');

// Settings routes (protected)
Route::get('/settings', [AuthController::class, 'showSettings'])->middleware('auth')->name('settings');
Route::put('/settings/profile', [AuthController::class, 'updateProfile'])->middleware('auth')->name('settings.profile.update');
Route::put('/settings/password', [AuthController::class, 'updatePassword'])->middleware('auth')->name('settings.password.update');

// Store Item routes (protected)
Route::get('/store-item', function () {
    return view('store-item');
})->middleware('auth')->name('store-item');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-items', [ItemController::class, 'index'])->name('items.index');
});
