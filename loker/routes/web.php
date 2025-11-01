<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUnitController;
use App\Http\Controllers\UserDashboardController;
use App\Models\User;
use App\Models\Booking;
use App\Models\Unit;

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
    
    // Admin bookings route (pemesanan)
    Route::get('/bookings', function (\Illuminate\Http\Request $request) {
        $query = Booking::with(['user','unit']);
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($w) use ($q) {
                $w->whereHas('user', function ($u) use ($q) {
                    $u->where('name','like',"%$q%")
                      ->orWhere('email','like',"%$q%");
                })->orWhereHas('unit', function ($un) use ($q) {
                    $un->where('code','like',"%$q%")
                      ->orWhere('name','like',"%$q%");
                });
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        $perPage = (int) ($request->input('per_page') ?: 10);
        $perPage = in_array($perPage, [10,25,50]) ? $perPage : 10;
        $bookings = $query->orderByDesc('created_at')->paginate($perPage)->appends($request->query());
        $users = User::orderBy('name')->get(['id','name','email']);
        $units = Unit::orderBy('code')->get(['id','code','name']);
        return view('Admin.pemesanan', compact('bookings','users','units'));
    })->name('bookings.index');

    // Admin booking detail
    Route::get('/bookings/{booking}', function (\App\Models\Booking $booking) {
        $booking->load(['user','unit','fine']);
        return view('Admin.booking.show', compact('booking'));
    })->name('bookings.show');

    // Admin booking store
    Route::post('/bookings', function (\Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'unit_id' => 'required|exists:units,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,overdue,cancelled',
        ]);
        $booking = new Booking($validated);
        $booking->save();
        return redirect()->to(url('/admin/bookings'))
            ->with('success', 'Pemesanan berhasil dibuat');
    })->name('bookings.store');

    // Admin booking update
    Route::put('/bookings/{booking}', function (\Illuminate\Http\Request $request, Booking $booking) {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'unit_id' => 'required|exists:units,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:active,completed,overdue,cancelled',
        ]);
        $booking->fill($validated);
        $booking->save();
        return redirect()->to(url('/admin/bookings'))
            ->with('success', 'Pemesanan berhasil diperbarui');
    })->name('bookings.update');

    // Admin booking delete
    Route::delete('/bookings/{booking}', function (Booking $booking) {
        $booking->delete();
        return redirect()->to(url('/admin/bookings'))
            ->with('success', 'Pemesanan berhasil dihapus');
    })->name('bookings.destroy');

    // Kelola Loker routes
    Route::get('/kelolaloker', [AdminUnitController::class, 'index'])->name('kelolaloker.index');
    Route::post('/kelolaloker', [AdminUnitController::class, 'store'])->name('kelolaloker.store');
    Route::put('/kelolaloker/{unit}', [AdminUnitController::class, 'update'])->name('kelolaloker.update');
    Route::put('/kelolaloker/{unit}/status', [AdminUnitController::class, 'updateStatus'])->name('kelolaloker.status');
    Route::delete('/kelolaloker/{unit}', [AdminUnitController::class, 'destroy'])->name('kelolaloker.destroy');

    // Kelola Pengguna routes
    Route::get('/kelolapengguna', function (\Illuminate\Http\Request $request) {
        $query = User::query();
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%$q%")
                  ->orWhere('email', 'like', "%$q%");
            });
        }
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }
        $perPage = (int) ($request->input('per_page') ?: 10);
        $perPage = in_array($perPage, [10,25,50]) ? $perPage : 10;
        $users = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends($request->query());
        return view('Admin.kelolapengguna', compact('users'));
    })->name('users.index');

    Route::post('/kelolapengguna', function (\Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',
        ]);
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password']);
        $user->role = $validated['role'];
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dibuat');
    })->name('users.store');

    Route::put('/kelolapengguna/{user}', function (\Illuminate\Http\Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:user,admin',
        ]);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui');
    })->name('users.update');

    Route::delete('/kelolapengguna/{user}', function (User $user) {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('success', 'Tidak dapat menghapus akun yang sedang digunakan');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus');
    })->name('users.destroy');
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

Route::post('/pay-fine/{id}', [ItemController::class, 'payFine'])->name('items.payFine');

