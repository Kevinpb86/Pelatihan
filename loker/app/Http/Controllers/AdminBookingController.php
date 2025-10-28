<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    // Menampilkan semua booking
    public function index()
    {
        $bookings = Booking::with(['user', 'unit'])->latest()->get();
        return view('Admin.booking.index', compact('bookings'));
    }

    // Mengubah status booking (misalnya dikembalikan)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,returned,overdue'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui!');
    }

    // Menghapus booking (jika diperlukan)
    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data booking berhasil dihapus!');
    }
}
