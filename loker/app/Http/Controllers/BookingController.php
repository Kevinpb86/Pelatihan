<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Unit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request, $unit_id)
    {
        $user = Auth::user();
        $activeBookings = Booking::where('user_id', $user->id)
                                 ->where('status', 'active')
                                 ->count();

        if ($activeBookings >= 2) {
            return back()->with('error', 'Maksimal 2 unit bisa disewa.');
        }

        $unit = Unit::findOrFail($unit_id);

        $start = Carbon::now();
        $end = Carbon::now()->addDays(5); // max 5 hari
        $total = $unit->price_per_day * 5;

        Booking::create([
            'user_id' => $user->id,
            'unit_id' => $unit->id,
            'start_date' => $start,
            'end_date' => $end,
            'total_price' => $total,
        ]);

        $unit->update(['status' => 'booked']);

        return redirect()->route('bookings.index')->with('success', 'Berhasil menyewa loker.');
    }
}

