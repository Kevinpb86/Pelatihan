<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        return view('User.booking.index', compact('bookings'));
    }

    // Menampilkan form pemesanan loker
    public function create()
    {
        $units = Unit::whereDoesntHave('bookings', function ($query) {
            $query->where('status', 'active');
        })->get();

        return view('User.booking.create', compact('units'));
    }

    // Menyimpan data pemesanan baru
    public function store(Request $request)
    {   
        $activeBookings = Booking::where('user_id', auth::id())
            ->whereIn('status', ['active', 'pending'])
            ->count();

        if($activeBookings >= 2){
            return redirect()->back()->withErrors(['error' => 'Anda telah mencapai batas maksimal pemesanan aktif (2).']);
        }

        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after_or_equal:start_time',
            'total_price' => 'required|numeric|min:0',
        ]);

        $unit = Unit::findOrFail($request->unit_id);
            if ($unit->status === 'rented') {
                return back()->with('error', 'Unit ini sedang disewa.');
            }

        $hours = Carbon::parse($request->start_time)->diffInHours(Carbon::parse($request->end_time));

        if ($hours < 1) {
            return back()->with('error', 'Durasi sewa minimal 1 jam.');
        }

        $totalPrice = $unit->price_per_hour * $hours;

        Booking::create([
            'user_id' => Auth::id(),
            'unit_id' => $request->unit_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $totalPrice,
            'status' => 'active',
        ]);

        return redirect()->route('User.booking.index')
            ->with('success', 'Pemesanan berhasil dibuat!');
    }

    public function destroy($id){
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);
        $booking->delete();

        $booking->unit->update(['status' => 'available']);
        return redirect()->route('User.booking.index')
            ->with('success', 'Pemesanan berhasil dibatalkan!');
    }
}


