<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - {{ config('app.name', 'Loker') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            --info-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .sidebar-gradient {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        }

        .nav-item {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-item::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--primary-gradient);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .nav-item.active::after {
            transform: scaleY(1);
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .slide-in {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .card-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .card-hover:hover::before {
            left: 100%;
        }

        .card-hover:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite alternate;
        }

        @keyframes pulseGlow {
            from { box-shadow: 0 0 20px rgba(102, 126, 234, 0.3); }
            to { box-shadow: 0 0 30px rgba(102, 126, 234, 0.6); }
        }

        .bounce-in {
            animation: bounceIn 0.6s ease-out;
        }

        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .badge-info {
            background: rgba(59, 130, 246, 0.1);
            color: #2563eb;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient shadow-2xl">
            <!-- Logo -->
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center floating-animation">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-white">Admin Panel</h1>
                        <p class="text-xs text-white/70">LokerHub Management</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 px-4">
                <div class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-xl">
                        <i class="fas fa-home w-5 h-5 mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.kelolaloker.index') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-cube w-5 h-5 mr-3"></i>
                        Kelola Loker
                    </a>
                    <a href="{{ route('admin.bookings.index') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-book w-5 h-5 mr-3"></i>
                        Pemesanan
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        Kelola Pengguna
                    </a>
                    <a href="{{ route('settings') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i>
                        Pengaturan
                    </a>
                </div>
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-0 w-64 p-6 border-t border-white/20">
                <div class="flex items-center mb-4">
                    <div class="relative w-12 h-12 rounded-full overflow-hidden shadow-lg">
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : '' }}" alt="Avatar" class="w-full h-full object-cover {{ Auth::user()->avatar ? '' : 'hidden' }}">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center {{ Auth::user()->avatar ? 'hidden' : '' }}">
                            <span class="text-white text-lg font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-white/70">{{ Auth::user()->email }}</p>
                        <span class="badge badge-success mt-1 text-xs">Admin</span>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-500/80 hover:bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:shadow-lg">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-gray-200/50">
                <div class="px-6 py-6">
                    <div class="flex items-center justify-between">
                        <div class="slide-in">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center pulse-glow">
                                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-3xl font-bold gradient-text">Dashboard Admin</h2>
                                    <p class="text-gray-600 mt-1">Selamat datang, {{ Auth::user()->name }}! Kelola sistem loker Anda di sini.</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-right">
                                <p class="text-sm text-gray-600">Waktu Saat Ini</p>
                                <p class="text-lg font-semibold text-gray-900" id="current-time">{{ date('H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <div class="max-w-7xl mx-auto">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Total Users -->
                        <div class="stat-card bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20 bounce-in">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalUsers, 0, ',', '.') }}</p>
                                    <p class="text-xs {{ $usersGrowth >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                                        <i class="fas fa-arrow-{{ $usersGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                                        {{ $usersGrowth >= 0 ? '+' : '' }}{{ $usersGrowth }}% dari bulan lalu
                                    </p>
                                </div>
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-users text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Total Bookings -->
                        <div class="stat-card bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20 bounce-in" style="animation-delay: 0.1s;">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Pemesanan</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalBookings, 0, ',', '.') }}</p>
                                    <p class="text-xs {{ $bookingsGrowth >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                                        <i class="fas fa-arrow-{{ $bookingsGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                                        {{ $bookingsGrowth >= 0 ? '+' : '' }}{{ $bookingsGrowth }}% dari bulan lalu
                                    </p>
                                </div>
                                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-book text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Active Units -->
                        <div class="stat-card bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20 bounce-in" style="animation-delay: 0.2s;">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Unit Aktif</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalUnits, 0, ',', '.') }}</p>
                                    <p class="text-xs text-purple-600 mt-2">
                                        <i class="fas fa-lock mr-1"></i>
                                        {{ $availableUnits }} kosong, {{ $occupiedUnits }} terisi
                                    </p>
                                </div>
                                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-cube text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Revenue -->
                        <div class="stat-card bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20 bounce-in" style="animation-delay: 0.3s;">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Pendapatan Bulan Ini</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-2">
                                        @if($currentMonthRevenue >= 1000000)
                                            Rp {{ number_format($currentMonthRevenue / 1000000, 1, ',', '.') }}M
                                        @elseif($currentMonthRevenue >= 1000)
                                            Rp {{ number_format($currentMonthRevenue / 1000, 1, ',', '.') }}K
                                        @else
                                            Rp {{ number_format($currentMonthRevenue, 0, ',', '.') }}
                                        @endif
                                    </p>
                                    <p class="text-xs {{ $revenueGrowth >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                                        <i class="fas fa-arrow-{{ $revenueGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                                        {{ $revenueGrowth >= 0 ? '+' : '' }}{{ $revenueGrowth }}% dari bulan lalu
                                    </p>
                                </div>
                                    <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-dollar-sign text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Recent Bookings -->
                        <div class="lg:col-span-2">
                            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                                <div class="p-6 border-b border-gray-200/50">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                            <i class="fas fa-book mr-3 text-purple-600"></i>
                                            Pemesanan Terbaru
                                        </h3>
                                        <a href="{{ route('admin.bookings.index') }}" class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                                            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-4">
                                        @forelse($recentBookings as $booking)
                                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100 hover:shadow-md transition-all duration-300">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                                    <i class="fas fa-box text-white"></i>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900">{{ $booking->user->name }}</p>
                                                    <p class="text-sm text-gray-600">
                                                        Loker {{ $booking->unit->code ?? 'N/A' }} • {{ $booking->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="badge badge-{{ $booking->status === 'active' ? 'success' : ($booking->status === 'completed' ? 'info' : 'warning') }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                                <p class="text-sm text-gray-600 mt-1">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="text-center py-8">
                                            <i class="fas fa-box-open text-4xl text-gray-400 mb-2"></i>
                                            <p class="text-gray-600">Belum ada pemesanan</p>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions & Status -->
                        <div class="space-y-6">
                            <!-- Quick Actions -->
                            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                                <div class="p-6 border-b border-gray-200/50">
                                    <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-bolt mr-3 text-purple-600"></i>
                                        Aksi Cepat
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-3">
                                        <a href="{{ route('admin.kelolaloker.index') }}" class="w-full btn-gradient flex items-center justify-center px-4 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-medium hover:shadow-lg transition-all duration-300">
                                            <i class="fas fa-plus mr-2"></i>
                                            Tambah Loker
                                        </a>
                                        <a href="{{ route('admin.bookings.index') }}" class="w-full btn-gradient flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-xl font-medium hover:shadow-lg transition-all duration-300">
                                            <i class="fas fa-list mr-2"></i>
                                            Lihat Pemesanan
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Unit Status -->
                            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                                <div class="p-6 border-b border-gray-200/50">
                                    <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-cube mr-3 text-purple-600"></i>
                                        Status Unit
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-unlock text-white"></i>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900">Kosong</p>
                                                    <p class="text-sm text-gray-600">Tersedia untuk disewa</p>
                                                </div>
                                            </div>
                                            <span class="text-2xl font-bold text-green-600">{{ $availableUnits }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-lock text-white"></i>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900">Terisi</p>
                                                    <p class="text-sm text-gray-600">Sedang digunakan</p>
                                                </div>
                                            </div>
                                            <span class="text-2xl font-bold text-blue-600">{{ $occupiedUnits }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-tools text-white"></i>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900">Maintenance</p>
                                                    <p class="text-sm text-gray-600">Dalam perbaikan</p>
                                                </div>
                                            </div>
                                            <span class="text-2xl font-bold text-yellow-600">{{ $maintenanceUnits }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Update waktu secara real-time
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('current-time').textContent = `${hours}:${minutes}:${seconds}`;
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>
</html>

