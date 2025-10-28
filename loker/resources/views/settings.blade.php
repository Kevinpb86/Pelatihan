<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaturan - {{ config('app.name', 'Loker') }}</title>
    
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
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 #f7fafc;
        }

        *::-webkit-scrollbar {
            width: 6px;
        }

        *::-webkit-scrollbar-track {
            background: #f7fafc;
        }

        *::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 3px;
        }

        *::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        body {
            font-family: 'Inter', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
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

        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
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

        .form-input {
            transition: all 0.3s ease;
            position: relative;
        }

        .form-input:focus {
            transform: scale(1.02);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background: var(--primary-gradient);
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .avatar-upload {
            position: relative;
            display: inline-block;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .avatar-upload:hover {
            transform: scale(1.1);
        }

        .avatar-upload input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--primary-gradient);
            transition: width 0.3s ease;
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
        
        .dark-theme .border-gray-200 {
            border-color: #4b5563 !important;
        }
        
        .dark-theme .border-gray-300 {
            border-color: #6b7280 !important;
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

        .dark-theme .sidebar-gradient {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        }

        .dark-theme .glass-effect {
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
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
        
        .dark-theme .text-gray-900 {
            color: #f9fafb !important;
        }
        
        .dark-theme .border-white\/20 {
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        
        .dark-theme .bg-gradient-to-br.from-gray-50 {
            background: linear-gradient(135deg, rgba(45, 45, 45, 0.8) 0%, rgba(26, 26, 46, 0.8) 100%) !important;
        }
        
        .dark-theme .bg-gradient-to-br.from-blue-50 {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.2) 0%, rgba(30, 64, 175, 0.2) 100%) !important;
        }
        
        .dark-theme .bg-gradient-to-br.from-red-50 {
            background: linear-gradient(135deg, rgba(185, 28, 28, 0.2) 0%, rgba(220, 38, 38, 0.2) 100%) !important;
        }
        
        .dark-theme .bg-gradient-to-br.from-green-50 {
            background: linear-gradient(135deg, rgba(21, 128, 61, 0.2) 0%, rgba(22, 163, 74, 0.2) 100%) !important;
        }
        
        .dark-theme .bg-gradient-to-br.from-purple-50 {
            background: linear-gradient(135deg, rgba(147, 51, 234, 0.2) 0%, rgba(168, 85, 247, 0.2) 100%) !important;
        }
        
        .dark-theme .bg-gradient-to-br.from-yellow-50 {
            background: linear-gradient(135deg, rgba(180, 83, 9, 0.2) 0%, rgba(217, 119, 6, 0.2) 100%) !important;
        }
        
        .dark-theme .bg-gradient-to-br.from-indigo-50 {
            background: linear-gradient(135deg, rgba(67, 56, 202, 0.2) 0%, rgba(99, 102, 241, 0.2) 100%) !important;
        }
        
        .dark-theme .bg-gradient-to-br.from-pink-50 {
            background: linear-gradient(135deg, rgba(219, 39, 119, 0.2) 0%, rgba(236, 72, 153, 0.2) 100%) !important;
        }
        
        .dark-theme .border-blue-100 {
            border-color: rgba(59, 130, 246, 0.3) !important;
        }
        
        .dark-theme .border-red-100 {
            border-color: rgba(239, 68, 68, 0.3) !important;
        }
        
        .dark-theme .border-green-100 {
            border-color: rgba(34, 197, 94, 0.3) !important;
        }
        
        .dark-theme .border-purple-100 {
            border-color: rgba(168, 85, 247, 0.3) !important;
        }
        
        .dark-theme .border-indigo-100 {
            border-color: rgba(99, 102, 241, 0.3) !important;
        }
        
        .dark-theme .text-green-800 {
            color: #bbf7d0 !important;
        }
        
        .dark-theme .text-red-600 {
            color: #fca5a5 !important;
        }
        
        .dark-theme .text-yellow-800 {
            color: #fde68a !important;
        }
        
        .dark-theme .text-blue-800 {
            color: #bfdbfe !important;
        }
        
        .dark-theme .text-purple-600 {
            color: #c4b5fd !important;
        }
        
        .dark-theme .text-indigo-600 {
            color: #a5b4fc !important;
        }
        
        .dark-theme .bg-green-100 {
            background: rgba(34, 197, 94, 0.2) !important;
        }
        
        .dark-theme .bg-red-100 {
            background: rgba(239, 68, 68, 0.2) !important;
        }
        
        .dark-theme .bg-yellow-100 {
            background: rgba(245, 158, 11, 0.2) !important;
        }
        
        .dark-theme .bg-blue-100 {
            background: rgba(59, 130, 246, 0.2) !important;
        }
        
        .dark-theme .bg-purple-100 {
            background: rgba(168, 85, 247, 0.2) !important;
        }
        
        .dark-theme .bg-indigo-100 {
            background: rgba(99, 102, 241, 0.2) !important;
        }
        
        .dark-theme .text-green-600 {
            color: #86efac !important;
        }
        
        .dark-theme .text-red-500 {
            color: #f87171 !important;
        }
        
        .dark-theme .text-yellow-500 {
            color: #fbbf24 !important;
        }
        
        .dark-theme .text-blue-500 {
            color: #60a5fa !important;
        }
        
        .dark-theme .text-purple-500 {
            color: #a78bfa !important;
        }
        
        .dark-theme .text-indigo-500 {
            color: #818cf8 !important;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }

        /* Loading States */
        .loading {
            position: relative;
            overflow: hidden;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }
    </style>
</head>
<body class="bg-gray-100" id="main-body">
    <!-- Mobile Menu Button -->
    <button id="mobile-menu-btn" class="fixed top-4 left-4 z-50 lg:hidden bg-white p-2 rounded-lg shadow-lg">
        <i class="fas fa-bars text-gray-600"></i>
    </button>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed lg:relative w-64 h-full sidebar-gradient shadow-2xl z-40 sidebar">
            <!-- Logo -->
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center floating-animation">
                        <i class="fas fa-cube text-white text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-white">LokerHub</h1>
                        <p class="text-xs text-white/70">
                            <span class="lang-id">Manajemen Loker</span>
                            <span class="lang-en">Locker Management</span>
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
                    <a href="#" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        <span class="lang-id">Barang Saya</span>
                        <span class="lang-en">My Packages</span>
                    </a>
                    <a href="#" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-map-marker-alt w-5 h-5 mr-3"></i>
                        <span class="lang-id">Lokasi Loker</span>
                        <span class="lang-en">Locker Locations</span>
                    </a>
                    <a href="{{ route('settings') }}" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-xl">
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
        <div class="flex-1 flex flex-col overflow-hidden main-content lg:ml-0">
            <!-- Top Bar -->
            <header class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-gray-200/50">
                <div class="px-6 py-6">
                    <div class="flex items-center justify-between">
                        <div class="slide-in">
                            <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                                <i class="fas fa-cog mr-3 text-purple-600"></i>
                            <span class="lang-id">Pengaturan</span>
                            <span class="lang-en">Settings</span>
                        </h2>
                            <p class="text-gray-600 mt-1">
                            <span class="lang-id">Kelola profil dan preferensi akun Anda</span>
                            <span class="lang-en">Manage your account profile and preferences</span>
                        </p>
                    </div>
                        <div class="flex items-center space-x-4">
                            <!-- Theme Toggle -->
                            <button id="theme-toggle" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors">
                                <i class="fas fa-moon text-gray-600" id="theme-icon"></i>
                            </button>
                            <!-- Language Toggle -->
                            <button id="language-toggle" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors">
                                <i class="fas fa-globe text-gray-600"></i>
                            </button>
                            <!-- Notifications -->
                            <div class="relative">
                                <button class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-bell text-gray-600"></i>
                                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Settings Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <div class="max-w-6xl mx-auto">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 slide-in">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif


                    <!-- Settings Tabs -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                        <div class="border-b border-gray-200/50">
                            <nav class="flex space-x-8 px-8" aria-label="Tabs">
                                <button onclick="showTab('profile')" id="profile-tab" class="py-6 px-1 border-b-2 border-purple-500 font-medium text-sm text-purple-600 flex items-center transition-all duration-300">
                                    <i class="fas fa-user mr-2"></i>
                                    <span class="lang-id">Profil</span>
                                    <span class="lang-en">Profile</span>
                                </button>
                                <button onclick="showTab('security')" id="security-tab" class="py-6 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 flex items-center transition-all duration-300">
                                    <i class="fas fa-shield-alt mr-2"></i>
                                    <span class="lang-id">Keamanan</span>
                                    <span class="lang-en">Security</span>
                                </button>
                                <button onclick="showTab('notifications')" id="notifications-tab" class="py-6 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 flex items-center transition-all duration-300">
                                    <i class="fas fa-bell mr-2"></i>
                                    <span class="lang-id">Notifikasi</span>
                                    <span class="lang-en">Notifications</span>
                                </button>
                                <button onclick="showTab('preferences')" id="preferences-tab" class="py-6 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 flex items-center transition-all duration-300">
                                    <i class="fas fa-cog mr-2"></i>
                                    <span class="lang-id">Preferensi</span>
                                    <span class="lang-en">Preferences</span>
                                </button>
                            </nav>
                        </div>

                        <!-- Profile Tab -->
                        <div id="profile-content" class="p-8">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                    <span class="lang-id">Informasi Profil</span>
                                    <span class="lang-en">Profile Information</span>
                                </h3>
                                <p class="text-gray-600">
                                    <span class="lang-id">Kelola informasi pribadi dan foto profil Anda</span>
                                    <span class="lang-en">Manage your personal information and profile photo</span>
                                </p>
                            </div>

                            <form method="POST" action="{{ route('settings.profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                                    <!-- Profile Picture Section -->
                                    <div class="lg:col-span-1">
                                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 text-center">
                                            <div class="relative inline-block">
                                                <div class="w-32 h-32 bg-gradient-to-r from-purple-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg overflow-hidden">
                                                    <img id="avatar-preview" src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : '' }}" alt="Avatar" class="w-full h-full rounded-full object-cover {{ Auth::user()->avatar ? '' : 'hidden' }}">
                                                    <span id="avatar-initial" class="text-white text-4xl font-bold {{ Auth::user()->avatar ? 'hidden' : '' }}">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                                </div>
                                                <div class="avatar-upload">
                                                    <input type="file" id="avatar" name="avatar" accept="image/*" onchange="previewAvatar(this)" class="hidden">
                                                    <button type="button" onclick="document.getElementById('avatar').click()" class="absolute -bottom-2 -right-2 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50 transition-colors">
                                                        <i class="fas fa-camera text-gray-600"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <h4 class="font-semibold text-gray-800 mb-2">{{ Auth::user()->name }}</h4>
                                            <p class="text-sm text-gray-600 mb-4">{{ Auth::user()->email }}</p>
                                            <div class="text-xs text-gray-500 mb-2">
                                                <span class="lang-id">JPG, PNG maksimal 5MB</span>
                                                <span class="lang-en">JPG, PNG max 5MB</span>
                                            </div>
                                            <div id="file-info" class="text-xs text-green-600 hidden">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                <span class="lang-id">File dipilih</span>
                                                <span class="lang-en">File selected</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Fields -->
                                    <div class="lg:col-span-2">
                                        <div class="space-y-6">
                                    <!-- Name -->
                                    <div>
                                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-user mr-2"></i>
                                                    <span class="lang-id">Nama Lengkap</span>
                                                    <span class="lang-en">Full Name</span>
                                                </label>
                                                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" 
                                                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                                       placeholder="Masukkan nama lengkap Anda">
                                        @error('name')
                                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-envelope mr-2"></i>
                                                    <span class="lang-id">Email</span>
                                                    <span class="lang-en">Email</span>
                                                </label>
                                                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" 
                                                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                                       placeholder="nama@email.com">
                                        @error('email')
                                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-phone mr-2"></i>
                                                    <span class="lang-id">Nomor Telepon</span>
                                                    <span class="lang-en">Phone Number</span>
                                                </label>
                                                <input type="tel" id="phone" name="phone" value="{{ Auth::user()->phone }}" placeholder="+62 812 3456 7890" 
                                                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                            </div>

                                            <!-- Bio -->
                                            <div>
                                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-info-circle mr-2"></i>
                                                    <span class="lang-id">Bio</span>
                                                    <span class="lang-en">Bio</span>
                                                </label>
                                                <textarea id="bio" name="bio" rows="3" 
                                                          class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                                          placeholder="Ceritakan sedikit tentang diri Anda...">{{ Auth::user()->bio }}</textarea>
                                    </div>

                                    <!-- Address -->
                                    <div>
                                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                                    <span class="lang-id">Alamat</span>
                                                    <span class="lang-en">Address</span>
                                                </label>
                                                <textarea id="address" name="address" rows="3" 
                                                          class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                                          placeholder="Masukkan alamat lengkap Anda">{{ Auth::user()->address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8 flex justify-end space-x-4">
                                    <button type="button" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                                        <span class="lang-id">Batal</span>
                                        <span class="lang-en">Cancel</span>
                                    </button>
                                    <button type="submit" class="btn-gradient text-white px-8 py-3 rounded-xl font-medium">
                                        <i class="fas fa-save mr-2"></i>
                                        <span class="lang-id">Simpan Perubahan</span>
                                        <span class="lang-en">Save Changes</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Security Tab -->
                        <div id="security-content" class="p-8 hidden">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                    <span class="lang-id">Keamanan Akun</span>
                                    <span class="lang-en">Account Security</span>
                                </h3>
                                <p class="text-gray-600">
                                    <span class="lang-id">Kelola keamanan dan privasi akun Anda</span>
                                    <span class="lang-en">Manage your account security and privacy</span>
                                </p>
                            </div>

                            <div class="space-y-8">
                                <!-- Change Password -->
                                <div class="bg-gradient-to-br from-red-50 to-pink-50 rounded-2xl p-8 border border-red-100">
                                    <div class="flex items-center mb-6">
                                        <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-600 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-key text-white text-xl"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-xl font-semibold text-gray-800">
                                                <span class="lang-id">Ubah Password</span>
                                                <span class="lang-en">Change Password</span>
                                            </h4>
                                            <p class="text-sm text-gray-600">
                                                <span class="lang-id">Perbarui password untuk keamanan yang lebih baik</span>
                                                <span class="lang-en">Update your password for better security</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <form method="POST" action="{{ route('settings.password.update') }}">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-lock mr-2"></i>
                                                    <span class="lang-id">Password Saat Ini</span>
                                                    <span class="lang-en">Current Password</span>
                                                </label>
                                                <input type="password" id="current_password" name="current_password" 
                                                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('current_password') border-red-500 @enderror"
                                                       placeholder="Masukkan password saat ini">
                                                @error('current_password')
                                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                                                    <i class="fas fa-key mr-2"></i>
                                                    <span class="lang-id">Password Baru</span>
                                                    <span class="lang-en">New Password</span>
                                                </label>
                                                <input type="password" id="new_password" name="new_password" 
                                                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('new_password') border-red-500 @enderror"
                                                       placeholder="Masukkan password baru">
                                                @error('new_password')
                                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="mt-6">
                                            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                <span class="lang-id">Konfirmasi Password Baru</span>
                                                <span class="lang-en">Confirm New Password</span>
                                            </label>
                                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                                   class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                                   placeholder="Konfirmasi password baru">
                                        </div>

                                        <div class="mt-6">
                                            <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-8 py-3 rounded-xl font-medium hover:from-red-600 hover:to-pink-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                                <i class="fas fa-save mr-2"></i>
                                                <span class="lang-id">Ubah Password</span>
                                                <span class="lang-en">Change Password</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Two Factor Authentication -->
                                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 border border-green-100">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-shield-alt text-white text-xl"></i>
                                        </div>
                                            <div class="ml-4">
                                                <h4 class="text-xl font-semibold text-gray-800">
                                                    <span class="lang-id">Autentikasi Dua Faktor</span>
                                                    <span class="lang-en">Two-Factor Authentication</span>
                                                </h4>
                                                <p class="text-sm text-gray-600">
                                                    <span class="lang-id">Tingkatkan keamanan akun dengan 2FA</span>
                                                    <span class="lang-en">Enhance account security with 2FA</span>
                                                </p>
                                                <div class="mt-2">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                                        <span class="lang-id">Belum diaktifkan</span>
                                                        <span class="lang-en">Not enabled</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3 rounded-xl font-medium hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                            <i class="fas fa-plus mr-2"></i>
                                            <span class="lang-id">Aktifkan</span>
                                            <span class="lang-en">Enable</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Login Sessions -->
                                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 border border-blue-100">
                                    <div class="flex items-center mb-6">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-desktop text-white text-xl"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-xl font-semibold text-gray-800">
                                                <span class="lang-id">Sesi Login Aktif</span>
                                                <span class="lang-en">Active Login Sessions</span>
                                            </h4>
                                            <p class="text-sm text-gray-600">
                                                <span class="lang-id">Kelola perangkat yang terhubung ke akun Anda</span>
                                                <span class="lang-en">Manage devices connected to your account</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:shadow-md transition-shadow">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-desktop text-white"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">Chrome di Windows</p>
                                                    <p class="text-xs text-gray-500">127.0.0.1 • Jakarta, Indonesia</p>
                                                    <p class="text-xs text-gray-400">Saat ini</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-circle mr-1 text-green-500"></i>
                                                    <span class="lang-id">Aktif</span>
                                                    <span class="lang-en">Active</span>
                                            </span>
                                                <button class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                        </div>
                                    </div>
                                        
                                        <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200 hover:shadow-md transition-shadow">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-mobile-alt text-white"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">Safari di iPhone</p>
                                                    <p class="text-xs text-gray-500">192.168.1.100 • Jakarta, Indonesia</p>
                                                    <p class="text-xs text-gray-400">2 jam yang lalu</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-circle mr-1 text-yellow-500"></i>
                                                    <span class="lang-id">Tidak Aktif</span>
                                                    <span class="lang-en">Inactive</span>
                                                </span>
                                                <button class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notifications Tab -->
                        <div id="notifications-content" class="p-8 hidden">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                    <span class="lang-id">Pengaturan Notifikasi</span>
                                    <span class="lang-en">Notification Settings</span>
                                </h3>
                                <p class="text-gray-600">
                                    <span class="lang-id">Kelola bagaimana dan kapan Anda menerima notifikasi</span>
                                    <span class="lang-en">Manage how and when you receive notifications</span>
                                </p>
                            </div>

                            <div class="space-y-8">
                                <!-- Email Notifications -->
                                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 border border-blue-100">
                                    <div class="flex items-center mb-6">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-envelope text-white text-xl"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-xl font-semibold text-gray-800">
                                                <span class="lang-id">Notifikasi Email</span>
                                                <span class="lang-en">Email Notifications</span>
                                            </h4>
                                            <p class="text-sm text-gray-600">
                                                <span class="lang-id">Kelola notifikasi yang dikirim ke email Anda</span>
                                                <span class="lang-en">Manage notifications sent to your email</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                            <div class="space-y-6">
                                        <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-box text-white"></i>
                                            </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        <span class="lang-id">Paket Baru</span>
                                                        <span class="lang-en">New Package</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        <span class="lang-id">Notifikasi saat ada paket baru</span>
                                                        <span class="lang-en">Notification when new package arrives</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle-switch">
                                                <input type="checkbox" checked>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        
                                        <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-truck text-white"></i>
                                            </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        <span class="lang-id">Status Pengiriman</span>
                                                        <span class="lang-en">Delivery Status</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        <span class="lang-id">Update status pengiriman paket</span>
                                                        <span class="lang-en">Package delivery status updates</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle-switch">
                                                <input type="checkbox" checked>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        
                                        <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-bell text-white"></i>
                                            </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        <span class="lang-id">Pengingat</span>
                                                        <span class="lang-en">Reminders</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        <span class="lang-id">Pengingat untuk mengambil paket</span>
                                                        <span class="lang-en">Reminders to pick up packages</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle-switch">
                                                <input type="checkbox">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Push Notifications -->
                                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 border border-purple-100">
                                    <div class="flex items-center mb-6">
                                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-mobile-alt text-white text-xl"></i>
                                            </div>
                                        <div class="ml-4">
                                            <h4 class="text-xl font-semibold text-gray-800">
                                                <span class="lang-id">Notifikasi Push</span>
                                                <span class="lang-en">Push Notifications</span>
                                            </h4>
                                            <p class="text-sm text-gray-600">
                                                <span class="lang-id">Notifikasi real-time di browser dan perangkat</span>
                                                <span class="lang-en">Real-time notifications on browser and devices</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-6">
                                        <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-bolt text-white"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        <span class="lang-id">Notifikasi Real-time</span>
                                                        <span class="lang-en">Real-time Notifications</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        <span class="lang-id">Notifikasi langsung di browser</span>
                                                        <span class="lang-en">Instant notifications in browser</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle-switch">
                                                <input type="checkbox" checked>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        
                                        <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-blue-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-volume-up text-white"></i>
                                    </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        <span class="lang-id">Suara Notifikasi</span>
                                                        <span class="lang-en">Notification Sound</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        <span class="lang-id">Putar suara saat notifikasi masuk</span>
                                                        <span class="lang-en">Play sound when notification arrives</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle-switch">
                                                <input type="checkbox" checked>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preferences Tab -->
                        <div id="preferences-content" class="p-8 hidden">
                            <div class="mb-8">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                                    <span class="lang-id">Preferensi & Privasi</span>
                                    <span class="lang-en">Preferences & Privacy</span>
                                </h3>
                                <p class="text-gray-600">
                                    <span class="lang-id">Sesuaikan pengalaman dan privasi akun Anda</span>
                                    <span class="lang-en">Customize your experience and account privacy</span>
                                </p>
                            </div>

                            <div class="space-y-8">
                                <!-- Appearance Settings -->
                                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 border border-indigo-100">
                                    <div class="flex items-center mb-6">
                                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-palette text-white text-xl"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-xl font-semibold text-gray-800">
                                                <span class="lang-id">Tampilan</span>
                                                <span class="lang-en">Appearance</span>
                                            </h4>
                                            <p class="text-sm text-gray-600">
                                                <span class="lang-id">Sesuaikan tema dan bahasa antarmuka</span>
                                                <span class="lang-en">Customize theme and interface language</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                                <i class="fas fa-moon mr-2"></i>
                                                <span class="lang-id">Tema</span>
                                                <span class="lang-en">Theme</span>
                                            </label>
                                            <select id="theme-selector" class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" onchange="changeTheme(this.value)">
                                                <option value="light">
                                                    <span class="lang-id">Terang</span>
                                                    <span class="lang-en">Light</span>
                                                </option>
                                                <option value="dark">
                                                    <span class="lang-id">Gelap</span>
                                                    <span class="lang-en">Dark</span>
                                                </option>
                                                <option value="system">
                                                    <span class="lang-id">Sistem</span>
                                                    <span class="lang-en">System</span>
                                                </option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                                <i class="fas fa-globe mr-2"></i>
                                                <span class="lang-id">Bahasa</span>
                                                <span class="lang-en">Language</span>
                                            </label>
                                            <select id="language-selector" class="form-input w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" onchange="changeLanguage(this.value)">
                                                <option value="id">🇮🇩 Indonesia</option>
                                                <option value="en">🇺🇸 English</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Privacy Settings -->
                                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 border border-green-100">
                                    <div class="flex items-center mb-6">
                                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-shield-alt text-white text-xl"></i>
                                            </div>
                                        <div class="ml-4">
                                            <h4 class="text-xl font-semibold text-gray-800">
                                                <span class="lang-id">Privasi</span>
                                                <span class="lang-en">Privacy</span>
                                            </h4>
                                            <p class="text-sm text-gray-600">
                                                <span class="lang-id">Kelola pengaturan privasi dan data Anda</span>
                                                <span class="lang-en">Manage your privacy settings and data</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-6">
                                        <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-user-friends text-white"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        <span class="lang-id">Profil Publik</span>
                                                        <span class="lang-en">Public Profile</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        <span class="lang-id">Izinkan pengguna lain melihat profil Anda</span>
                                                        <span class="lang-en">Allow other users to view your profile</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle-switch">
                                                <input type="checkbox">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        
                                        <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-chart-line text-white"></i>
                                            </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        <span class="lang-id">Analitik</span>
                                                        <span class="lang-en">Analytics</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        <span class="lang-id">Bantu kami meningkatkan layanan</span>
                                                        <span class="lang-en">Help us improve our services</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle-switch">
                                                <input type="checkbox" checked>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                        
                                        <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-gray-200">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-cookie-bite text-white"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        <span class="lang-id">Cookie</span>
                                                        <span class="lang-en">Cookies</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        <span class="lang-id">Izinkan penggunaan cookie untuk pengalaman yang lebih baik</span>
                                                        <span class="lang-en">Allow cookies for better experience</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <label class="toggle-switch">
                                                <input type="checkbox" checked>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Data Management -->
                                <div class="bg-gradient-to-br from-red-50 to-pink-50 rounded-2xl p-8 border border-red-100">
                                    <div class="flex items-center mb-6">
                                        <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-600 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-database text-white text-xl"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-xl font-semibold text-gray-800">
                                                <span class="lang-id">Data & Backup</span>
                                                <span class="lang-en">Data & Backup</span>
                                            </h4>
                                            <p class="text-sm text-gray-600">
                                                <span class="lang-id">Kelola data dan backup akun Anda</span>
                                                <span class="lang-en">Manage your account data and backups</span>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-4">
                                        <button class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-4 rounded-xl font-medium hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center">
                                            <i class="fas fa-download mr-3"></i>
                                            <span class="lang-id">Unduh Data Saya</span>
                                            <span class="lang-en">Download My Data</span>
                                        </button>
                                        
                                        <button class="w-full bg-gradient-to-r from-yellow-500 to-orange-600 text-white px-6 py-4 rounded-xl font-medium hover:from-yellow-600 hover:to-orange-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center">
                                            <i class="fas fa-sync mr-3"></i>
                                            <span class="lang-id">Sinkronisasi Data</span>
                                            <span class="lang-en">Sync Data</span>
                                        </button>
                                        
                                        <button class="w-full bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-xl font-medium hover:from-red-600 hover:to-pink-700 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center">
                                            <i class="fas fa-trash mr-3"></i>
                                            <span class="lang-id">Hapus Akun</span>
                                            <span class="lang-en">Delete Account</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Global variables
        let currentTab = 'profile';
        let isLoading = false;

        // Load saved preferences on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadPreferences();
            initializeEventListeners();
            showTab('profile');
        });

        // Initialize event listeners
        function initializeEventListeners() {
            // Mobile menu toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.getElementById('sidebar');
            
            if (mobileMenuBtn && sidebar) {
                mobileMenuBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('open');
                });
            }

            // Theme toggle button
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    const currentTheme = localStorage.getItem('theme') || 'light';
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    changeTheme(newTheme);
                });
            }

            // Language toggle button
            const languageToggle = document.getElementById('language-toggle');
            if (languageToggle) {
                languageToggle.addEventListener('click', function() {
                    const currentLanguage = localStorage.getItem('language') || 'id';
                    const newLanguage = currentLanguage === 'id' ? 'en' : 'id';
                    changeLanguage(newLanguage);
                });
            }

            // Form submissions with loading states
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (isLoading) {
                        e.preventDefault();
                        return;
                    }
                    
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        showLoadingState(submitBtn);
                        
                        // Show success notification after form submission
                        setTimeout(() => {
                            showNotification('Profil berhasil diperbarui!', 'success');
                        }, 2000);
                    }
                });
            });

            // Toggle switches
            const toggleSwitches = document.querySelectorAll('.toggle-switch input');
            toggleSwitches.forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const parent = this.closest('.flex');
                    if (parent) {
                        parent.classList.add('transition-all', 'duration-300');
                        if (this.checked) {
                            parent.style.transform = 'scale(1.02)';
                        } else {
                            parent.style.transform = 'scale(1)';
                        }
                        setTimeout(() => {
                            parent.style.transform = 'scale(1)';
                        }, 300);
                    }
                });
            });
        }

        function showTab(tabName) {
            if (isLoading) return;
            
            currentTab = tabName;
            
            // Hide all content with animation
            document.querySelectorAll('[id$="-content"]').forEach(content => {
                if (!content.classList.contains('hidden')) {
                    content.style.opacity = '0';
                    content.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                content.classList.add('hidden');
                    }, 200);
                }
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('[id$="-tab"]').forEach(tab => {
                tab.classList.remove('border-purple-500', 'text-purple-600', 'active');
                tab.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Show selected content with animation
            setTimeout(() => {
                const selectedContent = document.getElementById(tabName + '-content');
                if (selectedContent) {
                    selectedContent.classList.remove('hidden');
                    selectedContent.style.opacity = '0';
                    selectedContent.style.transform = 'translateY(20px)';
                    
                    // Trigger reflow
                    selectedContent.offsetHeight;
                    
                    selectedContent.style.transition = 'all 0.3s ease-out';
                    selectedContent.style.opacity = '1';
                    selectedContent.style.transform = 'translateY(0)';
                }
            }, 200);
            
            // Add active class to selected tab
            const activeTab = document.getElementById(tabName + '-tab');
            if (activeTab) {
            activeTab.classList.remove('border-transparent', 'text-gray-500');
                activeTab.classList.add('border-purple-500', 'text-purple-600', 'active');
            }

            // Update page title
            updatePageTitle(tabName);
        }

        function updatePageTitle(tabName) {
            const titles = {
                'profile': {
                    'id': 'Profil - Pengaturan',
                    'en': 'Profile - Settings'
                },
                'security': {
                    'id': 'Keamanan - Pengaturan',
                    'en': 'Security - Settings'
                },
                'notifications': {
                    'id': 'Notifikasi - Pengaturan',
                    'en': 'Notifications - Settings'
                },
                'preferences': {
                    'id': 'Preferensi - Pengaturan',
                    'en': 'Preferences - Settings'
                }
            };

            const currentLanguage = localStorage.getItem('language') || 'id';
            const title = titles[tabName] ? titles[tabName][currentLanguage] : 'Pengaturan';
            document.title = title + ' - ' + '{{ config("app.name", "Loker") }}';
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
            
            // Update selector
            const themeSelector = document.getElementById('theme-selector');
            if (themeSelector) {
                themeSelector.value = theme;
            }

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
            
            // Update selector
            const languageSelector = document.getElementById('language-selector');
            if (languageSelector) {
                languageSelector.value = language;
            }

            // Update page title
            updatePageTitle(currentTab);

            // Show notification
            const message = language === 'en' ? 'Language changed to English!' : 'Bahasa diubah ke Indonesia!';
            showNotification(message, 'success');
        }

        function loadPreferences() {
            // Load theme preference
            const savedTheme = localStorage.getItem('theme') || 'light';
            changeTheme(savedTheme);
            
            // Load language preference
            const savedLanguage = localStorage.getItem('language') || 'id';
            changeLanguage(savedLanguage);
        }

        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const fileInfo = document.getElementById('file-info');
                
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    showNotification('Pilih file gambar yang valid!', 'error');
                    input.value = '';
                    return;
                }
                
                // Validate file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    showNotification('Ukuran file maksimal 5MB!', 'error');
                    input.value = '';
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const avatarPreview = document.getElementById('avatar-preview');
                    const avatarInitial = document.getElementById('avatar-initial');
                    
                    if (avatarPreview && avatarInitial) {
                        avatarPreview.src = e.target.result;
                        avatarPreview.classList.remove('hidden');
                        avatarInitial.classList.add('hidden');
                        
                        // Show file info
                        if (fileInfo) {
                            fileInfo.classList.remove('hidden');
                        }
                        
                        showNotification('Foto profil berhasil dipilih!', 'success');
                    }
                };
                
                reader.readAsDataURL(file);
            }
        }

        function showLoadingState(button) {
            if (isLoading) return;
            
            isLoading = true;
            const originalText = button.innerHTML;
            const originalDisabled = button.disabled;
            
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span class="lang-id">Menyimpan...</span><span class="lang-en">Saving...</span>';
            button.classList.add('loading');
            
            // Reset after form submission (actual form will handle the redirect)
            setTimeout(() => {
                if (isLoading) {
                    button.innerHTML = originalText;
                    button.disabled = originalDisabled;
                    button.classList.remove('loading');
                    isLoading = false;
                }
            }, 3000);
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
                    changeTheme('system');
                }
            });
        }

        // Add smooth scrolling for better UX
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + 1-4 for tab switching
            if ((e.ctrlKey || e.metaKey) && e.key >= '1' && e.key <= '4') {
                e.preventDefault();
                const tabs = ['profile', 'security', 'notifications', 'preferences'];
                const tabIndex = parseInt(e.key) - 1;
                if (tabs[tabIndex]) {
                    showTab(tabs[tabIndex]);
                }
            }
            
            // Escape to close mobile menu
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('sidebar');
                if (sidebar && sidebar.classList.contains('open')) {
                    sidebar.classList.remove('open');
                }
            }
        });

        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, observerOptions);

        // Observe all cards for animation
        document.querySelectorAll('.card-hover').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>
