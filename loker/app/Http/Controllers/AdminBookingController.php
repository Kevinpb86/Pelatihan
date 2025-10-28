<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    // Menampilkan semua booking
    public function index()
    {
        $bookings = Booking::with(['user', 'unit'])
            ->orderByDesc('created_at')
            ->get();
        return view('Admin.booking.index', compact('bookings'));
    }

    // Mengubah status booking (misalnya dikembalikan)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $booking = Booking::findOrFail($id);

        $booking->update(['status' => $request->status]);

        // Kalau statusnya selesai → unit jadi available lagi
        if ($request->status === 'completed' || $request->status === 'cancelled') {
            $booking->unit->update(['status' => 'available']);
        }

        return back()->with('success', 'Status booking berhasil diperbarui.');
    }

    // Menghapus booking (jika diperlukan)
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        
        $booking->unit->update(['status' => 'available']);
        $booking->delete();

        return redirect()->back()->with('success', 'Data booking berhasil dihapus!');
    }
}
