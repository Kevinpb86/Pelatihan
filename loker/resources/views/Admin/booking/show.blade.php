<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pemesanan - {{ config('app.name', 'Loker') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); }
        .sidebar-gradient { background: linear-gradient(180deg, #667eea 0%, #764ba2 100%); }
        .card { background: rgba(255,255,255,0.95); backdrop-filter: blur(12px); border:1px solid rgba(17,24,39,.06); border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,.06); }
        .badge { padding:6px 10px; border-radius:999px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.04em; }
        .badge-status-active { background: rgba(59,130,246,.12); color:#1d4ed8; border:1px solid rgba(59,130,246,.25); }
        .badge-status-completed { background: rgba(16,185,129,.12); color:#047857; border:1px solid rgba(16,185,129,.25); }
        .badge-status-overdue { background: rgba(245,158,11,.12); color:#b45309; border:1px solid rgba(245,158,11,.25); }
        .btn-primary { background: var(--primary-gradient); color:#fff; padding:10px 16px; border-radius:10px; font-weight:600; border:none; }
        .section-title { font-size:14px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.06em; }
        .dl { display:grid; grid-template-columns: 1fr auto; gap:10px; }
        .dl .dt { color:#6b7280; }
        .dl .dd { font-weight:600; color:#111827; }
    </style>
    @csrf
    </head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="w-64 sidebar-gradient shadow-2xl">
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center"><i class="fas fa-book text-white text-xl"></i></div>
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-white">Admin Panel</h1>
                        <p class="text-xs text-white/70">LokerHub Management</p>
                    </div>
                </div>
            </div>
            <nav class="mt-6 px-4">
                <div class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300"><i class="fas fa-home w-5 h-5 mr-3"></i>Dashboard</a>
                    <a href="{{ route('admin.kelolaloker.index') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300"><i class="fas fa-cube w-5 h-5 mr-3"></i>Kelola Loker</a>
                    <a href="{{ route('admin.bookings.index') }}" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-xl"><i class="fas fa-book w-5 h-5 mr-3"></i>Pemesanan</a>
                    <a href="{{ route('admin.users.index') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300"><i class="fas fa-users w-5 h-5 mr-3"></i>Kelola Pengguna</a>
                    <a href="{{ route('settings') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300"><i class="fas fa-cog w-5 h-5 mr-3"></i>Pengaturan</a>
                </div>
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-gray-200/50">
                <div class="px-6 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center"><i class="fas fa-eye text-white text-2xl"></i></div>
                            <div>
                                <h2 class="text-3xl font-bold" style="background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Detail Pemesanan</h2>
                                <p class="text-gray-600 mt-1">Informasi lengkap transaksi</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium">Kembali</a>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <div class="max-w-6xl mx-auto space-y-6">
                    <div class="card p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <div class="section-title mb-1">Ringkasan Pemesanan</div>
                                <div class="text-2xl font-extrabold tracking-tight text-gray-900">{{ $booking->unit->code ?? '—' }} • {{ $booking->user->name ?? '—' }}</div>
                                <div class="text-sm text-gray-500">Kode Loker • Pengguna</div>
                            </div>
                            <div class="flex items-center gap-3">
                                @php($st = strtolower($booking->status ?? ''))
                                <span class="badge {{ $st==='completed' ? 'badge-status-completed' : ($st==='active' ? 'badge-status-active' : ($st==='overdue' ? 'badge-status-overdue' : 'badge-status-cancelled')) }}">{{ strtoupper($booking->status ?? '-') }}</span>
                                <a href="{{ url('/admin/bookings') }}" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium">Kembali</a>
                                <button onclick="window.print()" class="px-4 py-2 rounded-xl text-white font-semibold" style="background:var(--primary-gradient)"><i class="fas fa-print mr-2"></i>Cetak</button>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="p-4 rounded-xl bg-gradient-to-br from-indigo-50 to-white border border-indigo-100">
                                <div class="text-xs text-indigo-600 font-semibold mb-1">Mulai</div>
                                <div class="text-gray-900 font-bold">{{ optional($booking->start_time)->format('d M Y H:i') }}</div>
                            </div>
                            <div class="p-4 rounded-xl bg-gradient-to-br from-purple-50 to-white border border-purple-100">
                                <div class="text-xs text-purple-600 font-semibold mb-1">Selesai</div>
                                <div class="text-gray-900 font-bold">{{ optional($booking->end_time)->format('d M Y H:i') }}</div>
                            </div>
                            <div class="p-4 rounded-xl bg-gradient-to-br from-emerald-50 to-white border border-emerald-100">
                                <div class="text-xs text-emerald-700 font-semibold mb-1">Total</div>
                                <div class="text-gray-900 font-extrabold">Rp {{ number_format((float)$booking->total_price,0,',','.') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="card p-6">
                            <div class="section-title mb-3 flex items-center"><i class="fas fa-user mr-2 text-purple-600"></i> Data Pengguna</div>
                            <div class="dl text-sm">
                                <div class="dt">Nama</div><div class="dd">{{ $booking->user->name ?? '-' }}</div>
                                <div class="dt">Email</div><div class="dd">{{ $booking->user->email ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="card p-6">
                            <div class="section-title mb-3 flex items-center"><i class="fas fa-cube mr-2 text-purple-600"></i> Data Loker</div>
                            <div class="dl text-sm">
                                <div class="dt">Kode</div><div class="dd">{{ $booking->unit->code ?? '-' }}</div>
                                <div class="dt">Nama</div><div class="dd">{{ $booking->unit->name ?? '-' }}</div>
                                <div class="dt">Harga</div><div class="dd">Rp {{ number_format((float)($booking->total_price ?? 0),0,',','.') }}</div>
                            </div>
                        </div>
                        <div class="card p-6 lg:col-span-2">
                            <div class="section-title mb-3 flex items-center"><i class="fas fa-receipt mr-2 text-purple-600"></i> Rincian Pemesanan</div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div class="dl"><div class="dt">Mulai</div><div class="dd">{{ optional($booking->start_time)->format('d M Y H:i') }}</div></div>
                                <div class="dl"><div class="dt">Selesai</div><div class="dd">{{ optional($booking->end_time)->format('d M Y H:i') }}</div></div>
                                <div class="dl"><div class="dt">Durasi</div><div class="dd">{{ ($booking->start_time && $booking->end_time) ? $booking->start_time->diffInHours($booking->end_time).' jam' : '-' }}</div></div>
                                <div class="dl"><div class="dt">Status</div><div class="dd">
                                    @php($st = strtolower($booking->status ?? ''))
                                    <span class="badge {{ $st==='completed' ? 'badge-status-completed' : ($st==='active' ? 'badge-status-active' : ($st==='overdue' ? 'badge-status-overdue' : 'badge-status-cancelled')) }}">{{ ucfirst($booking->status ?? '-') }}</span>
                                </div></div>
                                @if($booking->fine)
                                    <div class="dl md:col-span-2"><div class="dt">Denda</div><div class="dd">Rp {{ number_format((float)$booking->fine->amount,0,',','.') }} {{ $booking->fine->paid ? '(Lunas)' : '(Belum dibayar)' }}</div></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>



