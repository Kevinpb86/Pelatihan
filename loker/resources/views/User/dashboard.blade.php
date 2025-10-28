<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ config('app.name', 'Loker') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
        <div class="w-64 bg-white shadow-lg">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h1 class="ml-3 text-xl font-bold text-gray-800">LokerHub</h1>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6">
                <div class="px-6">
                    <div class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                            </svg>
                            Dashboard
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Paket Saya
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Lokasi Loker
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Statistik
                        </a>
                        <a href="{{ route('settings') }}" class="flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Pengaturan
                        </a>
                    </div>
                </div>
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-0 w-64 p-6 border-t border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200">
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h2>
                            <p class="text-gray-600">Kelola paket dan loker Anda dengan mudah</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <input type="text" placeholder="Cari paket..." class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <svg class="absolute right-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <button class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:from-purple-700 hover:to-blue-700 transition duration-200">
                                + Paket Baru
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl p-6 shadow-sm card-hover">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Paket</p>
                                <p class="text-2xl font-bold text-gray-900">24</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm card-hover">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Terkirim</p>
                                <p class="text-2xl font-bold text-gray-900">18</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm card-hover">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-100 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Dalam Proses</p>
                                <p class="text-2xl font-bold text-gray-900">4</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm card-hover">
                        <div class="flex items-center">
                            <div class="p-3 bg-red-100 rounded-lg">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Loker Aktif</p>
                                <p class="text-2xl font-bold text-gray-900">12</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Packages -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Paket Terbaru</h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">Paket #LB001</p>
                                                <p class="text-sm text-gray-500">Dari: Toko Online ABC</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Terkirim
                                            </span>
                                            <p class="text-sm text-gray-500 mt-1">2 jam lalu</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">Paket #LB002</p>
                                                <p class="text-sm text-gray-500">Dari: Marketplace XYZ</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Dalam Proses
                                            </span>
                                            <p class="text-sm text-gray-500 mt-1">5 jam lalu</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">Paket #LB003</p>
                                                <p class="text-sm text-gray-500">Dari: E-commerce DEF</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Menunggu
                                            </span>
                                            <p class="text-sm text-gray-500 mt-1">1 hari lalu</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions & Locker Status -->
                    <div class="space-y-6">
                        <!-- Quick Actions -->
                        <div class="bg-white rounded-xl shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Aksi Cepat</h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-3">
                                    <button class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg font-medium hover:from-purple-700 hover:to-blue-700 transition duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Tambah Paket
                                    </button>
                                    <button class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Lihat Semua Paket
                                    </button>
                                    <button class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Cari Lokasi Loker
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Locker Status -->
                        <div class="bg-white rounded-xl shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Status Loker</h3>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="text-center p-3 bg-green-100 rounded-lg">
                                        <div class="w-8 h-8 bg-green-500 rounded-full mx-auto mb-2"></div>
                                        <p class="text-xs font-medium text-green-800">A1</p>
                                        <p class="text-xs text-green-600">Kosong</p>
                                    </div>
                                    <div class="text-center p-3 bg-red-100 rounded-lg">
                                        <div class="w-8 h-8 bg-red-500 rounded-full mx-auto mb-2"></div>
                                        <p class="text-xs font-medium text-red-800">A2</p>
                                        <p class="text-xs text-red-600">Terisi</p>
                                    </div>
                                    <div class="text-center p-3 bg-green-100 rounded-lg">
                                        <div class="w-8 h-8 bg-green-500 rounded-full mx-auto mb-2"></div>
                                        <p class="text-xs font-medium text-green-800">A3</p>
                                        <p class="text-xs text-green-600">Kosong</p>
                                    </div>
                                    <div class="text-center p-3 bg-yellow-100 rounded-lg">
                                        <div class="w-8 h-8 bg-yellow-500 rounded-full mx-auto mb-2"></div>
                                        <p class="text-xs font-medium text-yellow-800">B1</p>
                                        <p class="text-xs text-yellow-600">Maintenance</p>
                                    </div>
                                    <div class="text-center p-3 bg-green-100 rounded-lg">
                                        <div class="w-8 h-8 bg-green-500 rounded-full mx-auto mb-2"></div>
                                        <p class="text-xs font-medium text-green-800">B2</p>
                                        <p class="text-xs text-green-600">Kosong</p>
                                    </div>
                                    <div class="text-center p-3 bg-red-100 rounded-lg">
                                        <div class="w-8 h-8 bg-red-500 rounded-full mx-auto mb-2"></div>
                                        <p class="text-xs font-medium text-red-800">B3</p>
                                        <p class="text-xs text-red-600">Terisi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Auto-hide success message -->
    <script>
        // Load saved preferences on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadPreferences();
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
            }
        });

        setTimeout(function() {
            const successMessage = document.querySelector('.fixed.top-4.right-4');
            if (successMessage) {
                successMessage.style.opacity = '0';
                successMessage.style.transform = 'translateX(100%)';
                setTimeout(() => successMessage.remove(), 300);
            }
        }, 3000);
    </script>
</body>
</html>