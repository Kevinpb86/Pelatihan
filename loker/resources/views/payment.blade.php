<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran - {{ config('app.name', 'Loker') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%); --success: #10b981; --warning:#f59e0b; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; }
        .sidebar-gradient { background: linear-gradient(180deg, #667eea 0%, #764ba2 100%); }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color:#fff; padding:12px 18px; border-radius:12px; font-weight:600; display:inline-flex; align-items:center; gap:10px; border:none; cursor:pointer; box-shadow:0 6px 18px rgba(118,75,162,0.18); }
        .btn-secondary { background:#f3f4f6; color:#111827; padding:10px 14px; border-radius:10px; font-weight:600; }
        .card { background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border: 1px solid rgba(17,24,39,0.06); border-radius:16px; box-shadow: 0 12px 30px rgba(0,0,0,0.06); }
        .summary-row { display:flex; align-items:center; justify-content:space-between; padding:.6rem 0; border-bottom:1px dashed #e5e7eb; }
        .summary-row:last-child { border-bottom:none; }
        .method { border:2px solid #e5e7eb; border-radius: 14px; padding:12px; cursor:pointer; transition:.2s; display:flex; align-items:center; gap:10px; background:#fff; }
        .method svg { width:20px; height:20px; }
        .method:hover { transform: translateY(-2px); box-shadow:0 10px 24px rgba(0,0,0,.06); }
        .method.active { border-color:#7c3aed; box-shadow:0 6px 20px rgba(124,58,237,.12); background:linear-gradient(180deg,#fff, #faf5ff); }
        .qr-box { border:2px dashed #e5e7eb; border-radius:14px; padding:16px; display:flex; flex-direction:column; align-items:center; gap:10px; background:#fff; }
        .stepper { display:grid; grid-template-columns: repeat(3,1fr); gap:10px; align-items:center; }
        .step { display:flex; align-items:center; gap:10px; }
        .step .dot { width:10px; height:10px; border-radius:999px; background:#e5e7eb; }
        .step.done .dot { background:#7c3aed; }
        .secure { display:flex; align-items:center; gap:8px; font-size:12px; color:#065f46; background:rgba(16,185,129,.12); border:1px solid rgba(16,185,129,.2); padding:8px 10px; border-radius:10px; }
        .dark-theme { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%) !important; color:#e5e5e5 !important; }
        .dark-theme .card { background: rgba(45,45,45,0.85); border-color: rgba(255,255,255,0.12); }
    </style>
</head>
<body class="bg-gray-100" id="main-body">
    <div class="flex h-screen">
        <div class="w-64 sidebar-gradient shadow-2xl">
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <i class="fas fa-lock text-white text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-white">LokerHub</h1>
                        <p class="text-xs text-white/70">Sistem Penitipan Barang</p>
                    </div>
                </div>
            </div>
            <nav class="mt-6 px-4">
                <div class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-white/20 backdrop-blur-sm rounded-xl">
                        <i class="fas fa-home w-5 h-5 mr-3"></i> Dashboard
                    </a>
                    <a href="{{ url('/my-items') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all">
                        <i class="fas fa-box w-5 h-5 mr-3"></i> Barang Saya
                    </a>
                    <a href="{{ route('store-item') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all">
                        <i class="fas fa-plus-circle w-5 h-5 mr-3"></i> Titip Barang
                    </a>
                    <a href="{{ route('settings') }}" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-white/80 hover:text-white rounded-xl transition-all">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i> Pengaturan
                    </a>
                </div>
            </nav>
            <div class="absolute bottom-0 w-64 p-6 border-t border-white/20">
                <form method="POST" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="w-full bg-red-500/80 hover:bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all">
                        <i class="fas fa-sign-out-alt mr-2"></i> Keluar
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
                                <i class="fas fa-credit-card text-white text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold" style="background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Pembayaran</h2>
                                <p class="text-gray-600 mt-1">Selesaikan pembayaran penitipan barang Anda</p>
                                <div class="stepper mt-3 text-xs text-gray-500">
                                    <div class="step done"><span class="dot"></span><span>Pilih Loker</span></div>
                                    <div class="step done"><span class="dot"></span><span>Rincian & Pembayaran</span></div>
                                    <div class="step"><span class="dot"></span><span>Selesai</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="secure"><i class="fas fa-shield-alt"></i> Transaksi aman & terenkripsi</div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
                <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 card rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center"><i class="fas fa-list-ul mr-3 text-purple-600"></i> Ringkasan Pesanan</h3>
                        <div class="space-y-2">
                            <div class="summary-row">
                                <span class="text-gray-600">Loker</span>
                                <span class="font-semibold flex items-center gap-2"><span class="inline-flex items-center justify-center w-6 h-6 rounded bg-purple-100 text-purple-700"><i class="fas fa-cube text-xs"></i></span>{{ $unit->code }} - {{ $unit->name }}</span>
                            </div>
                            <div class="summary-row"><span class="text-gray-600">Nama Barang</span><span class="font-semibold">{{ session('item_name') ?? $item_name }}</span></div>
                            <div class="summary-row"><span class="text-gray-600">Kategori</span><span class="font-semibold">{{ session('item_category') ?? $item_category }}</span></div>
                            <div class="summary-row"><span class="text-gray-600">Durasi</span><span class="font-semibold">{{ $durationHours }} jam</span></div>
                            <div class="summary-row"><span class="text-gray-600">Mulai</span><span class="font-semibold flex items-center gap-2"><i class="fas fa-calendar text-gray-400"></i>{{ $startTime->format('d M Y H:i') }}</span></div>
                            <div class="summary-row"><span class="text-gray-600">Selesai</span><span class="font-semibold flex items-center gap-2"><i class="fas fa-clock text-gray-400"></i>{{ $endTime->format('d M Y H:i') }}</span></div>
                        </div>

                        <div class="mt-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3">Rincian Biaya</h4>
                            @php
                                $pricePerHour = (float) $unit->price_per_hour;
                            @endphp
                            <div class="space-y-2">
                                <div class="flex items-center justify-between text-sm"><span>Harga per jam</span><span>Rp {{ number_format($pricePerHour,0,',','.') }}</span></div>
                                <div class="flex items-center justify-between text-sm"><span>Durasi</span><span>{{ $durationHours }} jam</span></div>
                                <div class="flex items-center justify-between text-base font-bold border-t pt-2"><span>Total</span><span class="text-purple-700">Rp {{ number_format($totalPrice,0,',','.') }}</span></div>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between text-xs text-gray-500">
                            <div class="flex items-center gap-2"><i class="fas fa-receipt"></i> Kode Pesanan: <span class="font-semibold" id="order-code">LK-{{ $unit->id }}-{{ now()->format('His') }}</span></div>
                            <button type="button" class="btn-secondary" onclick="copyText('#order-code')"><i class="fas fa-copy mr-1"></i>Salin</button>
                        </div>
                    </div>

                    <div class="card rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center"><i class="fas fa-wallet mr-3 text-purple-600"></i> Metode Pembayaran</h3>
                        <div class="grid grid-cols-2 gap-3" id="method-list">
                            <div class="method active" data-method="qr"><i class="fas fa-qrcode text-purple-600"></i><span>QRIS</span></div>
                            <div class="method" data-method="bank"><i class="fas fa-university text-blue-600"></i><span>Transfer Bank</span></div>
                            <div class="method" data-method="dana">
                                <svg viewBox="0 0 512 512" aria-hidden="true"><circle cx="256" cy="256" r="256" fill="#2aa7df"/><path fill="#fff" d="M256 152c-57.4 0-104 46.6-104 104s46.6 104 104 104 104-46.6 104-104S313.4 152 256 152zm0 56c26.5 0 48 21.5 48 48s-21.5 48-48 48-48-21.5-48-48 21.5-48 48-48z"/></svg>
                                <span>DANA</span>
                            </div>
                            <div class="method" data-method="ovo">
                                <svg viewBox="0 0 512 512" aria-hidden="true"><circle cx="256" cy="256" r="256" fill="#5f3dc4"/><path fill="#fff" d="M256 156c-55.2 0-100 44.8-100 100s44.8 100 100 100 100-44.8 100-100-44.8-100-100-100zm0 56c24.3 0 44 19.7 44 44s-19.7 44-44 44-44-19.7-44-44 19.7-44 44-44z"/></svg>
                                <span>OVO</span>
                            </div>
                            <div class="method" data-method="gopay">
                                <svg viewBox="0 0 512 512" aria-hidden="true"><rect width="512" height="512" rx="256" fill="#00a6a0"/><path fill="#fff" d="M256 168c-48.6 0-88 39.4-88 88s39.4 88 88 88 88-39.4 88-88-39.4-88-88-88zm0 44c24.3 0 44 19.7 44 44s-19.7 44-44 44-44-19.7-44-44 19.7-44 44-44z"/></svg>
                                <span>GoPay</span>
                            </div>
                        </div>

                        <div class="mt-5 space-y-4" id="method-detail">
                            <div id="qr-section" class="qr-box">
                                <div class="w-40 h-40 bg-white rounded-md flex items-center justify-center">
                                    <i class="fas fa-qrcode text-5xl text-gray-700"></i>
                                </div>
                                <p class="text-sm text-gray-600 text-center">Scan QR untuk membayar total Rp {{ number_format($totalPrice,0,',','.') }}</p>
                            </div>
                            <div id="bank-section" class="hidden">
                                <div class="bg-white rounded-xl p-4 border border-gray-200">
                                    <p class="text-sm text-gray-600">Transfer ke rekening:</p>
                                    <p class="font-semibold mt-1">BCA 1234567890 a.n LokerHub</p>
                                    <p class="text-xs text-gray-500 mt-2">Nominal: Rp {{ number_format($totalPrice,0,',','.') }}</p>
                                </div>
                            </div>
                            <div id="e-wallet-section" class="hidden">
                                <div class="bg-white rounded-xl p-4 border border-gray-200">
                                    <p class="text-sm text-gray-600">Gunakan aplikasi e-wallet pilihan Anda, masukkan nominal:</p>
                                    <p class="font-semibold mt-1">Rp {{ number_format($totalPrice,0,',','.') }}</p>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('payment.process') }}" class="mt-6">
                            @csrf
                            <input type="hidden" name="unit_id" value="{{ $unit->id }}">
                            <input type="hidden" name="item_name" value="{{ session('item_name') ?? $item_name }}">
                            <input type="hidden" name="item_category" value="{{ session('item_category') ?? $item_category }}">
                            <input type="hidden" name="duration_hours" value="{{ $durationHours }}">
                            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                            <input type="hidden" name="payment_method" id="payment_method" value="qr">
                            <button type="submit" class="w-full btn-primary justify-center text-white">
                                <i class="fas fa-check-circle"></i>
                                Bayar & Titip Sekarang
                            </button>
                            <a href="{{ route('store-item') }}" class="mt-3 w-full inline-flex justify-center px-4 py-3 rounded-xl border border-gray-300 text-gray-700 font-medium">Kembali</a>
                        </form>
                        <p class="text-xs text-gray-500 mt-4">Ketentuan harga: Mengikuti harga admin sebesar Rp {{ number_format((float)$unit->price_per_hour,0,',','.') }} per jam.</p>
                        <div class="mt-3 text-[11px] text-gray-400">Dengan melanjutkan pembayaran, Anda menyetujui Syarat & Ketentuan LokerHub.</div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const methods = document.querySelectorAll('.method');
            const input = document.getElementById('payment_method');
            const qr = document.getElementById('qr-section');
            const bank = document.getElementById('bank-section');
            const ew = document.getElementById('e-wallet-section');
            function show(section){
                [qr, bank, ew].forEach(s=> s.classList.add('hidden'));
                section.classList.remove('hidden');
            }
            methods.forEach(m => m.addEventListener('click', function(){
                methods.forEach(x=>x.classList.remove('active'));
                this.classList.add('active');
                const v = this.getAttribute('data-method');
                input.value = v;
                if(v==='qr'){ show(qr); }
                else if(v==='bank'){ show(bank); }
                else { show(ew); }
            }));
        });

        function copyText(selector){
            const el = document.querySelector(selector);
            if(!el) return;
            const range = document.createRange();
            range.selectNode(el);
            const sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
            document.execCommand('copy');
            sel.removeAllRanges();
        }
    </script>
</body>
</html>


