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
        // Ambil semua unit dan status real-time
        $units = Unit::with(['bookings' => function ($query) {
            $query->where('status', 'active');
        }])->get();

        $lockers = $units->map(function ($unit) {
            $hasActiveBooking = $unit->bookings->where('status', 'active')->isNotEmpty();

            if ($hasActiveBooking) {
                $status = 'occupied';
                $statusText = 'Terisi';
                $statusTextEn = 'Occupied';
                $icon = 'fa-lock';
                $class = 'locker-occupied';
            } elseif ($unit->status === 'overdue') {
                $status = 'maintenance';
                $statusText = 'Maintenance';
                $statusTextEn = 'Maintenance';
                $icon = 'fa-tools';
                $class = 'locker-maintenance';
            } elseif ($unit->status === 'booked') {
                $status = 'reserved';
                $statusText = 'Reserved';
                $statusTextEn = 'Reserved';
                $icon = 'fa-clock';
                $class = 'locker-reserved';
            } else {
                $status = 'available';
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
        $bookings = Booking::with('unit')
            ->where('user_id', Auth::id())
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        $items = $bookings->map(function ($booking) {
            // Hitung durasi dari start_time dan end_time
            $durationText = '';
            if ($booking->start_time && $booking->end_time) {
                $hours = $booking->start_time->diffInHours($booking->end_time);
                $days = $booking->start_time->diffInDays($booking->end_time);
                
                if ($hours < 24) {
                    $durationText = $hours . ' jam';
                } else {
                    $durationText = $days . ' hari';
                    // Jika lebih dari 1 hari, tampilkan juga jam jika ada sisa
                    $remainingHours = $hours % 24;
                    if ($remainingHours > 0) {
                        $durationText .= ' ' . $remainingHours . ' jam';
                    }
                }
            }
            
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
                'duration' => $durationText,
                'booking' => $booking,
            ];
        })->toArray();

        return view('my-items', compact('items'));
    }

    public function show($id)
    {
        $booking = Booking::with(['unit', 'fine'])
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $now = now();

        // Cek apakah waktu sekarang sudah melewati end_time dan belum ada fine
        if ($now->gt($booking->end_time) && !$booking->fine) {
            $hoursLate = $booking->end_time->diffInHours($now);
            $fineAmount = $hoursLate * 5000; // contoh: 5000 per jam keterlambatan

            $booking->fine()->create([
                'amount' => $fineAmount,
                'paid' => false,
            ]);

            // Reload relasi biar fine langsung muncul di view
            $booking->load('fine');
        }

        return view('takeitem', compact('booking'));
    }


    public function retrieve(Request $request, $id)
    {
        $booking = Booking::with('unit')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        $now = Carbon::now();

        // 🕒 Cek keterlambatan
        if ($now->gt($booking->end_time)) {
            $hoursLate = $booking->end_time->diffInHours($now);
            $fineAmount = $hoursLate * 5000;

            // Simpan ke tabel fines
            \App\Models\Fine::create([
                'booking_id' => $booking->id,
                'amount' => $fineAmount,
            ]);

            // Update status
            $booking->update(['status' => 'overdue']);
            $booking->unit->update(['status' => 'available']);

            return redirect()->to(url('/my-items'))
                ->with('error', "Anda terlambat $hoursLate jam. Denda Rp " . number_format($fineAmount, 0, ',', '.') . " telah ditambahkan.");
        }

        // Jika tidak terlambat
        $booking->update(['status' => 'completed']);
        $booking->unit->update(['status' => 'available']);

        return redirect()->to(url('/my-items'))
            ->with('success', 'Barang berhasil diambil dari loker ' . ($booking->unit->code ?? '') . '.');
    }

    public function showPayment(Request $request)
    {
        $request->validate([
            'unit_code' => 'required|exists:units,code',
            'item_name' => 'required|string|max:255',
            'item_category' => 'required|string',
            'duration_hours' => 'required|integer|min:1',
        ]);

        $unit = Unit::where('code', $request->unit_code)->firstOrFail();

        $hasActiveBooking = Booking::where('unit_id', $unit->id)
            ->where('status', 'active')
            ->exists();

        if ($hasActiveBooking) {
            return redirect()->route('store-item')
                ->with('error', 'Loker yang dipilih tidak tersedia.');
        }

        $durationHours = (int)$request->duration_hours;
        $pricePerHour = (float) ($unit->price_per_hour ?? 0);
        $totalPrice = $pricePerHour * $durationHours;

        $tz = 'Asia/Jakarta';
        $startTime = Carbon::now($tz);
        $endTime = (clone $startTime)->addHours($durationHours);

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
            'payment_method' => 'required|in:cash',
            'total_price' => 'required|numeric|min:0',
        ]);

        $unit = Unit::findOrFail($request->unit_id);

        $hasActiveBooking = Booking::where('unit_id', $unit->id)
            ->where('status', 'active')
            ->exists();

        if ($hasActiveBooking) {
            return redirect()->route('store-item')
                ->with('error', 'Loker yang dipilih tidak tersedia.');
        }

        $durationHours = (int)$request->duration_hours;
        $pricePerHour = (float) ($unit->price_per_hour ?? 0);
        $totalPrice = $pricePerHour * $durationHours;

        if (abs($totalPrice - $request->total_price) > 0.01) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan pada harga. Silakan coba lagi.');
        }

        $tz = 'Asia/Jakarta';
        $startTime = Carbon::now($tz);
        $endTime = (clone $startTime)->addHours($durationHours);

        Booking::create([
            'user_id' => Auth::id(),
            'unit_id' => $unit->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_price' => $totalPrice,
            'status' => 'active',
        ]);

        $unit->update(['status' => 'booked']);

        return redirect()->to(url('/my-items'))
            ->with('success', 'Pemesanan berhasil! Barang berhasil disimpan di loker ' . $unit->code . '. Silakan lakukan pembayaran tunai saat mengambil atau mengembalikan barang.');
    }

    public function payFine($id)
    {
        $booking = Booking::with('fine')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        if (!$booking->fine) {
            return back()->with('error', 'Tidak ada denda untuk booking ini.');
        }

        // Update status fine menjadi dibayar
        $booking->fine->update([
            'paid' => true,
        ]);

        return back()->with('success', 'Denda berhasil dibayar. Anda sekarang bisa mengambil barang.');
    }

}