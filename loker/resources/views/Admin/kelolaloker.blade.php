<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Loker - {{ config('app.name', 'Loker') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .sidebar-gradient { 
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%); 
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
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

        .btn-primary { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            color:#fff; 
            padding:12px 20px; 
            border-radius:12px; 
            font-weight:600; 
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            cursor: pointer;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .badge { 
            padding: 6px 12px; 
            border-radius: 999px; 
            font-size: 11px; 
            font-weight: 600; 
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-available { 
            background: rgba(16,185,129,.15); 
            color:#059669; 
            border: 1px solid rgba(16,185,129,.3);
        }
        
        .badge-booked { 
            background: rgba(59,130,246,.15); 
            color:#2563eb; 
            border: 1px solid rgba(59,130,246,.3);
        }
        
        .badge-overdue { 
            background: rgba(245,158,11,.15); 
            color:#d97706; 
            border: 1px solid rgba(245,158,11,.3);
        }
        
        .card { 
            background: rgba(255,255,255,0.9); 
            backdrop-filter: blur(10px); 
            border:1px solid rgba(255,255,255,.5);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .table thead th { 
            font-size:11px; 
            text-transform:uppercase; 
            letter-spacing:.05em; 
            color:#6b7280; 
            font-weight: 600;
            padding: 12px 16px;
            background: #f9fafb;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: #f9fafb;
        }

        .table tbody td {
            padding: 16px;
            vertical-align: middle;
        }

        /* Button Styles */
        .btn-save {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
            cursor: pointer;
        }

        .btn-maintenance {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-maintenance:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
            cursor: pointer;
        }

        .btn-available {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-available:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
            cursor: pointer;
        }

        /* Form Input Styles */
        input[type="text"],
        input[type="number"] {
            padding: 10px 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Action Buttons Container */
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        /* Success Message */
        .alert-success {
            padding: 12px 16px;
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border-radius: 10px;
            border-left: 4px solid #10b981;
            margin-bottom: 20px;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Table responsive */
        @media (max-width: 1024px) {
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
    @csrf
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="w-64 sidebar-gradient shadow-2xl">
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

            <nav class="mt-6 px-4">
                <div class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-home w-5 h-5 mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.kelolaloker.index') }}" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-xl">
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

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-gray-200/50">
                <div class="px-6 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-cube text-white text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold" style="background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Kelola Loker</h2>
                                <p class="text-gray-600 mt-1">Tambah, edit, dan ubah status loker</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 card rounded-2xl shadow-xl p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-800 flex items-center"><i class="fas fa-list-ul mr-3 text-purple-600"></i> Daftar Loker</h3>
                        </div>
                        @if(session('success'))
                            <div class="alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="mb-4 p-3 rounded-lg border-l-4 border-red-500 bg-red-50 text-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="overflow-x-auto">
                            <table class="min-w-full table">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left">Kode</th>
                                        <th class="px-3 py-2 text-left">Nama</th>
                                        <th class="px-3 py-2 text-left">Harga/Jam</th>
                                        <th class="px-3 py-2 text-left">Status</th>
                                        <th class="px-3 py-2 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-gray-700">
                                @forelse($units as $unit)
                                    <tr class="border-t">
                                        <td class="px-3 py-2 font-semibold">{{ $unit->code }}</td>
                                        <td class="px-3 py-2">
                                            <form action="{{ route('admin.kelolaloker.update', $unit) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                @method('PUT')
                                                <input name="name" value="{{ $unit->name }}" class="px-2 py-1 border rounded-md w-44" />
                                                <input name="price_per_hour" type="number" min="0" value="{{ $unit->price_per_hour }}" class="px-2 py-1 border rounded-md w-28" placeholder="Harga" />
                                                <button type="submit" class="btn-save"><i class="fas fa-save mr-1"></i> Simpan</button>
                                            </form>
                                        </td>
                                        <td class="px-3 py-2">
                                            <span class="badge badge-{{ $unit->status }}">{{ ucfirst($unit->status) }}</span>
                                        </td>
                                        <td class="px-3 py-2">
                                            <div class="action-buttons">
                                                <form action="{{ route('admin.kelolaloker.status', $unit) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="overdue">
                                                    <button type="submit" class="btn-maintenance">
                                                        <i class="fas fa-tools"></i>
                                                        <span>Maintenance</span>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.kelolaloker.status', $unit) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="available">
                                                    <button type="submit" class="btn-available">
                                                        <i class="fas fa-check-circle"></i>
                                                        <span>Available</span>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.kelolaloker.destroy', $unit) }}" method="POST" onsubmit="return confirm('Hapus loker ini? Tindakan ini tidak bisa dibatalkan.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs font-semibold transition-all">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        <span>Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-3 py-6 text-center text-gray-500">Belum ada loker</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center"><i class="fas fa-plus mr-3 text-purple-600"></i> Tambah Loker</h3>
                        <form action="{{ route('admin.kelolaloker.store') }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <label class="text-sm text-gray-700">Kode</label>
                                <input name="code" class="w-full px-3 py-2 border rounded-lg" placeholder="Mis. A01" required />
                            </div>
                            <div>
                                <label class="text-sm text-gray-700">Nama</label>
                                <input name="name" class="w-full px-3 py-2 border rounded-lg" placeholder="Nama loker" required />
                            </div>
                            <div>
                                <label class="text-sm text-gray-700">Harga per Jam</label>
                                <input type="number" min="0" name="price_per_hour" class="w-full px-3 py-2 border rounded-lg" placeholder="Contoh 5000" />
                            </div>
                            <button class="w-full btn-primary flex items-center justify-center"><i class="fas fa-save mr-2"></i> Simpan</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>


