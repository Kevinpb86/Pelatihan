<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    // Menampilkan daftar booking milik user
    public function index()
    {
        $bookings = Booking::with('unit')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('user.bookings.index', compact('bookings'));
    }

    // Menampilkan form pemesanan loker
    public function create()
    {
        $units = Unit::whereDoesntHave('bookings', function ($query) {
            $query->where('status', 'active');
        })->get();

        return view('user.bookings.create', compact('units'));
    }

    // Menyimpan data pemesanan baru
    public function store(Request $request)
    {   
        $activeBookings = Booking::where('user_id', auth::id())
            ->where('status', ['active', 'pending'])
            ->count();

        if($activeBookings >= 2){
            return redirect()->back()->withErrors(['error' => 'Anda telah mencapai batas maksimal pemesanan aktif (3).']);
        }

        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_price' => 'required|numeric|min:0',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'unit_id' => $request->unit_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $request->total_price,
            'status' => 'active',
        ]);

        return redirect()->route('user.bookings.index')
            ->with('success', 'Pemesanan berhasil dibuat!');
    }
}


