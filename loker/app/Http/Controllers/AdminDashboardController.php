<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Pastikan hanya admin yang bisa akses
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        // Total Pengguna (hanya user biasa, bukan admin)
        $totalUsers = User::where('role', 'user')->count();
        $totalUsersLastMonth = User::where('role', 'user')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        $usersGrowth = $totalUsersLastMonth > 0 
            ? round((($totalUsers - $totalUsersLastMonth) / $totalUsersLastMonth) * 100, 0)
            : 0;

        // Total Pemesanan
        $totalBookings = Booking::count();
        $totalBookingsLastMonth = Booking::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        $bookingsGrowth = $totalBookingsLastMonth > 0
            ? round((($totalBookings - $totalBookingsLastMonth) / $totalBookingsLastMonth) * 100, 0)
            : 0;

        // Unit Status - Hitung berdasarkan booking aktif
        $totalUnits = Unit::count();
        $occupiedUnitIds = Booking::where('status', 'active')
            ->distinct('unit_id')
            ->pluck('unit_id');
        $availableUnits = Unit::whereNotIn('id', $occupiedUnitIds)
            ->where('status', 'available')
            ->count();
        $occupiedUnits = $occupiedUnitIds->count();
        $maintenanceUnits = Unit::where('status', 'overdue')->count();

        // Pendapatan Bulan Ini
        $currentMonthRevenue = Booking::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');
        
        $lastMonthRevenue = Booking::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('total_price');
        
        $revenueGrowth = $lastMonthRevenue > 0
            ? round((($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 0)
            : 0;

        // Pemesanan Terbaru
        $recentBookings = Booking::with(['user', 'unit'])
            ->latest()
            ->take(5)
            ->get();

        // Menghitung unit yang akan berakhir (expiring soon)
        $expiringSoon = Booking::where('status', 'active')
            ->where('end_time', '<=', Carbon::now()->addDays(1))
            ->where('end_time', '>', Carbon::now())
            ->count();

        return view('Admin.dashboard', compact(
            'totalUsers',
            'usersGrowth',
            'totalBookings',
            'bookingsGrowth',
            'totalUnits',
            'availableUnits',
            'occupiedUnits',
            'maintenanceUnits',
            'currentMonthRevenue',
            'revenueGrowth',
            'recentBookings',
            'expiringSoon'
        ));
    }
}

