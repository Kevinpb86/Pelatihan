<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barang Saya - {{ config('app.name', 'Loker') }}</title>

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

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .item-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .item-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .item-card:hover::before {
            left: 100%;
        }

        .item-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        .status-empty {
            background: rgba(99, 102, 241, 0.1);
            color: #6366f1;
        }

        .status-expiring {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
        }

        .filter-tab {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .filter-tab.active {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .filter-tab:hover {
            background: rgba(102, 126, 234, 0.1);
        }

        .filter-tab.active:hover {
            background: var(--primary-gradient);
        }

        /* Modal Styles */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 23, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(4px);
            animation: overlayFade 0.2s ease forwards;
        }

        @keyframes overlayFade {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal {
            width: 500px;
            max-width: calc(100% - 40px);
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: translateY(20px) scale(0.95);
            opacity: 0;
            animation: modalIn 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes modalIn {
            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
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

        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-state-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #667eea;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding-left: 44px;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .icon-action {
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease;
        }
        .icon-action:hover {
            transform: translateY(-2px) scale(1.06);
            box-shadow: 0 10px 18px rgba(79,70,229,.25);
            opacity: .95;
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
                    <a href="{{ route('items.index') }}" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-xl">
                        <i class="fas fa-box w-5 h-5 mr-3"></i>
                        Barang Saya
                    </a>
                    <a href="{{ route('store-item') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-plus-circle w-5 h-5 mr-3"></i>
                        Titip Barang
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
                                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-box text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-3xl font-bold text-gray-800">Barang Saya</h2>
                                    <p class="text-gray-600 mt-1">Kelola barang yang Anda titipkan — lihat status, perpanjang atau buka detail.</p>
                                </div>
                            </div>
                        </div>
                        <button onclick="showPopupAndNavigate(event, '{{ route('store-item') }}', 'Mengarahkan ke Titip Barang...')" class="btn-animate px-6 py-3 bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-plus mr-2"></i>
                            Titip Barang Baru
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <div class="max-w-7xl mx-auto">
                    <!-- Stats & Filters -->
                    <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Total Barang</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ isset($items) ? count($items) : 0 }}</p>
                                </div>
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-box text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Aktif</p>
                                    <p class="text-2xl font-bold text-green-600">{{ isset($items) ? count($items) : 0 }}</p>
                                </div>
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-check-circle text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Akan Berakhir</p>
                                    <p class="text-2xl font-bold text-yellow-600">0</p>
                                </div>
                                <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Kosong</p>
                                    <p class="text-2xl font-bold text-purple-600">12</p>
                                </div>
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-unlock text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Search & Filter -->
                    <div class="mb-6 bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20">
                        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                            <div class="search-box flex-1 w-full md:w-auto">
                                <i class="fas fa-search"></i>
                                <input 
                                    id="item-search" 
                                    type="text" 
                                    placeholder="Cari nama barang atau loker..." 
                                    class="w-full md:w-96 px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all"
                                >
                            </div>
                            <div class="flex gap-2">
                                <button onclick="filterItems('all')" class="filter-tab active" data-filter="all">Semua</button>
                                <button onclick="filterItems('active')" class="filter-tab" data-filter="active">Aktif</button>
                                <button onclick="filterItems('expiring')" class="filter-tab" data-filter="expiring">Akan Berakhir</button>
                                <button onclick="filterItems('empty')" class="filter-tab" data-filter="empty">Kosong</button>
                            </div>
                        </div>
                    </div>

                    <!-- Items Grid -->
                    @if(isset($items) && count($items) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="items-grid">
                            @foreach($items as $item)
                            <div class="item-card bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20" data-name="{{ strtolower($item['name']) }}" data-status="{{ strtolower($item['status']) }}">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 {{ $item['status'] === 'Kosong' ? 'bg-gradient-to-r from-green-500 to-emerald-600' : 'bg-gradient-to-r from-blue-500 to-indigo-600' }} rounded-xl flex items-center justify-center shadow-lg">
                                            <i class="{{ $item['icon'] ?? 'fas fa-box' }} text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-lg text-gray-900">{{ $item['name'] }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">
                                                <i class="fas fa-map-marker-alt mr-1"></i>
                                                Loker <strong>{{ $item['locker'] }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <span class="status-badge {{ $item['status'] === 'Kosong' ? 'status-empty' : 'status-active' }}">
                                        <i class="fas fa-circle text-xs"></i>
                                        {{ $item['status'] }}
                                    </span>
                                    <span class="status-badge status-expiring ml-2">
                                        <i class="fas fa-clock text-xs"></i>
                                        Durasi: 3 hari
                                    </span>
                                </div>

                                <div class="mb-4 pt-4 border-t border-gray-200">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-clock mr-2"></i>
                                        <span>Terakhir: {{ $item['updated'] }}</span>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('items.show', $item['id'] ?? 0) }}" class="btn-animate flex-1 px-4 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg font-medium hover:shadow-lg transition-all duration-300 text-center">
                                        <i class="fas fa-hand-paper mr-2"></i>
                                        Ambil Barang
                                    </a>
                                    <a href="{{ route('items.show', $item['id'] ?? 0) }}" class="btn-animate icon-action px-4 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-medium hover:shadow-lg transition-all duration-300 text-center" title="Lihat Detail" aria-label="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                        <div class="empty-state bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-white/20">
                            <div class="empty-state-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum ada barang</h3>
                            <p class="text-gray-600 max-w-md mx-auto mb-6">
                                Anda belum menambahkan barang. Klik "Titip Barang Baru" untuk mulai menitipkan barang pertama Anda.
                            </p>
                            <button onclick="showPopupAndNavigate(event, '{{ route('store-item') }}', 'Mengarahkan ke Titip Barang...')" class="btn-animate inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-plus mr-2"></i>
                                Titip Barang Baru
                            </button>
                    </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <!-- Detail Modal Template -->
    <template id="detail-template">
        <div class="overlay" onclick="closeModalByOverlay(event)">
            <div class="modal" onclick="event.stopPropagation()">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <div id="modal-thumb" class="w-16 h-16 rounded-xl flex items-center justify-center shadow-lg"></div>
                        <div>
                            <h3 id="modal-title" class="font-bold text-xl text-gray-900"></h3>
                            <p id="modal-sub" class="text-sm text-gray-600 mt-1"></p>
                        </div>
                    </div>
                    <button onclick="closeModal(this)" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600 hover:text-gray-900 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Lokasi Loker</p>
                        <p id="modal-locker" class="font-semibold text-gray-900 text-lg"></p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Status</p>
                        <p id="modal-status" class="font-semibold text-gray-900 text-lg"></p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a id="modal-take-link" href="#" class="btn-animate flex-1 px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-medium hover:shadow-lg transition-all duration-300 text-center">
                        <i class="fas fa-hand-paper mr-2"></i>
                        Ambil Barang
                    </a>
                    <button onclick="showPopupAndNavigate(event, '#', 'Memperpanjang masa titip...')" class="btn-animate flex-1 px-4 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl font-medium hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-calendar-plus mr-2"></i>
                        Perpanjang
                    </button>
                </div>
            </div>
        </div>
    </template>

    <script>
        // Search functionality
        document.getElementById('item-search').addEventListener('input', function() {
            const q = this.value.trim().toLowerCase();
            document.querySelectorAll('#items-grid .item-card').forEach(el => {
                const name = el.getAttribute('data-name') || '';
                el.style.display = q && name.indexOf(q) === -1 ? 'none' : 'block';
            });
        });

        // Filter functionality
        function filterItems(filter) {
            // Update active tab
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filter items
            document.querySelectorAll('#items-grid .item-card').forEach(card => {
                const status = card.getAttribute('data-status') || '';
                if (filter === 'all') {
                    card.style.display = 'block';
                } else if (filter === 'active' && status !== 'kosong') {
                    card.style.display = 'block';
                } else if (filter === 'empty' && status === 'kosong') {
                    card.style.display = 'block';
                } else if (filter === 'expiring') {
                    card.style.display = 'none'; // TODO: implement expiring logic
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Popup helper
        function createPopup(message = 'Memproses...') {
            const overlay = document.createElement('div');
            overlay.className = 'overlay';
            const card = document.createElement('div');
            card.className = 'bg-white rounded-2xl p-6 shadow-2xl';
            card.innerHTML = `
                <div class="flex flex-col items-center gap-4">
                    <div class="w-16 h-16 border-4 border-purple-200 border-t-purple-600 rounded-full animate-spin"></div>
                    <p class="font-semibold text-gray-900">${message}</p>
                </div>
            `;
            overlay.appendChild(card);
            document.body.appendChild(overlay);
            return {
                close(delay = 0) {
                    setTimeout(() => {
                        if (overlay.parentNode) overlay.parentNode.removeChild(overlay);
                    }, delay);
                }
            };
        }

        function showPopupAndNavigate(e, url, message) {
            if (e && e.preventDefault) e.preventDefault();
            const btn = e?.currentTarget;
            if (btn) addRipple(btn, e);
            const popup = createPopup(message || 'Memproses...');
            setTimeout(() => {
                if (url && url !== '#') {
                    popup.close(0);
                    setTimeout(() => window.location.href = url, 180);
                } else {
                    popup.close(700);
                }
            }, 700);
        }

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

        // Detail modal
        function openDetailModal(item) {
            const tpl = document.getElementById('detail-template');
            const clone = tpl.content.cloneNode(true);
            
            clone.querySelector('#modal-title').textContent = item.name;
            clone.querySelector('#modal-sub').textContent = 'Terakhir: ' + item.updated;
            clone.querySelector('#modal-locker').textContent = item.locker;
            clone.querySelector('#modal-status').textContent = item.status;
            
            const thumb = clone.querySelector('#modal-thumb');
            thumb.style.background = item.status === 'Kosong' 
                ? 'linear-gradient(135deg, #10b981 0%, #059669 100%)'
                : 'linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%)';
            thumb.innerHTML = `<i class="${item.icon || 'fas fa-box'} text-white text-xl"></i>`;
            
            // Update take link
            const takeLink = clone.querySelector('#modal-take-link');
            if (takeLink && item.id) {
                takeLink.href = '/take-item/' + item.id;
            }
            
            document.body.appendChild(clone);
        }

        function closeModal(btn) {
            const overlay = btn.closest('.overlay');
            if (overlay) overlay.remove();
        }

        function closeModalByOverlay(e) {
            if (e.target.classList.contains('overlay')) {
                e.target.remove();
            }
        }

        // Keyboard accessibility
        document.addEventListener('keydown', function(e) {
            if ((e.key === 'Enter' || e.code === 'Space') && 
                document.activeElement?.classList.contains('btn-animate')) {
                addRipple(document.activeElement, e);
            }
            if (e.key === 'Escape') {
                document.querySelectorAll('.overlay').forEach(overlay => overlay.remove());
            }
        });
    </script>
</body>
</html>