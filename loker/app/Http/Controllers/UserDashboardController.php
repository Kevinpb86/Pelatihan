<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total Barang (booking aktif)
        $totalItems = Booking::where('user_id', $user->id)
            ->where('status', 'active')
            ->count();

        // Loker Terisi (total booking aktif user)
        $occupiedLockers = $totalItems;

        // Akan Berakhir (booking yang akan berakhir dalam 24 jam)
        $expiringSoon = Booking::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('end_time', '<=', Carbon::now()->addDay())
            ->where('end_time', '>', Carbon::now())
            ->count();

        // Loker Kosong (total unit available)
        $availableLockers = Unit::where('status', 'available')->count();

        // Barang Terbaru (booking aktif terbaru, maksimal 5)
        $recentItems = Booking::with('unit')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Aktivitas Terbaru
        $activities = [];

        // 1. Booking baru (barang baru dititipkan)
        $recentBookings = Booking::with('unit')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        foreach ($recentBookings as $booking) {
            $activities[] = [
                'type' => 'booking_created',
                'message' => 'Barang baru dititipkan',
                'message_en' => 'New item stored',
                'detail' => ($booking->unit->name ?? 'Barang') . ' di Loker ' . ($booking->unit->code ?? 'N/A'),
                'time' => $booking->created_at,
                'icon' => 'fa-box',
                'color' => 'green'
            ];
        }

        // 2. Booking completed (barang diambil)
        $completedBookings = Booking::with('unit')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        foreach ($completedBookings as $booking) {
            $activities[] = [
                'type' => 'booking_completed',
                'message' => 'Loker dibuka',
                'message_en' => 'Locker opened',
                'detail' => 'Loker ' . ($booking->unit->code ?? 'N/A') . ' untuk mengambil ' . ($booking->unit->name ?? 'barang'),
                'time' => $booking->updated_at,
                'icon' => 'fa-unlock',
                'color' => 'blue'
            ];
        }

        // 3. Booking expiring (pengingat kadaluarsa)
        $expiringBookings = Booking::with('unit')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->where('end_time', '<=', Carbon::now()->addDays(2))
            ->where('end_time', '>', Carbon::now())
            ->orderBy('end_time', 'asc')
            ->take(3)
            ->get();

        foreach ($expiringBookings as $booking) {
            $activities[] = [
                'type' => 'booking_expiring',
                'message' => 'Pengingat kadaluarsa',
                'message_en' => 'Expiration reminder',
                'detail' => ($booking->unit->name ?? 'Barang') . ' akan berakhir ' . $booking->end_time->diffForHumans(),
                'time' => Carbon::now(),
                'icon' => 'fa-clock',
                'color' => 'yellow'
            ];
        }

        // 4. Profile updated
        if ($user->updated_at && $user->updated_at->gt($user->created_at)) {
            $activities[] = [
                'type' => 'profile_updated',
                'message' => 'Profil diperbarui',
                'message_en' => 'Profile updated',
                'detail' => 'Foto profil dan informasi pribadi',
                'time' => $user->updated_at,
                'icon' => 'fa-user',
                'color' => 'purple'
            ];
        }

        // Sort activities by time (newest first) and take latest 10
        usort($activities, function($a, $b) {
            return $b['time']->timestamp - $a['time']->timestamp;
        });

        $activities = array_slice($activities, 0, 10);

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

        return view('User.dashboard', compact(
            'totalItems',
            'occupiedLockers',
            'expiringSoon',
            'availableLockers',
            'recentItems',
            'activities',
            'lockers'
        ));
    }
}

