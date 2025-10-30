<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Titip Barang - {{ config('app.name', 'Loker') }}</title>
    
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

        .locker-selected {
            border: 4px solid #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
        }

        .form-input {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }

        .form-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #6b7280;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .step-indicator.active {
            background: var(--primary-gradient);
            color: white;
        }

        .step-indicator.completed {
            background: #10b981;
            color: white;
        }

        .step-line {
            height: 2px;
            background: #e5e7eb;
            flex: 1;
            transition: all 0.3s ease;
        }

        .step-line.completed {
            background: #10b981;
        }

        /* Dark Theme Styles */
        .dark-theme {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%) !important;
            color: #e5e5e5 !important;
        }
        
        .dark-theme .bg-white {
            background: rgba(45, 45, 45, 0.8) !important;
            color: #e5e5e5 !important;
            backdrop-filter: blur(10px);
        }
        
        .dark-theme .bg-gray-100 {
            background: rgba(26, 26, 46, 0.8) !important;
        }
        
        .dark-theme .bg-gray-50 {
            background: rgba(45, 45, 45, 0.8) !important;
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
        
        .dark-theme .text-gray-900 {
            color: #f9fafb !important;
        }
        
        .dark-theme .border-gray-200 {
            border-color: #4b5563 !important;
        }
        
        .dark-theme .border-gray-300 {
            border-color: #6b7280 !important;
        }
        
        .dark-theme .border-white\/20 {
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        
        .dark-theme input, .dark-theme select, .dark-theme textarea {
            background: rgba(55, 65, 81, 0.8) !important;
            border-color: #6b7280 !important;
            color: #e5e5e5 !important;
        }
        
        .dark-theme input:focus, .dark-theme select:focus, .dark-theme textarea:focus {
            border-color: #8b5cf6 !important;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1) !important;
        }
        
        .dark-theme .bg-white\/80 {
            background: rgba(45, 45, 45, 0.8) !important;
        }
        
        .dark-theme .bg-white\/20 {
            background: rgba(255, 255, 255, 0.1) !important;
        }
        
        .dark-theme .bg-gradient-to-br {
            background: linear-gradient(135deg, rgba(45, 45, 45, 0.8) 0%, rgba(26, 26, 46, 0.8) 100%) !important;
        }
        
        .dark-theme .bg-gradient-to-r {
            background: linear-gradient(90deg, rgba(45, 45, 45, 0.8) 0%, rgba(26, 26, 46, 0.8) 100%) !important;
        }
        
        .dark-theme .sidebar-gradient {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        }
        
        .dark-theme .glass-effect {
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .dark-theme .step-indicator {
            background: #4b5563 !important;
            color: #9ca3af !important;
        }
        
        .dark-theme .step-indicator.active {
            background: var(--primary-gradient) !important;
            color: white !important;
        }
        
        .dark-theme .step-indicator.completed {
            background: #10b981 !important;
            color: white !important;
        }
        
        .dark-theme .step-line {
            background: #4b5563 !important;
        }
        
        .dark-theme .step-line.completed {
            background: #10b981 !important;
        }

        /* Enhanced Visual Effects */
        .pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite alternate;
        }

        @keyframes pulseGlow {
            from { box-shadow: 0 0 20px rgba(102, 126, 234, 0.3); }
            to { box-shadow: 0 0 30px rgba(102, 126, 234, 0.6); }
        }

        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
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

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-card {
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.6s;
        }

        .form-card:hover::before {
            left: 100%;
        }

        .icon-hover-scale {
            transition: transform 0.3s ease;
        }

        .icon-hover-scale:hover {
            transform: scale(1.2) rotate(5deg);
        }

        .input-focus-effect:focus {
            animation: inputPulse 0.5s ease-out;
        }

        @keyframes inputPulse {
            0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
            100% { box-shadow: 0 0 0 8px rgba(102, 126, 234, 0); }
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
                    <a href="{{ route('dashboard') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-home w-5 h-5 mr-3"></i>
                        <span class="lang-id">Dashboard</span>
                        <span class="lang-en">Dashboard</span>
                    </a>
                    <a href="#" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-xl">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        <span class="lang-id">Titip Barang</span>
                        <span class="lang-en">Store Item</span>
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
            <header class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-gray-200/50 relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 25% 25%, #667eea 0%, transparent 50%), radial-gradient(circle at 75% 75%, #764ba2 0%, transparent 50%);"></div>
                </div>
                
                <div class="px-6 py-6 relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="slide-in">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center pulse-glow">
                                    <i class="fas fa-box text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-3xl font-bold gradient-text flex items-center">
                                        <span class="lang-id">Titip Barang</span>
                                        <span class="lang-en">Store Item</span>
                                    </h2>
                                    <p class="text-gray-600 mt-1 flex items-center">
                                        <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                                        <span class="lang-id">Simpan barang Anda dengan aman di loker yang tersedia</span>
                                        <span class="lang-en">Store your items safely in available lockers</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-xl transition-all duration-300 hover:scale-105 text-gray-700 font-medium">
                                <i class="fas fa-arrow-left mr-2"></i>
                                <span class="lang-id">Kembali</span>
                                <span class="lang-en">Back</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <!-- Progress Steps -->
                <div class="mb-8">
                    <div class="flex items-center justify-center space-x-4">
                        <div class="flex items-center">
                            <div class="step-indicator active" id="step-1">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="ml-4 text-center">
                                <p class="text-sm font-medium text-gray-900">
                                    <span class="lang-id">Pilih Loker</span>
                                    <span class="lang-en">Select Locker</span>
                                </p>
                            </div>
                        </div>
                        <div class="step-line"></div>
                        <div class="flex items-center">
                            <div class="step-indicator" id="step-2">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="ml-4 text-center">
                                <p class="text-sm font-medium text-gray-500">
                                    <span class="lang-id">Detail Barang</span>
                                    <span class="lang-en">Item Details</span>
                                </p>
                            </div>
                        </div>
                        <div class="step-line"></div>
                        <div class="flex items-center">
                            <div class="step-indicator" id="step-3">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="ml-4 text-center">
                                <p class="text-sm font-medium text-gray-500">
                                    <span class="lang-id">Konfirmasi</span>
                                    <span class="lang-en">Confirmation</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Locker Selection -->
                    <div class="lg:col-span-2">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                            <div class="p-6 border-b border-gray-200/50">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-lock mr-3 text-purple-600"></i>
                                    <span class="lang-id">Pilih Loker</span>
                                    <span class="lang-en">Select Locker</span>
                                </h3>
                                <p class="text-gray-600 mt-1">
                                    <span class="lang-id">Pilih loker yang tersedia untuk menyimpan barang Anda</span>
                                    <span class="lang-en">Choose an available locker to store your item</span>
                                </p>
                            </div>
                            <div class="p-6">
                                <div class="locker-grid" id="locker-grid">
                                    <!-- Locker items will be generated by JavaScript -->
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

                    <!-- Item Details Form -->
                    <div class="space-y-6">
                        <!-- Selected Locker Info -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 form-card bounce-in" id="selected-locker-info" style="display: none;">
                            <div class="p-6 border-b border-gray-200/50">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-info-circle mr-3 text-purple-600"></i>
                                    <span class="lang-id">Loker Terpilih</span>
                                    <span class="lang-en">Selected Locker</span>
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-lock text-white text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-semibold text-gray-900" id="selected-locker-id">-</h4>
                                    <p class="text-sm text-gray-500">
                                        <span class="lang-id">Siap untuk digunakan</span>
                                        <span class="lang-en">Ready to use</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Item Form -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 form-card bounce-in" id="item-form" style="display: none;">
                            <div class="p-6 border-b border-gray-200/50">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-box mr-3 text-purple-600"></i>
                                    <span class="lang-id">Detail Barang</span>
                                    <span class="lang-en">Item Details</span>
                                </h3>
                            </div>
                            <div class="p-6">
                                <form id="store-item-form">
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-tag mr-2 text-purple-600"></i>
                                                <span class="lang-id">Nama Barang</span>
                                                <span class="lang-en">Item Name</span>
                                            </label>
                                            <input type="text" id="item-name" class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-purple-500 input-focus-effect" placeholder="Masukkan nama barang">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="lang-id">Kategori</span>
                                                <span class="lang-en">Category</span>
                                            </label>
                                            <select id="item-category" class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-purple-500">
                                                <option value="">
                                                    <span class="lang-id">Pilih kategori</span>
                                                    <span class="lang-en">Select category</span>
                                                </option>
                                                <option value="electronics">Electronics</option>
                                                <option value="clothing">Clothing</option>
                                                <option value="documents">Documents</option>
                                                <option value="valuables">Valuables</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="lang-id">Durasi Penyimpanan</span>
                                                <span class="lang-en">Storage Duration</span>
                                            </label>
                                            <select id="storage-duration" class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-purple-500">
                                                <option value="1">1 Hari</option>
                                                <option value="3">3 Hari</option>
                                                <option value="7">1 Minggu</option>
                                                <option value="14">2 Minggu</option>
                                                <option value="30">1 Bulan</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="lang-id">Deskripsi (Opsional)</span>
                                                <span class="lang-en">Description (Optional)</span>
                                            </label>
                                            <textarea id="item-description" rows="3" class="form-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-purple-500" placeholder="Deskripsi tambahan..."></textarea>
                                        </div>

                                        <div class="pt-4">
                                            <button type="submit" class="w-full btn-gradient text-white px-6 py-3 rounded-xl font-medium">
                                                <i class="fas fa-save mr-2"></i>
                                                <span class="lang-id">Simpan Barang</span>
                                                <span class="lang-en">Store Item</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Quick Tips -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-lightbulb mr-2 text-yellow-500"></i>
                                <span class="lang-id">Tips Penting</span>
                                <span class="lang-en">Important Tips</span>
                            </h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                    <span class="lang-id">Pastikan barang tidak mengandung barang berbahaya</span>
                                    <span class="lang-en">Ensure items don't contain hazardous materials</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                    <span class="lang-id">Simpan barang berharga dengan hati-hati</span>
                                    <span class="lang-en">Store valuable items carefully</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                    <span class="lang-id">Periksa tanggal kadaluarsa penyimpanan</span>
                                    <span class="lang-en">Check storage expiration date</span>
                                </li>
                            </ul>
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
        let currentStep = 1;
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
            generateLockerGrid();
            
            // Add form submission handler
            document.getElementById('store-item-form').addEventListener('submit', function(e) {
                e.preventDefault();
                submitItem();
            });
        }

        function generateLockerGrid() {
            const grid = document.getElementById('locker-grid');
            grid.innerHTML = '';
            
            Object.keys(lockerData).forEach(lockerId => {
                const locker = lockerData[lockerId];
                const lockerElement = document.createElement('div');
                lockerElement.className = `locker-item locker-${locker.status}`;
                lockerElement.onclick = () => selectLocker(lockerId);
                
                const icon = getLockerIcon(locker.status);
                const statusText = getStatusText(locker.status, localStorage.getItem('language') || 'id');
                
                lockerElement.innerHTML = `
                    <i class="${icon}"></i>
                    <p class="text-xs font-bold">${lockerId}</p>
                    <p class="text-xs">${statusText}</p>
                `;
                
                grid.appendChild(lockerElement);
            });
        }

        function selectLocker(lockerId) {
            const locker = lockerData[lockerId];
            
            if (locker.status !== 'available') {
                showNotification('Loker tidak tersedia!', 'error');
                return;
            }
            
            selectedLocker = lockerId;
            
            // Remove previous selection
            document.querySelectorAll('.locker-item').forEach(item => {
                item.classList.remove('locker-selected');
            });
            
            // Add selection to clicked locker
            const lockerElement = document.querySelector(`[onclick="selectLocker('${lockerId}')"]`);
            if (lockerElement) {
                lockerElement.classList.add('locker-selected');
            }
            
            // Show selected locker info and form
            showSelectedLockerInfo(lockerId);
            showItemForm();
            updateStep(2);
        }

        function showSelectedLockerInfo(lockerId) {
            const infoDiv = document.getElementById('selected-locker-info');
            const lockerIdElement = document.getElementById('selected-locker-id');
            
            lockerIdElement.textContent = lockerId;
            infoDiv.style.display = 'block';
        }

        function showItemForm() {
            const formDiv = document.getElementById('item-form');
            formDiv.style.display = 'block';
        }

        function updateStep(step) {
            currentStep = step;
            
            // Update step indicators
            for (let i = 1; i <= 3; i++) {
                const stepElement = document.getElementById(`step-${i}`);
                if (i < step) {
                    stepElement.classList.add('completed');
                    stepElement.classList.remove('active');
                } else if (i === step) {
                    stepElement.classList.add('active');
                    stepElement.classList.remove('completed');
                } else {
                    stepElement.classList.remove('active', 'completed');
                }
            }
        }

        function submitItem() {
            if (!selectedLocker) {
                showNotification('Pilih loker terlebih dahulu!', 'warning');
                return;
            }
            
            const itemName = document.getElementById('item-name').value;
            const itemCategory = document.getElementById('item-category').value;
            const storageDuration = document.getElementById('storage-duration').value;
            const itemDescription = document.getElementById('item-description').value;
            
            if (!itemName || !itemCategory || !storageDuration) {
                showNotification('Lengkapi semua field yang wajib diisi!', 'warning');
                return;
            }
            
            // Simulate storing item
            showNotification('Barang berhasil disimpan!', 'success');
            updateStep(3);
            
            // Reset form after 2 seconds
            setTimeout(() => {
                resetForm();
            }, 2000);
        }

        function resetForm() {
            selectedLocker = null;
            currentStep = 1;
            
            // Reset form
            document.getElementById('store-item-form').reset();
            
            // Hide elements
            document.getElementById('selected-locker-info').style.display = 'none';
            document.getElementById('item-form').style.display = 'none';
            
            // Reset locker selection
            document.querySelectorAll('.locker-item').forEach(item => {
                item.classList.remove('locker-selected');
            });
            
            // Reset steps
            updateStep(1);
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
    </script>
</body>
</html>
