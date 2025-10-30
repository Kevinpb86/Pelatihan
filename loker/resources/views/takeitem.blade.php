<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ambil Barang - {{ config('app.name', 'Loker') }}</title>

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

        .info-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .btn-animate {
            position: relative;
            overflow: hidden;
            -webkit-tap-highlight-color: transparent;
        }

        .btn-animate:active {
            transform: translateY(1px) scale(0.98);
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            transform: scale(0);
            background: rgba(255, 255, 255, 0.4);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite alternate;
        }

        @keyframes pulseGlow {
            from { box-shadow: 0 0 20px rgba(16, 185, 129, 0.3); }
            to { box-shadow: 0 0 30px rgba(16, 185, 129, 0.6); }
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
                        <i class="fas fa-lock text-white text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-white">LokerHub</h1>
                        <p class="text-xs text-white/70">Sistem Penitipan Barang</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 px-4">
                <div class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-home w-5 h-5 mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('items.index') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        Barang Saya
                    </a>
                    <a href="{{ route('store-item') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-plus-circle w-5 h-5 mr-3"></i>
                        Titip Barang
                    </a>
                        <a href="#" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-map-marker-alt w-5 h-5 mr-3"></i>
                        Lokasi Loker
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
                                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center pulse-glow">
                                    <i class="fas fa-hand-paper text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-3xl font-bold text-gray-800">Ambil Barang</h2>
                                    <p class="text-gray-600 mt-1">Konfirmasi dan ambil barang Anda dari loker</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <div class="max-w-4xl mx-auto">
                    <!-- Success Message -->
                    @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg bounce-in">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                            <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Error Message -->
                    @if(session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg bounce-in">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                            <p class="text-red-800 font-semibold">{{ session('error') }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Item Detail Card -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8 mb-6 info-card bounce-in">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-box text-white text-3xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $booking->unit->name ?? 'Barang' }}</h3>
                                    <p class="text-gray-600 mt-1">Loker {{ $booking->unit->code ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="px-4 py-2 bg-green-100 rounded-xl">
                                <span class="text-green-800 font-semibold">Aktif</span>
                            </div>
                        </div>

                        <!-- Item Information Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="bg-gray-50 rounded-xl p-5">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Lokasi Loker</p>
                                        <p class="text-lg font-bold text-gray-900">{{ $booking->unit->code ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500">{{ $booking->unit->location ?? 'Lokasi tidak tersedia' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-5">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-alt text-purple-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Waktu Titip</p>
                                        <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y, H:i') }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($booking->start_time)->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-5">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-yellow-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Batas Waktu</p>
                                        <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->end_time)->format('d M Y, H:i') }}</p>
                                        <p class="text-xs text-gray-500">
                                            @if(\Carbon\Carbon::parse($booking->end_time)->isFuture())
                                                Berakhir {{ \Carbon\Carbon::parse($booking->end_time)->diffForHumans() }}
                                            @else
                                                Sudah berakhir {{ \Carbon\Carbon::parse($booking->end_time)->diffForHumans() }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-5">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-dollar-sign text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Total Biaya</p>
                                        <p class="text-lg font-bold text-gray-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                        <p class="text-xs text-gray-500">Sudah dibayar</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-red-50 border-l-4 border-red-500 rounded-xl p-5 mb-6">
                            <div class="flex items-start">
                                <i class="fas fa-money-bill-wave text-red-600 text-2xl mr-3 mt-1"></i>
                                <div>
                                    <p class="text-red-800 font-semibold text-lg">Status Loker: {{ ucfirst($booking->status) }}</p>
                                    <p class="text-gray-700 text-sm mt-1">Loker: <span class="font-semibold">{{ $booking->unit->code }}</span></p>

                                    @if ($booking->fine)
                                        <div class="bg-red-50 border-l-4 border-red-500 rounded-xl p-5 mb-6">
                                            <div class="flex items-start">
                                                <i class="fas fa-money-bill-wave text-red-600 text-2xl mr-3 mt-1"></i>
                                                <div>
                                                    <div class="mt-2">
                                                        <p class="text-red-700 font-semibold">
                                                            Denda: Rp {{ number_format($booking->fine->amount, 0, ',', '.') }}
                                                        </p>
                                                        @if (!$booking->fine->paid)
                                                            <span class="inline-block mt-1 bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">
                                                                Belum Dibayar
                                                            </span>
                                                        @else
                                                            <span class="inline-block mt-1 bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">
                                                                Sudah Dibayar
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-green-700 mt-2 font-medium">
                                            Tidak ada denda 🎉
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <!-- Warning Info -->
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg mb-6">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-yellow-600 text-xl mr-3 mt-1"></i>
                                <div>
                                    <p class="text-yellow-800 font-semibold mb-1">Perhatian</p>
                                    <p class="text-yellow-700 text-sm">
                                        Pastikan Anda sudah mengambil semua barang dari loker sebelum mengkonfirmasi pengambilan. 
                                        Setelah dikonfirmasi, loker akan kembali tersedia untuk pengguna lain.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4">
                            <a href="{{ route('items.index') }}" 
                            class="btn-animate flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-xl font-semibold text-center transition-all duration-300">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali
                            </a>

                            @if ($booking->fine && !$booking->fine->paid)
                                <form method="POST" action="{{ route('items.payFine', $booking->id) }}" class="flex-1">
                                    @csrf
                                    <button type="submit" 
                                        class="btn-animate w-full px-6 py-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-money-bill-wave mr-2"></i>
                                        Bayar Denda
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('items.retrieve', $booking->id) }}" id="retrieveForm" class="flex-1">
                                    @csrf
                                    <button type="submit" onclick="confirmRetrieve(event)" 
                                        class="btn-animate w-full px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-hand-paper mr-2"></i>
                                        Konfirmasi Ambil Barang
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Ripple effect
        function addRipple(el, e) {
            const rect = el.getBoundingClientRect();
            const r = document.createElement('span');
            r.className = 'ripple';
            const size = Math.max(rect.width, rect.height) * 1.2;
            r.style.width = r.style.height = size + 'px';
            const x = (e?.clientX ?? rect.left + rect.width / 2) - rect.left - size / 2;
            const y = (e?.clientY ?? rect.top + rect.height / 2) - rect.top - size / 2;
            r.style.left = x + 'px';
            r.style.top = y + 'px';
            el.appendChild(r);
            setTimeout(() => r.remove(), 700);
        }

        // Confirm retrieve
        function confirmRetrieve(e) {
            if (confirm('Apakah Anda yakin ingin mengambil barang dari loker ini?')) {
                const btn = e.currentTarget;
                if (btn) addRipple(btn, e);
                return true;
            }
            e.preventDefault();
            return false;
        }

        // Add ripple to buttons on click
        document.querySelectorAll('.btn-animate').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!this.classList.contains('disabled')) {
                    addRipple(this, e);
                }
            });
        });
    </script>
</body>
</html>

