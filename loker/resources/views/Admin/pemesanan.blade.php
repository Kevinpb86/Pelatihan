<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemesanan - {{ config('app.name', 'Loker') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); }
        .sidebar-gradient { background: linear-gradient(180deg, #667eea 0%, #764ba2 100%); }
        .nav-item { position: relative; transition: all 0.3s ease; }
        .nav-item::after { content: ''; position: absolute; left: 0; top: 0; height: 100%; width: 3px; background: var(--primary-gradient); transform: scaleY(0); transition: transform 0.3s ease; }
        .nav-item.active::after { transform: scaleY(1); }
        .nav-item:hover { background: rgba(255, 255, 255, 0.12); transform: translateX(5px); }
        .card { background: rgba(255,255,255,0.97); backdrop-filter: blur(14px); border:1px solid rgba(36,36,66,.07); box-shadow: 0 12px 32px rgba(76,70,120,0.09); border-radius: 20px; }
        .table thead th { font-size:12px; text-transform:uppercase; letter-spacing:.07em; color:#7c3aed; font-weight:700; padding:14px 18px; background:#f4f1fd; border-top-left-radius:6px; border-top-right-radius:6px; }
        .table tbody tr { transition: box-shadow 0.2s,background 0.2s; border-radius:12px; overflow:hidden; }
        .table tbody tr:hover { background:#f7f3fa; box-shadow:0 6px 18px #a89cd93b; }
        .table tbody td { padding:16px 18px; vertical-align: middle; background:transparent; }
        .badge { padding:7px 12px; border-radius:999px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.05em; box-shadow:0 2px 8px rgba(124,58,237,0.09); }
        .badge-status-active { background: rgba(59,130,246,.16); color:#2563eb; border:1.8px solid rgba(59,130,246,.30); font-weight:700; }
        .badge-status-completed { background: rgba(16,185,129,.17); color:#047857; border:1.8px solid rgba(16,185,129,.25); font-weight:700; }
        .badge-status-overdue { background: rgba(245,158,11,.17); color:#b45309; border:1.8px solid rgba(245,158,11,.25); font-weight:700; }
        .badge-status-cancelled { background: rgba(239,68,68,.17); color:#b91c1c; border:1.8px solid rgba(239,68,68,.25); font-weight:700; }
        .btn-primary { background: linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:#fff; padding:10px 20px; border-radius:10px; font-weight:650; border:none; cursor:pointer; box-shadow:0 4px 14px #7c3aed0f; }
        .toolbar { display:flex; gap:14px; flex-wrap:wrap; align-items:center; }
        .toolbar input, .toolbar select { min-width:110px; }
        input[type="text"], select { padding:11px 13px; border:2px solid #e0e7ef; border-radius:10px; transition: all 0.3s ease; font-size:15px; background:#f8fafc; }
        input[type="text"]:focus, select:focus { outline:none; border-color:#7c3aed; box-shadow:0 0 0 2px #a78bfa33; background:#fff; }
        .action-icon { background:linear-gradient(135deg,#a78bfa 0%,#818cf8 100%); color:#fff; border-radius:8px; width:35px; height:35px; display:inline-flex; align-items:center; justify-content:center; font-size:1.15rem; box-shadow:0 2px 6px #4f46e550; transition:.2s; }
        .action-icon:hover { box-shadow:0 8px 18px #7c3aed33; background:linear-gradient(135deg,#7c3aed 0%,#6366f1 100%); color:#fff; transform:scale(1.14); }
        .status-cell{ min-width:130px; }
        @media (max-width:900px){ .toolbar input, .toolbar select { width:100%; min-width:0; } .toolbar {flex-direction:column; align-items:stretch;} .table thead {display:none;} .table tbody tr{ box-shadow:none;} }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="w-64 sidebar-gradient shadow-2xl">
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
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
                    <a href="{{ route('admin.kelolaloker.index') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-cube w-5 h-5 mr-3"></i>
                        Kelola Loker
                    </a>
                    <a href="{{ route('admin.bookings.index') }}" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-xl">
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
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : '' }}" alt="Avatar" class="w-full h-full rounded-full object-cover {{ Auth::user()->avatar ? '' : 'hidden' }}">
                        <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center {{ Auth::user()->avatar ? 'hidden' : '' }}">
                            <span class="text-white text-lg font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-white/70">{{ Auth::user()->email }}</p>
                        <span class="badge" style="background:rgba(16,185,129,.12);color:#047857;border:1px solid rgba(16,185,129,.25)">Admin</span>
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
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-book text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold" style="background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Pemesanan</h2>
                            <p class="text-gray-600 mt-1">Daftar transaksi pemesanan dari pengguna</p>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <div class="max-w-7xl mx-auto card p-6">
                    <form method="GET" action="{{ route('admin.bookings.index') }}" class="toolbar mb-4">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-search text-gray-400"></i>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari user/email/kode loker..." class="w-72" />
                        </div>
                        <div class="w-40">
                            <select name="status">
                                <option value="">Semua Status</option>
                                <option value="active" {{ request('status')==='active' ? 'selected' : '' }}>Active</option>
                                <option value="completed" {{ request('status')==='completed' ? 'selected' : '' }}>Completed</option>
                                <option value="overdue" {{ request('status')==='overdue' ? 'selected' : '' }}>Overdue</option>
                                <option value="cancelled" {{ request('status')==='cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="w-32">
                            @php($pp = (int) (request('per_page') ?: 10))
                            <select name="per_page">
                                <option value="10" {{ $pp===10 ? 'selected' : '' }}>10 / halaman</option>
                                <option value="25" {{ $pp===25 ? 'selected' : '' }}>25 / halaman</option>
                                <option value="50" {{ $pp===50 ? 'selected' : '' }}>50 / halaman</option>
                            </select>
                        </div>
                        <button class="btn-primary"><i class="fas fa-filter mr-2"></i> Terapkan</button>
                        @if(request()->hasAny(['q','status','per_page']))
                            <a href="{{ route('admin.bookings.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Reset</a>
                        @endif
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table">
                            <thead>
                                <tr>
                                    <th class="px-3 py-2 text-left">User</th>
                                    <th class="px-3 py-2 text-left">Loker</th>
                                    <th class="px-3 py-2 text-left">Mulai</th>
                                    <th class="px-3 py-2 text-left">Selesai</th>
                                    <th class="px-3 py-2 text-left">Total</th>
                                    <th class="px-3 py-2 text-left">Status</th>
                                    <th class="px-3 py-2 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700">
                            @forelse($bookings as $booking)
                                <tr class="border-t">
                                    <td class="px-3 py-2">
                                        <div class="font-semibold text-gray-900">{{ $booking->user->name ?? '—' }}</div>
                                        <div class="text-gray-500">{{ $booking->user->email ?? '' }}</div>
                                    </td>
                                    <td class="px-3 py-2">{{ $booking->unit->code ?? ($booking->unit->name ?? '—') }}</td>
                                    <td class="px-3 py-2">{{ optional($booking->start_time ?? $booking->start_date)->format('d M Y H:i') }}</td>
                                    <td class="px-3 py-2">{{ optional($booking->end_time ?? $booking->end_date)->format('d M Y H:i') }}</td>
                                    <td class="px-3 py-2">Rp {{ number_format((int) $booking->total_price, 0, ',', '.') }}</td>
                                    <td class="px-3 py-2">
                                        @php($st = strtolower($booking->status ?? ''))
                                        <span class="badge {{ $st==='completed' ? 'badge-status-completed' : ($st==='active' ? 'badge-status-active' : ($st==='overdue' ? 'badge-status-overdue' : 'badge-status-cancelled')) }}">{{ ucfirst($booking->status ?? '-') }}</span>
                                    </td>
                                    <td class="px-3 py-2">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ url('/admin/bookings/'.$booking->id) }}" class="action-icon" title="Lihat Detail" aria-label="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="px-3 py-6 text-center text-gray-500">Belum ada pemesanan</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(method_exists($bookings, 'links'))
                        <div class="mt-4">{{ $bookings->appends(request()->query())->links() }}</div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>
</html>


