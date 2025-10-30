<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ItemController extends Controller
{
    public function showStoreItem()
    {
        // Status Loker - Real-time data
        // Ambil semua units dan cek apakah ada booking aktif
        $units = Unit::with(['bookings' => function($query) {
            $query->where('status', 'active');
        }])->get();

        $lockers = $units->map(function($unit) {
            // Cek apakah ada booking aktif
            $hasActiveBooking = $unit->bookings->where('status', 'active')->isNotEmpty();
            
            // Tentukan status berdasarkan booking aktif dan status unit
            if ($hasActiveBooking) {
                $status = 'occupied'; // Merah - ada yang mengisi
                $statusText = 'Terisi';
                $statusTextEn = 'Occupied';
                $icon = 'fa-lock';
                $class = 'locker-occupied';
            } elseif ($unit->status === 'overdue') {
                $status = 'maintenance'; // Kuning/Orange - maintenance
                $statusText = 'Maintenance';
                $statusTextEn = 'Maintenance';
                $icon = 'fa-tools';
                $class = 'locker-maintenance';
            } elseif ($unit->status === 'booked') {
                $status = 'reserved'; // Biru - reserved
                $statusText = 'Reserved';
                $statusTextEn = 'Reserved';
                $icon = 'fa-clock';
                $class = 'locker-reserved';
            } else {
                $status = 'available'; // Hijau - kosong/tersedia
                $statusText = 'Kosong';
                $statusTextEn = 'Available';
                $icon = 'fa-unlock';
                $class = 'locker-available';
            }

            return [
                'id' => $unit->id,
                'code' => $unit->code,
                'name' => $unit->name,
                'status' => $status,
                'statusText' => $statusText,
                'statusTextEn' => $statusTextEn,
                'icon' => $icon,
                'class' => $class,
            ];
        });

        return view('store-item', compact('lockers'));
    }

    public function index()
    {
        // Ambil booking aktif user
        $bookings = Booking::with('unit')
            ->where('user_id', Auth::id())
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        // Format data untuk view
        $items = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'name' => $booking->unit->name ?? 'Barang',
                'locker' => $booking->unit->code ?? 'N/A',
                'updated' => $booking->updated_at->diffForHumans(),
                'status' => $booking->status === 'active' ? 'Terisi' : 'Kosong',
                'icon' => 'fas fa-box',
                'start_time' => $booking->start_time,
                'end_time' => $booking->end_time,
                'total_price' => $booking->total_price,
                'booking' => $booking,
            ];
        })->toArray();

        return view('my-items', compact('items'));
    }

    public function show($id)
    {
        $booking = Booking::with('unit')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        return view('takeitem', compact('booking'));
    }

    public function retrieve(Request $request, $id)
    {
        $booking = Booking::with('unit')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        // Update status booking menjadi completed
        $booking->update([
            'status' => 'completed'
        ]);

        // Update unit status menjadi available
        $booking->unit->update([
            'status' => 'available'
        ]);

        return redirect()->route('items.index')
            ->with('success', 'Barang berhasil diambil dari loker ' . $booking->unit->code . '!');
    }

    public function showPayment(Request $request)
    {
        // Validasi input dari store-item form
        $request->validate([
            'unit_code' => 'required|exists:units,code',
            'item_name' => 'required|string|max:255',
            'item_category' => 'required|string',
            'duration_hours' => 'required|integer|min:1',
        ]);

        $unit = Unit::where('code', $request->unit_code)->firstOrFail();
        
        // Cek apakah unit tersedia
        $hasActiveBooking = Booking::where('unit_id', $unit->id)
            ->where('status', 'active')
            ->exists();
            
        if ($hasActiveBooking) {
            return redirect()->route('store-item')
                ->with('error', 'Loker yang dipilih tidak tersedia.');
        }

        // Hitung harga berdasarkan logika:
        // - 1 jam pertama: Rp 2.000
        // - Jika melebihi: biaya tambahan Rp 5.000 per jam
        $durationHours = (int)$request->duration_hours;
        $firstHourPrice = 2000;
        $additionalHourPrice = 5000;
        
        if ($durationHours == 1) {
            $totalPrice = $firstHourPrice;
        } else {
            $totalPrice = $firstHourPrice + (($durationHours - 1) * $additionalHourPrice);
        }

        // Calculate start and end time
        $startTime = Carbon::now();
        $endTime = Carbon::now()->addHours($durationHours);

        return view('payment', compact(
            'unit',
            'totalPrice',
            'durationHours',
            'startTime',
            'endTime'
        ))->with([
            'item_name' => $request->item_name,
            'item_category' => $request->item_category,
        ]);
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'item_name' => 'required|string|max:255',
            'item_category' => 'required|string',
            'duration_hours' => 'required|integer|min:1',
            'payment_method' => 'required|in:qr,bank,dana,ovo,gopay',
            'total_price' => 'required|numeric|min:0',
        ]);

        $unit = Unit::findOrFail($request->unit_id);
        
        // Cek apakah unit tersedia
        $hasActiveBooking = Booking::where('unit_id', $unit->id)
            ->where('status', 'active')
            ->exists();
            
        if ($hasActiveBooking) {
            return redirect()->route('store-item')
                ->with('error', 'Loker yang dipilih tidak tersedia.');
        }

        // Hitung harga
        $durationHours = (int)$request->duration_hours;
        $firstHourPrice = 2000;
        $additionalHourPrice = 5000;
        
        if ($durationHours == 1) {
            $totalPrice = $firstHourPrice;
        } else {
            $totalPrice = $firstHourPrice + (($durationHours - 1) * $additionalHourPrice);
        }

        // Validate total price
        if (abs($totalPrice - $request->total_price) > 0.01) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan pada harga. Silakan coba lagi.');
        }

        // Create booking
        $startTime = Carbon::now();
        $endTime = Carbon::now()->addHours($durationHours);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'unit_id' => $unit->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_price' => $totalPrice,
            'status' => 'active',
        ]);

        // Update unit status
        $unit->update(['status' => 'booked']);

        return redirect()->route('items.index')
            ->with('success', 'Pembayaran berhasil! Barang berhasil disimpan di loker ' . $unit->code . '.');
    }
}