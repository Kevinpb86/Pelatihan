<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Pengguna - {{ config('app.name', 'Loker') }}</title>
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
        .nav-item:hover { background: rgba(255, 255, 255, 0.1); transform: translateX(5px); }
        .card { background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border:1px solid rgba(255,255,255,.5); box-shadow: 0 8px 24px rgba(0,0,0,0.06); border-radius: 16px; }
        .table thead th { font-size:11px; text-transform:uppercase; letter-spacing:.05em; color:#6b7280; font-weight:600; padding:12px 16px; background:#f9fafb; }
        .table tbody tr { transition: all 0.2s ease; }
        .table tbody tr:hover { background:#f9fafb; }
        .table tbody td { padding:16px; vertical-align: middle; }
        .btn-primary { background: linear-gradient(135deg,#667eea 0%,#764ba2 100%); color:#fff; padding:12px 20px; border-radius:12px; font-weight:600; border:none; cursor:pointer; transition: all 0.3s; position:relative; overflow:hidden; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(102,126,234,.3); cursor:pointer; }
        .btn-save { background: linear-gradient(135deg,#3b82f6 0%,#2563eb 100%); color:#fff; padding:8px 16px; border-radius:8px; font-size:12px; font-weight:600; border:none; cursor:pointer; transition: all 0.3s ease; }
        .btn-danger { background: linear-gradient(135deg,#ef4444 0%,#dc2626 100%); color:#fff; padding:8px 12px; border:none; border-radius:8px; font-size:12px; font-weight:600; cursor:pointer; }
        .alert-success { padding:12px 16px; background: linear-gradient(135deg,#d1fae5 0%,#a7f3d0 100%); color:#065f46; border-radius:10px; border-left:4px solid #10b981; margin-bottom:20px; }
        input[type="text"], input[type="email"], input[type="password"], select { padding:10px 12px; border:2px solid #e5e7eb; border-radius:8px; transition: all 0.3s ease; font-size:14px; width:100%; }
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, select:focus { outline:none; border-color:#667eea; box-shadow:0 0 0 3px rgba(102,126,234,0.1); }
        .badge { padding:6px 10px; border-radius:999px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.04em; }
        .badge-role-admin { background: rgba(59,130,246,.12); color:#1d4ed8; border:1px solid rgba(59,130,246,.25); }
        .badge-role-user { background: rgba(16,185,129,.12); color:#047857; border:1px solid rgba(16,185,129,.25); }
        
        .toolbar { display:flex; gap:12px; flex-wrap:wrap; align-items:center; }
    </style>
    @csrf
    @method('PUT')
    @method('DELETE')
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
                    <a href="{{ route('admin.bookings.index') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all duration-300">
                        <i class="fas fa-book w-5 h-5 mr-3"></i>
                        Pemesanan
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-xl">
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
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold" style="background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Kelola Pengguna</h2>
                            <p class="text-gray-600 mt-1">Pantau dan kelola akun pengguna</p>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 card rounded-2xl shadow-xl p-6">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-xl font-semibold text-gray-800 flex items-center"><i class="fas fa-list-ul mr-3 text-purple-600"></i> Daftar Pengguna</h3>
                        </div>
                        <form method="GET" action="{{ route('admin.users.index') }}" class="toolbar mb-4">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-search text-gray-400"></i>
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau email..." class="w-64" />
                            </div>
                            <div class="w-40">
                                <select name="role">
                                    <option value="">Semua Role</option>
                                    <option value="user" {{ request('role')==='user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ request('role')==='admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <div class="w-32">
                                <select name="per_page">
                                    @php($pp = (int) (request('per_page') ?: 10))
                                    <option value="10" {{ $pp===10 ? 'selected' : '' }}>10 / halaman</option>
                                    <option value="25" {{ $pp===25 ? 'selected' : '' }}>25 / halaman</option>
                                    <option value="50" {{ $pp===50 ? 'selected' : '' }}>50 / halaman</option>
                                </select>
                            </div>
                            <button class="btn-primary"><i class="fas fa-filter mr-2"></i> Terapkan</button>
                            @if(request()->hasAny(['q','role','per_page']))
                                <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Reset</a>
                            @endif
                        </form>
                        @if(session('success'))
                            <div class="alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="overflow-x-auto">
                            <table class="min-w-full table">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left">Pengguna</th>
                                        <th class="px-3 py-2 text-left">Email</th>
                                        <th class="px-3 py-2 text-left">Role</th>
                                        <th class="px-3 py-2 text-left">Terdaftar</th>
                                        <th class="px-3 py-2 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-gray-700">
                                @forelse($users as $user)
                                    <tr class="border-t">
                                        <td class="px-3 py-2">
                                            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="flex items-center gap-3">
                                                @csrf
                                                @method('PUT')
                                                
                                                <input name="name" value="{{ $user->name }}" class="px-2 py-1 border rounded-md w-44" />
                                                <input name="email" value="{{ $user->email }}" class="px-2 py-1 border rounded-md w-56" />
                                                <select name="role" class="w-32">
                                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                </select>
                                                <input type="password" name="password" placeholder="Password baru (opsional)" class="px-2 py-1 border rounded-md w-56" />
                                                <button type="submit" class="btn-save"><i class="fas fa-save mr-1"></i> Simpan</button>
                                            </form>
                                        </td>
                                        <td class="px-3 py-2">{{ $user->email }}</td>
                                        <td class="px-3 py-2">
                                            <span class="badge {{ $user->role==='admin' ? 'badge-role-admin' : 'badge-role-user' }}">{{ strtoupper($user->role) }}</span>
                                        </td>
                                        <td class="px-3 py-2">{{ $user->created_at?->format('d M Y') }}</td>
                                        <td class="px-3 py-2">
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger"><i class="fas fa-trash mr-1"></i> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-3 py-6 text-center text-gray-500">Belum ada pengguna</td></tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if(method_exists($users, 'links'))
                            <div class="mt-4">{{ $users->appends(request()->query())->links() }}</div>
                        @endif
                    </div>

                    <div class="card rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center"><i class="fas fa-user-plus mr-3 text-purple-600"></i> Tambah Pengguna</h3>
                        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <label class="text-sm text-gray-700">Nama</label>
                                <input name="name" class="w-full" placeholder="Nama lengkap" required />
                            </div>
                            <div>
                                <label class="text-sm text-gray-700">Email</label>
                                <input type="email" name="email" class="w-full" placeholder="email@example.com" required />
                            </div>
                            <div>
                                <label class="text-sm text-gray-700">Password</label>
                                <input type="password" name="password" class="w-full" placeholder="Minimal 6 karakter" required />
                            </div>
                            <div>
                                <label class="text-sm text-gray-700">Role</label>
                                <select name="role" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
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


