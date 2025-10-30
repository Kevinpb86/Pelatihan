<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ config('app.name', 'Loker') }}</title>
    
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
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .gradient-bg {
            background: var(--primary-gradient);
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .card-hover:hover::before {
            left: 100%;
        }

        .card-hover:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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

        .btn-gradient {
            background: var(--primary-gradient);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-gradient:hover::before {
            left: 100%;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .locker-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 12px;
        }

        .locker-item {
            aspect-ratio: 1;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .locker-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .locker-item:hover::before {
            left: 100%;
        }

        .locker-item:hover {
            transform: scale(1.05);
        }

        .locker-available {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .locker-occupied {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .locker-maintenance {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .locker-reserved {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }
        
        /* Dark Theme Styles */
        .dark-theme {
            background-color: #1a1a1a !important;
            color: #e5e5e5 !important;
        }
        
        .dark-theme .bg-white {
            background-color: #2d2d2d !important;
            color: #e5e5e5 !important;
        }
        
        .dark-theme .bg-gray-100 {
            background-color: #1a1a1a !important;
        }
        
        .dark-theme .bg-gray-50 {
            background-color: #2d2d2d !important;
        }
        
        .dark-theme .text-gray-800 {
            color: #e5e5e5 !important;
        }
        
        .dark-theme .text-gray-700 {
            color: #d1d5db !important;
        }
        
        .dark-theme .text-gray-600 {
            color: #9ca3af !important;
        }
        
        .dark-theme .text-gray-500 {
            color: #6b7280 !important;
        }
        
        .dark-theme .border-gray-200 {
            border-color: #4b5563 !important;
        }
        
        .dark-theme .border-gray-300 {
            border-color: #6b7280 !important;
        }
        
        .dark-theme input, .dark-theme select, .dark-theme textarea {
            background-color: #374151 !important;
            border-color: #6b7280 !important;
            color: #e5e5e5 !important;
        }
        
        .dark-theme input:focus, .dark-theme select:focus, .dark-theme textarea:focus {
            border-color: #8b5cf6 !important;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1) !important;
        }
        
        /* Language Styles */
        .lang-id {
            display: block;
        }
        
        .lang-en {
            display: none;
        }
        
        .language-en .lang-id {
            display: none;
        }
        
        .language-en .lang-en {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100" id="main-body">
    <!-- Success Message -->
    @if(session('success'))
        <div class="fixed top-4 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient shadow-2xl">
            <!-- Logo -->
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center floating-animation">
                        <i class="fas fa-lock text-white text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-white">LokerHub</h1>
                        <p class="text-xs text-white/70">
                            <span class="lang-id">Sistem Penitipan Barang</span>
                            <span class="lang-en">Item Storage System</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 px-4">
                <div class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-xl">
                        <i class="fas fa-home w-5 h-5 mr-3"></i>
                        <span class="lang-id">Dashboard</span>
                        <span class="lang-en">Dashboard</span>
                    </a>
                    <a href="#" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        <span class="lang-id">Barang Saya</span>
                        <span class="lang-en">My Items</span>
                    </a>
                    <a href="#" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-map-marker-alt w-5 h-5 mr-3"></i>
                        <span class="lang-id">Lokasi Loker</span>
                        <span class="lang-en">Locker Locations</span>
                    </a>
                    <a href="#" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                        <span class="lang-id">Statistik</span>
                        <span class="lang-en">Statistics</span>
                    </a>
                    <a href="{{ route('settings') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i>
                        <span class="lang-id">Pengaturan</span>
                        <span class="lang-en">Settings</span>
                    </a>
                </div>
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-0 w-64 p-6 border-t border-white/20">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white text-lg font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-white/70">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-500/80 hover:bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:shadow-lg">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span class="lang-id">Keluar</span>
                        <span class="lang-en">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-gray-200/50">
                <div class="px-6 py-6">
                    <div class="flex items-center justify-between">
                        <div class="slide-in">
                            <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                                <i class="fas fa-lock mr-3 text-purple-600"></i>
                                <span class="lang-id">Selamat Datang, {{ Auth::user()->name }}!</span>
                                <span class="lang-en">Welcome, {{ Auth::user()->name }}!</span>
                            </h2>
                            <p class="text-gray-600 mt-1">
                                <span class="lang-id">Kelola penitipan barang Anda dengan mudah dan aman</span>
                                <span class="lang-en">Manage your item storage easily and securely</span>
                            </p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Search Bar -->
                            <div class="relative">
                                <input type="text" placeholder="Cari barang..." class="w-64 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <i class="fas fa-search absolute right-3 top-3.5 text-gray-400"></i>
                            </div>
                            <!-- Quick Actions -->
                            <button class="btn-gradient text-white px-6 py-3 rounded-xl font-medium">
                                <i class="fas fa-plus mr-2"></i>
                                <span class="lang-id">Titip Barang</span>
                                <span class="lang-en">Store Item</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg card-hover border border-white/20">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-box text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">
                                    <span class="lang-id">Total Barang</span>
                                    <span class="lang-en">Total Items</span>
                                </p>
                                <p class="text-2xl font-bold text-gray-900">24</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg card-hover border border-white/20">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-lock text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">
                                    <span class="lang-id">Loker Terisi</span>
                                    <span class="lang-en">Occupied Lockers</span>
                                </p>
                                <p class="text-2xl font-bold text-gray-900">18</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg card-hover border border-white/20">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-clock text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">
                                    <span class="lang-id">Akan Berakhir</span>
                                    <span class="lang-en">Expiring Soon</span>
                                </p>
                                <p class="text-2xl font-bold text-gray-900">4</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg card-hover border border-white/20">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                                <i class="fas fa-unlock text-white text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">
                                    <span class="lang-id">Loker Kosong</span>
                                    <span class="lang-en">Available Lockers</span>
                                </p>
                                <p class="text-2xl font-bold text-gray-900">12</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                            <div class="p-6 border-b border-gray-200/50">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-box mr-3 text-purple-600"></i>
                                    <span class="lang-id">Barang Terbaru</span>
                                    <span class="lang-en">Recent Items</span>
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-helmet-safety text-white"></i>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">Helm Motor</p>
                                                <p class="text-sm text-gray-500">Loker A-15 • 2 jam lalu</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-lock mr-1"></i>
                                                <span class="lang-id">Aktif</span>
                                                <span class="lang-en">Active</span>
                                            </span>
                                            <p class="text-sm text-gray-500 mt-1">Berlaku 2 hari</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl border border-yellow-100">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-briefcase text-white"></i>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">Tas Laptop</p>
                                                <p class="text-sm text-gray-500">Loker B-08 • 5 jam lalu</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i>
                                                <span class="lang-id">Akan Berakhir</span>
                                                <span class="lang-en">Expiring</span>
                                            </span>
                                            <p class="text-sm text-gray-500 mt-1">Berlaku 1 hari</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border border-purple-100">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-shopping-bag text-white"></i>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">Tas Belanja</p>
                                                <p class="text-sm text-gray-500">Loker C-12 • 1 hari lalu</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-check mr-1"></i>
                                                <span class="lang-id">Siap Diambil</span>
                                                <span class="lang-en">Ready</span>
                                            </span>
                                            <p class="text-sm text-gray-500 mt-1">Berlaku 3 hari</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions & Locker Status -->
                    <div class="space-y-6">
                        <!-- Quick Actions -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                            <div class="p-6 border-b border-gray-200/50">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-bolt mr-3 text-purple-600"></i>
                                    <span class="lang-id">Aksi Cepat</span>
                                    <span class="lang-en">Quick Actions</span>
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-3">
                                    <button class="w-full flex items-center justify-center px-4 py-3 btn-gradient text-white rounded-xl font-medium">
                                        <i class="fas fa-plus mr-2"></i>
                                        <span class="lang-id">Titip Barang</span>
                                        <span class="lang-en">Store Item</span>
                                    </button>
                                    <button class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition duration-200">
                                        <i class="fas fa-box mr-2"></i>
                                        <span class="lang-id">Lihat Semua Barang</span>
                                        <span class="lang-en">View All Items</span>
                                    </button>
                                    <button class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition duration-200">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        <span class="lang-id">Cari Lokasi Loker</span>
                                        <span class="lang-en">Find Locker Location</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Locker Status -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                            <div class="p-6 border-b border-gray-200/50">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-lock mr-3 text-purple-600"></i>
                                    <span class="lang-id">Status Loker</span>
                                    <span class="lang-en">Locker Status</span>
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="locker-grid">
                                    <div class="locker-item locker-available" onclick="selectLocker('A1')">
                                        <i class="fas fa-unlock text-lg mb-1"></i>
                                        <p class="text-xs font-bold">A1</p>
                                        <p class="text-xs">Kosong</p>
                                    </div>
                                    <div class="locker-item locker-occupied" onclick="selectLocker('A2')">
                                        <i class="fas fa-lock text-lg mb-1"></i>
                                        <p class="text-xs font-bold">A2</p>
                                        <p class="text-xs">Terisi</p>
                                    </div>
                                    <div class="locker-item locker-available" onclick="selectLocker('A3')">
                                        <i class="fas fa-unlock text-lg mb-1"></i>
                                        <p class="text-xs font-bold">A3</p>
                                        <p class="text-xs">Kosong</p>
                                    </div>
                                    <div class="locker-item locker-maintenance" onclick="selectLocker('B1')">
                                        <i class="fas fa-tools text-lg mb-1"></i>
                                        <p class="text-xs font-bold">B1</p>
                                        <p class="text-xs">Maintenance</p>
                                    </div>
                                    <div class="locker-item locker-available" onclick="selectLocker('B2')">
                                        <i class="fas fa-unlock text-lg mb-1"></i>
                                        <p class="text-xs font-bold">B2</p>
                                        <p class="text-xs">Kosong</p>
                                    </div>
                                    <div class="locker-item locker-occupied" onclick="selectLocker('B3')">
                                        <i class="fas fa-lock text-lg mb-1"></i>
                                        <p class="text-xs font-bold">B3</p>
                                        <p class="text-xs">Terisi</p>
                                    </div>
                                    <div class="locker-item locker-reserved" onclick="selectLocker('C1')">
                                        <i class="fas fa-clock text-lg mb-1"></i>
                                        <p class="text-xs font-bold">C1</p>
                                        <p class="text-xs">Reserved</p>
                                    </div>
                                    <div class="locker-item locker-available" onclick="selectLocker('C2')">
                                        <i class="fas fa-unlock text-lg mb-1"></i>
                                        <p class="text-xs font-bold">C2</p>
                                        <p class="text-xs">Kosong</p>
                                    </div>
                                    <div class="locker-item locker-occupied" onclick="selectLocker('C3')">
                                        <i class="fas fa-lock text-lg mb-1"></i>
                                        <p class="text-xs font-bold">C3</p>
                                        <p class="text-xs">Terisi</p>
                                    </div>
                                </div>
                                
                                <!-- Legend -->
                                <div class="mt-6 grid grid-cols-2 gap-2 text-xs">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                        <span class="lang-id">Kosong</span>
                                        <span class="lang-en">Available</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                                        <span class="lang-id">Terisi</span>
                                        <span class="lang-en">Occupied</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                                        <span class="lang-id">Maintenance</span>
                                        <span class="lang-en">Maintenance</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                        <span class="lang-id">Reserved</span>
                                        <span class="lang-en">Reserved</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        // Global variables
        let selectedLocker = null;
        let lockerData = {
            'A1': { status: 'available', item: null, expiry: null },
            'A2': { status: 'occupied', item: 'Helm Motor', expiry: '2024-01-15' },
            'A3': { status: 'available', item: null, expiry: null },
            'B1': { status: 'maintenance', item: null, expiry: null },
            'B2': { status: 'available', item: null, expiry: null },
            'B3': { status: 'occupied', item: 'Tas Laptop', expiry: '2024-01-12' },
            'C1': { status: 'reserved', item: null, expiry: null },
            'C2': { status: 'available', item: null, expiry: null },
            'C3': { status: 'occupied', item: 'Tas Belanja', expiry: '2024-01-20' }
        };

        // Load saved preferences on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadPreferences();
            initializeLockerSystem();
            updateLockerDisplay();
        });

        function loadPreferences() {
            // Load theme preference
            const savedTheme = localStorage.getItem('theme') || 'light';
            applyTheme(savedTheme);
            
            // Load language preference
            const savedLanguage = localStorage.getItem('language') || 'id';
            applyLanguage(savedLanguage);
        }

        function applyTheme(theme) {
            const body = document.getElementById('main-body');
            
            // Remove existing theme classes
            body.classList.remove('dark-theme');
            
            // Apply new theme
            if (theme === 'dark') {
                body.classList.add('dark-theme');
            } else if (theme === 'system') {
                // Check system preference
                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    body.classList.add('dark-theme');
                }
            }
        }

        function applyLanguage(language) {
            const body = document.getElementById('main-body');
            
            // Remove existing language classes
            body.classList.remove('language-en');
            
            // Apply new language
            if (language === 'en') {
                body.classList.add('language-en');
            }
        }

        function initializeLockerSystem() {
            // Add click handlers for locker items
            document.querySelectorAll('.locker-item').forEach(item => {
                item.addEventListener('click', function() {
                    const lockerId = this.querySelector('p').textContent;
                    selectLocker(lockerId);
                });
            });

            // Add click handlers for quick action buttons
            document.querySelectorAll('button').forEach(button => {
                button.addEventListener('click', function() {
                    if (this.textContent.includes('Titip Barang') || this.textContent.includes('Store Item')) {
                        openStoreItemModal();
                    } else if (this.textContent.includes('Lihat Semua Barang') || this.textContent.includes('View All Items')) {
                        showAllItems();
                    } else if (this.textContent.includes('Cari Lokasi Loker') || this.textContent.includes('Find Locker Location')) {
                        showLockerLocations();
                    }
                });
            });
        }

        function selectLocker(lockerId) {
            selectedLocker = lockerId;
            const locker = lockerData[lockerId];
            
            // Remove previous selection
            document.querySelectorAll('.locker-item').forEach(item => {
                item.classList.remove('ring-4', 'ring-blue-500');
            });
            
            // Add selection to clicked locker
            const lockerElement = document.querySelector(`[onclick="selectLocker('${lockerId}')"]`);
            if (lockerElement) {
                lockerElement.classList.add('ring-4', 'ring-blue-500');
            }
            
            // Show locker info
            showLockerInfo(lockerId, locker);
        }

        function showLockerInfo(lockerId, locker) {
            const statusText = {
                'available': { id: 'Kosong', en: 'Available' },
                'occupied': { id: 'Terisi', en: 'Occupied' },
                'maintenance': { id: 'Maintenance', en: 'Maintenance' },
                'reserved': { id: 'Reserved', en: 'Reserved' }
            };
            
            const currentLanguage = localStorage.getItem('language') || 'id';
            const status = statusText[locker.status][currentLanguage];
            
            showNotification(`Loker ${lockerId}: ${status}${locker.item ? ` - ${locker.item}` : ''}`, 'info');
        }

        function openStoreItemModal() {
            if (!selectedLocker) {
                showNotification('Pilih loker terlebih dahulu!', 'warning');
                return;
            }
            
            const locker = lockerData[selectedLocker];
            if (locker.status !== 'available') {
                showNotification('Loker tidak tersedia!', 'error');
                return;
            }
            
            // Simulate opening store item modal
            showNotification(`Membuka form untuk menyimpan barang di loker ${selectedLocker}`, 'success');
        }

        function showAllItems() {
            showNotification('Membuka halaman semua barang...', 'info');
        }

        function showLockerLocations() {
            showNotification('Membuka peta lokasi loker...', 'info');
        }

        function updateLockerDisplay() {
            // Update locker status based on real-time data
            Object.keys(lockerData).forEach(lockerId => {
                const locker = lockerData[lockerId];
                const lockerElement = document.querySelector(`[onclick="selectLocker('${lockerId}')"]`);
                
                if (lockerElement) {
                    // Update icon based on status
                    const icon = lockerElement.querySelector('i');
                    if (icon) {
                        icon.className = getLockerIcon(locker.status);
                    }
                    
                    // Update status text
                    const statusText = lockerElement.querySelector('p:last-child');
                    if (statusText) {
                        const currentLanguage = localStorage.getItem('language') || 'id';
                        statusText.textContent = getStatusText(locker.status, currentLanguage);
                    }
                }
            });
        }

        function getLockerIcon(status) {
            const icons = {
                'available': 'fas fa-unlock text-lg mb-1',
                'occupied': 'fas fa-lock text-lg mb-1',
                'maintenance': 'fas fa-tools text-lg mb-1',
                'reserved': 'fas fa-clock text-lg mb-1'
            };
            return icons[status] || 'fas fa-question text-lg mb-1';
        }

        function getStatusText(status, language) {
            const statusTexts = {
                'available': { id: 'Kosong', en: 'Available' },
                'occupied': { id: 'Terisi', en: 'Occupied' },
                'maintenance': { id: 'Maintenance', en: 'Maintenance' },
                'reserved': { id: 'Reserved', en: 'Reserved' }
            };
            return statusTexts[status][language] || status;
        }

        function showNotification(message, type = 'info') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(notification => notification.remove());
            
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
            
            const colors = {
                'success': 'bg-green-500 text-white',
                'error': 'bg-red-500 text-white',
                'warning': 'bg-yellow-500 text-white',
                'info': 'bg-blue-500 text-white'
            };
            
            notification.className += ` ${colors[type] || colors.info}`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} mr-2"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // Listen for system theme changes
        if (window.matchMedia) {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
                const currentTheme = localStorage.getItem('theme');
                if (currentTheme === 'system') {
                    applyTheme('system');
                }
            });
        }

        // Listen for storage changes (when settings are changed in another tab)
        window.addEventListener('storage', function(e) {
            if (e.key === 'theme') {
                applyTheme(e.newValue);
            } else if (e.key === 'language') {
                applyLanguage(e.newValue);
                updateLockerDisplay();
            }
        });

        // Auto-hide success message
        setTimeout(function() {
            const successMessage = document.querySelector('.fixed.top-4.right-4');
            if (successMessage) {
                successMessage.style.opacity = '0';
                successMessage.style.transform = 'translateX(100%)';
                setTimeout(() => successMessage.remove(), 300);
            }
        }, 3000);

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Space to select first available locker
            if (e.code === 'Space' && !selectedLocker) {
                e.preventDefault();
                const availableLocker = document.querySelector('.locker-available');
                if (availableLocker) {
                    availableLocker.click();
                }
            }
            
            // Escape to clear selection
            if (e.key === 'Escape') {
                selectedLocker = null;
                document.querySelectorAll('.locker-item').forEach(item => {
                    item.classList.remove('ring-4', 'ring-blue-500');
                });
            }
        });
    </script>
</body>
</html>