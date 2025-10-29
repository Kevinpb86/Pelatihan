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

        .progress-ring {
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            stroke-dasharray: 251.2;
            stroke-dashoffset: 251.2;
            transition: stroke-dashoffset 0.5s ease-in-out;
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

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .activity-item {
            position: relative;
            padding-left: 2rem;
        }

        .activity-item::before {
            content: '';
            position: absolute;
            left: 0.5rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, #667eea, #764ba2);
        }

        .activity-dot {
            position: absolute;
            left: 0.25rem;
            top: 0.5rem;
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 50%;
            background: #667eea;
            border: 2px solid white;
        }

        /* Button Animations */
        .action-button {
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .action-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .action-button:hover::before {
            left: 100%;
        }

        .action-button:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .action-button:hover .action-icon {
            transform: scale(1.2) rotate(5deg);
            animation: pulse 1s infinite;
        }

        .action-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1.2) rotate(5deg); }
            50% { transform: scale(1.3) rotate(-5deg); }
        }

        .action-button:active {
            transform: translateY(-2px) scale(1.02);
        }

        /* Specific button colors */
        .btn-store:hover {
            box-shadow: 0 20px 25px -5px rgba(102, 126, 234, 0.4), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-view:hover {
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.4), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-location:hover {
            box-shadow: 0 20px 25px -5px rgba(34, 197, 94, 0.4), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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

        /* primary gradient button — gunakan untuk semua tombol utama */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            box-shadow: 0 6px 18px rgba(118,75,162,0.18);
        }
        .btn-primary:active { transform: translateY(1px) scale(0.995); }

        /* for buttons that previously looked like outline, keep subtle white bg but gradient border */
        .btn-primary-outline {
            background: rgba(255,255,255,0.06);
            color: #fff;
            padding: 12px 18px;
            border-radius: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        .btn-primary-outline::before {
            content: "";
            position: absolute;
            inset: 0;
            padding: 1px;
            border-radius: 12px;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            opacity: 0.95;
        }

        /* ripple / click animation (shared) */
        .btn-animate { position: relative; overflow: hidden; -webkit-tap-highlight-color: transparent; touch-action: manipulation; }
        .btn-animate .ripple {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            background: rgba(255,255,255,0.35);
            animation: ripple 600ms linear;
            pointer-events: none;
            will-change: transform, opacity;
        }
        @keyframes ripple {
            to { transform: scale(4); opacity: 0; }
        }

        /* visual press feedback so user sees immediate response on pointerdown */
        .btn-animate:active,
        .btn-animate.btn-pressing {
            transform: translateY(1px) scale(0.995);
            transition: transform 120ms ease;
            box-shadow: 0 6px 14px rgba(0,0,0,0.06) inset;
        }

        /* make nav-items that use btn-animate also visually consistent */
        .nav-item.btn-animate { border-radius: 10px; padding-left: .9rem; padding-right: .9rem; }

        /* tambahkan di dalam <style> (atau gabungkan ke bagian style yang ada) */
        .popup-overlay{
            position:fixed;inset:0;background:rgba(15,23,42,0.45);display:flex;align-items:center;justify-content:center;z-index:9999;backdrop-filter:blur(4px);
            animation: overlayFade .22s ease forwards;
        }
        @keyframes overlayFade{from{opacity:0}to{opacity:1}}
        .popup-card{
            width:320px;max-width:calc(100% - 40px);background:linear-gradient(180deg,rgba(255,255,255,0.98),rgba(250,250,255,0.98));
            border-radius:14px;box-shadow:0 18px 50px rgba(2,6,23,0.36);padding:18px;text-align:center;transform:scale(.96);opacity:0;
            animation: popupIn .34s cubic-bezier(.2,.9,.2,1) forwards;display:flex;flex-direction:column;gap:12px;align-items:center;
        }
        @keyframes popupIn{from{transform:translateY(8px) scale(.94);opacity:0}60%{transform:translateY(-6px) scale(1.02);opacity:1}to{transform:translateY(0) scale(1);opacity:1}}
        @keyframes popupOut{from{transform:scale(1);opacity:1}to{transform:scale(.96);opacity:0}}
        .popup-title{font-weight:700;font-size:15px;color:#0f172a}
        .popup-sub{font-size:13px;color:#475569}
        .popup-spinner{width:44px;height:44px;border-radius:50%;border:4px solid rgba(118,75,162,0.14);border-top-color:#6d28d9;animation:spin .8s linear infinite;box-shadow:0 6px 18px rgba(109,40,217,0.12) inset}
        @keyframes spin{to{transform:rotate(360deg)}}

        /* tombol efek tekan */
        .btn-pressing{transform:translateY(1px) scale(.996);transition:transform 120ms ease}

        /* Hover effects untuk Quick Actions buttons */
        .quick-action-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .quick-action-btn:hover {
            transform: translateY(-4px) scale(1.03);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .quick-action-btn:hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 0.8s ease-in-out;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .quick-action-btn i {
            transition: transform 0.3s ease;
        }

        .quick-action-btn:hover i {
            transform: scale(1.2) rotate(5deg);
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
                    <!-- Modified: add onclick animateAndNavigate and btn-animate -->
                    <a href="{{ route('dashboard') }}" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-xl">
                        <i class="fas fa-home w-5 h-5 mr-3"></i>
                        <span class="lang-id">Dashboard</span>
                        <span class="lang-en">Dashboard</span>
                    </a>

                    <a href="{{ route('items.index') }}"

                       onclick="animateAndNavigate(event, '{{ route('items.index') }}')"
                       class="nav-item btn-animate flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
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
                    <div class="relative w-12 h-12 rounded-full overflow-hidden shadow-lg">
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : '' }}" alt="Avatar" class="w-full h-full object-cover {{ Auth::user()->avatar ? '' : 'hidden' }}">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center {{ Auth::user()->avatar ? 'hidden' : '' }}">
                            <span class="text-white text-lg font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
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
                                    <i class="fas fa-lock text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-3xl font-bold gradient-text flex items-center">
                                        <span class="lang-id">Selamat Datang, {{ Auth::user()->name }}!</span>
                                        <span class="lang-en">Welcome, {{ Auth::user()->name }}!</span>
                                    </h2>
                                    <p class="text-gray-600 mt-1 flex items-center">
                                        <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                                        <span class="lang-id">Kelola penitipan barang Anda dengan mudah dan aman</span>
                                        <span class="lang-en">Manage your item storage easily and securely</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Theme Toggle -->
                            <button id="theme-toggle" class="p-3 rounded-xl bg-gray-100 hover:bg-gray-200 transition-all duration-300 hover:scale-105">
                                <i class="fas fa-moon text-gray-600" id="theme-icon"></i>
                            </button>
                            <!-- Language Toggle -->
                            <button id="language-toggle" class="p-3 rounded-xl bg-gray-100 hover:bg-gray-200 transition-all duration-300 hover:scale-105">
                                <i class="fas fa-globe text-gray-600"></i>
                            </button>
                            <!-- Search Bar -->
                            <div class="relative group">
                                <input type="text" placeholder="Cari barang..." class="w-64 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 group-hover:shadow-lg">
                                <i class="fas fa-search absolute right-3 top-3.5 text-gray-400 group-hover:text-purple-500 transition-colors"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg stat-card border border-white/20 bounce-in">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shimmer">
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
                            <div class="text-right">
                                <div class="text-xs text-green-600 font-medium">
                                    <i class="fas fa-arrow-up mr-1"></i>
                                    +12%
                                </div>
                                <div class="text-xs text-gray-500">vs bulan lalu</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg stat-card border border-white/20 bounce-in" style="animation-delay: 0.1s;">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shimmer">
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
                            <div class="text-right">
                                <div class="w-12 h-12 relative">
                                    <svg class="progress-ring w-12 h-12">
                                        <circle class="progress-ring-circle" stroke="#10b981" stroke-width="3" fill="transparent" r="40" cx="24" cy="24" style="stroke-dashoffset: 75.36;"></circle>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-xs font-bold text-green-600">75%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg stat-card border border-white/20 bounce-in" style="animation-delay: 0.2s;">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center shimmer">
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
                            <div class="text-right">
                                <div class="text-xs text-yellow-600 font-medium">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Perhatian
                                </div>
                                <div class="text-xs text-gray-500">perlu tindakan</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg stat-card border border-white/20 bounce-in" style="animation-delay: 0.3s;">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center shimmer">
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
                            <div class="text-right">
                                <div class="text-xs text-blue-600 font-medium">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Tersedia
                                </div>
                                <div class="text-xs text-gray-500">siap digunakan</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Items & Activity -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Recent Items -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                            <div class="p-6 border-b border-gray-200/50">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                        <i class="fas fa-box mr-3 text-purple-600"></i>
                                        <span class="lang-id">Barang Terbaru</span>
                                        <span class="lang-en">Recent Items</span>
                                    </h3>
                                    <button class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                                        <span class="lang-id">Lihat Semua</span>
                                        <span class="lang-en">View All</span>
                                        <i class="fas fa-arrow-right ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100 hover:shadow-md transition-all duration-300 group">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
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

                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-xl border border-yellow-100 hover:shadow-md transition-all duration-300 group">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
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

                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border border-purple-100 hover:shadow-md transition-all duration-300 group">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
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

                        <!-- Recent Activity -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                            <div class="p-6 border-b border-gray-200/50">
                                <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-history mr-3 text-green-600"></i>
                                    <span class="lang-id">Aktivitas Terbaru</span>
                                    <span class="lang-en">Recent Activity</span>
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <div class="activity-item">
                                        <div class="activity-dot bg-green-500"></div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">
                                                    <span class="lang-id">Barang baru dititipkan</span>
                                                    <span class="lang-en">New item stored</span>
                                                </p>
                                                <p class="text-xs text-gray-500">Helm Motor di Loker A-15</p>
                                            </div>
                                            <span class="text-xs text-gray-400">2 jam lalu</span>
                                        </div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-dot bg-blue-500"></div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">
                                                    <span class="lang-id">Loker dibuka</span>
                                                    <span class="lang-en">Locker opened</span>
                                                </p>
                                                <p class="text-xs text-gray-500">Loker B-08 untuk mengambil tas</p>
                                            </div>
                                            <span class="text-xs text-gray-400">5 jam lalu</span>
                                        </div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-dot bg-yellow-500"></div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">
                                                    <span class="lang-id">Pengingat kadaluarsa</span>
                                                    <span class="lang-en">Expiration reminder</span>
                                                </p>
                                                <p class="text-xs text-gray-500">Tas Laptop akan berakhir besok</p>
                                            </div>
                                            <span class="text-xs text-gray-400">1 hari lalu</span>
                                        </div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-dot bg-purple-500"></div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">
                                                    <span class="lang-id">Profil diperbarui</span>
                                                    <span class="lang-en">Profile updated</span>
                                                </p>
                                                <p class="text-xs text-gray-500">Foto profil dan informasi pribadi</p>
                                            </div>
                                            <span class="text-xs text-gray-400">2 hari lalu</span>
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
                                    <button onclick="animateAndNavigate(event, '{{ route('store-item') }}')" class="w-full action-button btn-store flex items-center justify-center px-4 py-3 btn-primary btn-animate rounded-xl font-medium">
                                        <i class="fas fa-plus mr-2 action-icon"></i>
                                        <span class="lang-id">Titip Barang</span>
                                        <span class="lang-en">Store Item</span>
                                    </button>
                                    <button onclick="animateAndNavigate(event, '{{ route('items.index') }}')" class="w-full action-button btn-view flex items-center justify-center px-4 py-3 btn-primary btn-animate rounded-xl font-medium">
                                        <i class="fas fa-box mr-2 action-icon"></i>
                                        <span class="lang-id">Lihat Barang Saya</span>
                                        <span class="lang-en">View All Items</span>
                                    </button>
                                    <button onclick="animateAndNavigate(event, '#')" class="w-full action-button btn-location flex items-center justify-center px-4 py-3 btn-primary btn-animate rounded-xl font-medium">
                                        <i class="fas fa-map-marker-alt mr-2 action-icon"></i>
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
            initializeThemeToggle();
            initializeLanguageToggle();
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

        function initializeThemeToggle() {
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    const currentTheme = localStorage.getItem('theme') || 'light';
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    changeTheme(newTheme);
                });
            }
        }

        function initializeLanguageToggle() {
            const languageToggle = document.getElementById('language-toggle');
            if (languageToggle) {
                languageToggle.addEventListener('click', function() {
                    const currentLanguage = localStorage.getItem('language') || 'id';
                    const newLanguage = currentLanguage === 'id' ? 'en' : 'id';
                    changeLanguage(newLanguage);
                });
            }
        }

        function changeTheme(theme) {
            const body = document.getElementById('main-body');
            const themeIcon = document.getElementById('theme-icon');
            
            // Remove existing theme classes
            body.classList.remove('dark-theme');
            
            // Apply new theme
            if (theme === 'dark') {
                body.classList.add('dark-theme');
                if (themeIcon) {
                    themeIcon.className = 'fas fa-sun text-yellow-500';
                }
            } else if (theme === 'system') {
                // Check system preference
                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    body.classList.add('dark-theme');
                }
                if (themeIcon) {
                    themeIcon.className = 'fas fa-desktop text-gray-600';
                }
            } else {
                if (themeIcon) {
                    themeIcon.className = 'fas fa-moon text-gray-600';
                }
            }
            
            // Save to localStorage
            localStorage.setItem('theme', theme);
            
            // Show notification
            showNotification('Tema berhasil diubah!', 'success');
        }

        function changeLanguage(language) {
            const body = document.getElementById('main-body');
            
            // Remove existing language classes
            body.classList.remove('language-en');
            
            // Apply new language
            if (language === 'en') {
                body.classList.add('language-en');
            }
            
            // Save to localStorage
            localStorage.setItem('language', language);
            
            // Update locker display
            updateLockerDisplay();
            
            // Show notification
            const message = language === 'en' ? 'Language changed to English!' : 'Bahasa diubah ke Indonesia!';
            showNotification(message, 'success');
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
                    if (this.textContent.includes('Lihat Semua Barang') || this.textContent.includes('View All Items')) {
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

        // Ripple navigation helper — shared across dashboard & my-items views
        function animateAndNavigate(e, url) {
            e.preventDefault();
            const el = e.currentTarget;
            // ensure ripple runs if pointerdown didn't create one
            if (!el.querySelector('.ripple')) createRipple(el, e);
            // small delay so animation visible, then navigate (if url is '#', do nothing)
            setTimeout(() => {
                if (url && url !== '#') window.location.href = url;
            }, 260);
        }

        // create ripple helper (used on pointerdown)
        function createRipple(el, e) {
            // add pressing class for quick scale feedback
            el.classList.add('btn-pressing');
            const rect = el.getBoundingClientRect();
            const ripple = document.createElement('span');
            ripple.className = 'ripple';
            const size = Math.max(rect.width, rect.height) * 1.2;
            ripple.style.width = ripple.style.height = size + 'px';
            // position ripple using pointer coordinates; fallback center
            const clientX = (e && (e.clientX || (e.touches && e.touches[0] && e.touches[0].clientX))) || (rect.left + rect.width/2);
            const clientY = (e && (e.clientY || (e.touches && e.touches[0] && e.touches[0].clientY))) || (rect.top + rect.height/2);
            const x = clientX - rect.left - size / 2;
            const y = clientY - rect.top - size / 2;
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            el.appendChild(ripple);

            // remove pressing class & ripple after animation
            setTimeout(() => el.classList.remove('btn-pressing'), 160);
            setTimeout(() => { if (ripple && ripple.parentNode) ripple.parentNode.removeChild(ripple); }, 700);
        }

        // attach pointer handlers to all .btn-animate (run once)
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-animate, .nav-item.btn-animate').forEach(el => {
                // use pointerdown for mouse/touch/stylus immediate feedback
                el.addEventListener('pointerdown', function(ev) {
                    // prevent multiple ripples stacking quickly
                    createRipple(this, ev);
                }, { passive: true });

                // if element used anchor (<a>) and has href, prevent default only in animateAndNavigate;
                // leave click handlers untouched so animateAndNavigate still navigates after delay.
                // Optional: add keyboard support (Enter/Space) to show ripple
                el.addEventListener('keydown', function(ev) {
                    if (ev.key === 'Enter' || ev.code === 'Space') {
                        createRipple(this, ev);
                    }
                });
            });
        });

        /* tambahkan di akhir <script> atau gabungkan dengan script yang ada */
function createPopup(messageMain='Memproses...', messageSub='') {
    const overlay = document.createElement('div'); overlay.className='popup-overlay';
    const card = document.createElement('div'); card.className='popup-card';
    const spinner = document.createElement('div'); spinner.className='popup-spinner';
    const title = document.createElement('div'); title.className='popup-title'; title.textContent = messageMain;
    const sub = document.createElement('div'); sub.className='popup-sub'; sub.textContent = messageSub;
    card.appendChild(spinner); card.appendChild(title); if(messageSub) card.appendChild(sub);
    overlay.appendChild(card); document.body.appendChild(overlay);
    return {
        close(delay=0){
            setTimeout(()=>{ card.style.animation='popupOut .18s ease forwards'; overlay.style.animation='overlayFade .18s reverse forwards';
                setTimeout(()=>{ if(overlay.parentNode) overlay.parentNode.removeChild(overlay); }, 220);
            }, delay);
        }
    };
}

function showPopupAndNavigate(e, url, message){
    if(e && e.preventDefault) e.preventDefault();
    const btn = e && e.currentTarget ? e.currentTarget : null;
    if(btn) { btn.classList.add('btn-pressing'); setTimeout(()=>btn.classList.remove('btn-pressing'), 220); }
    const popup = createPopup(message || 'Memproses...');
    const NAV_DELAY = 600; // waktu tampil popup sebelum pindah halaman
    setTimeout(()=> {
        if(url && url !== '#'){
            popup.close(0);
            setTimeout(()=> window.location.href = url, 180);
        } else {
            popup.close(700);
        }
    }, NAV_DELAY);
}

/* optional: berikan feedback tekan saat pointerdown */
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.btn-animate').forEach(el=>{
        el.addEventListener('pointerdown', function(ev){
            this.classList.add('btn-pressing');
            setTimeout(()=> this.classList.remove('btn-pressing'), 140);
        }, {passive:true});
        el.addEventListener('keydown', function(ev){
            if(ev.key==='Enter' || ev.code==='Space'){ this.classList.add('btn-pressing'); setTimeout(()=> this.classList.remove('btn-pressing'),140); }
        });
    });
});
    </script>
</body>
</html>