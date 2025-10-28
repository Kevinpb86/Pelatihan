<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barang Saya - {{ config('app.name', 'Loker') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root{
            --purple-1:#667eea; --purple-2:#764ba2;
            --muted:#6b7280; --card-bg: rgba(255,255,255,0.96);
        }
        body{font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto; background:linear-gradient(135deg,#f5f7fa 0%,#e6eefc 100%); margin:0; padding:28px;}
        .wrap{max-width:1100px;margin:0 auto}
        .panel{background:var(--card-bg);border-radius:14px;padding:20px;box-shadow:0 10px 30px rgba(16,24,40,0.06);border:1px solid rgba(0,0,0,0.04)}
        .head{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:16px}
        .title{display:flex;align-items:center;gap:12px}
        .title .icon{width:52px;height:52px;border-radius:12px;background:linear-gradient(90deg,var(--purple-1),var(--purple-2));display:flex;align-items:center;justify-content:center;color:#fff;font-size:20px}
        .title h1{margin:0;font-size:18px}
        .controls{display:flex;gap:10px;align-items:center}
        .search{padding:10px 12px;border-radius:10px;border:1px solid rgba(15,23,42,0.06);min-width:260px}
        .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:10px;border:0;color:#fff;cursor:pointer;background:linear-gradient(135deg,var(--purple-1),var(--purple-2));box-shadow:0 8px 24px rgba(118,75,162,0.12)}
        .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:14px;margin-top:14px}
        .item{display:flex;gap:12px;padding:12px;border-radius:12px;background:linear-gradient(180deg,#fff,#fbfbff);align-items:center;border:1px solid rgba(0,0,0,0.04);transition:transform .14s, box-shadow .14s}
        .item:hover{transform:translateY(-6px);box-shadow:0 10px 30px rgba(16,24,40,0.06)}
        .item .thumb{width:64px;height:64px;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:20px}
        .thumb.blue{background:linear-gradient(90deg,#6366f1,#8b5cf6)}
        .thumb.green{background:linear-gradient(90deg,#10b981,#059669)}
        .meta{flex:1}
        .meta .name{font-weight:600}
        .meta .meta-sub{font-size:13px;color:var(--muted);margin-top:6px}
        .actions{display:flex;gap:8px}
        .chip{padding:6px 8px;border-radius:8px;background:rgba(15,23,42,0.04);font-size:13px;color:var(--muted)}

        /* popup + detail modal */
        .overlay{position:fixed;inset:0;background:rgba(2,6,23,0.45);display:flex;align-items:center;justify-content:center;z-index:9999;backdrop-filter:blur(4px)}
        .modal{width:420px;max-width:calc(100% - 36px);background:#fff;border-radius:12px;padding:18px;box-shadow:0 18px 50px rgba(2,6,23,0.36);transform:translateY(8px) scale(.98);opacity:0;animation:modalIn .28s forwards}
        @keyframes modalIn{to{transform:none;opacity:1}}
        .modal .row{display:flex;gap:12px;align-items:center;margin-top:10px}
        .close-btn{background:transparent;border:0;color:var(--muted);cursor:pointer;font-size:16px}

        /* popup small processing */
        .popup-card{width:300px;background:linear-gradient(180deg,#fff,#fbfbff);border-radius:12px;padding:18px;display:flex;flex-direction:column;gap:12px;align-items:center;box-shadow:0 18px 50px rgba(2,6,23,0.28)}
        .spinner{width:44px;height:44px;border:4px solid rgba(118,75,162,0.12);border-top-color:#6d28d9;border-radius:50%;animation:spin .8s linear infinite}
        @keyframes spin{to{transform:rotate(360deg)}}

        /* btn press + ripple */
        .btn-animate{position:relative;overflow:hidden;-webkit-tap-highlight-color:transparent}
        .btn-animate:active{transform:translateY(1px) scale(.996)}
        .ripple{position:absolute;border-radius:50%;transform:scale(0);background:rgba(255,255,255,0.32);animation:ripple .6s linear;pointer-events:none}
        @keyframes ripple{to{transform:scale(4);opacity:0}}
        @media (max-width:640px){ .head{flex-direction:column;align-items:flex-start} .controls{width:100%;flex-wrap:wrap} .search{min-width:100%} }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="panel">
            <div class="head">
                <div class="title">
                    <div class="icon"><i class="fas fa-box"></i></div>
                    <div>
                        <h1>Barang Saya</h1>
                        <div style="font-size:13px;color:var(--muted)">Kelola barang yang Anda titipkan — lihat status, perpanjang atau buka detail.</div>
                    </div>
                </div>

                <div class="controls">
                    <input id="item-search" class="search" placeholder="Cari nama barang / loker..." />
                    <button onclick="showPopupAndNavigate(event, '{{ route('store-item') }}', 'Mengarahkan ke Titip Barang...')" class="btn btn-animate"><i class="fas fa-plus"></i> Titip Barang</button>
                </div>
            </div>

            @if(isset($items) && count($items) > 0)
                <div class="grid" id="items-grid">
                    @foreach($items as $item)
                    <div class="item" data-name="{{ strtolower($item['name']) }}">
                        <div class="thumb {{ $item['status'] === 'Kosong' ? 'green' : 'blue' }}">
                            <i class="{{ $item['icon'] ?? 'fas fa-box' }}"></i>
                        </div>
                        <div class="meta">
                            <div class="name">{{ $item['name'] }}</div>
                            <div class="meta-sub">Loker <strong>{{ $item['locker'] }}</strong> • {{ $item['updated'] }}</div>
                            <div style="margin-top:8px;display:flex;gap:8px">
                                <div class="chip">{{ $item['status'] }}</div>
                                <div class="chip">Durasi: 3 hari</div>
                            </div>
                        </div>
                        <div class="actions">
                            <button class="btn btn-animate" onclick="openDetailModal(@json($item))"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-animate" onclick="showPopupAndNavigate(event, '#', 'Memproses perpanjangan...')"><i class="fas fa-calendar-plus"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div style="padding:28px;text-align:center">
                    <div style="font-size:48px;color:#9CA3AF"><i class="fas fa-box-open"></i></div>
                    <h3 style="margin-top:10px">Belum ada barang</h3>
                    <p style="max-width:540px;margin:10px auto;color:var(--muted)">Anda belum menambahkan barang. Klik Titip Barang untuk menambah dan mengelola titipan.</p>
                    <div style="margin-top:12px">
                        <button onclick="showPopupAndNavigate(event, '{{ route('store-item') }}', 'Mengarahkan ke Titip Barang...')" class="btn btn-animate"><i class="fas fa-plus"></i> Titip Barang</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- detail modal template (hidden until used) -->
    <template id="detail-template">
        <div class="overlay">
            <div class="modal">
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <div style="display:flex;gap:12px;align-items:center">
                        <div id="modal-thumb" style="width:52px;height:52px;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff"></div>
                        <div>
                            <div id="modal-title" style="font-weight:700"></div>
                            <div id="modal-sub" style="font-size:13px;color:var(--muted)"></div>
                        </div>
                    </div>
                    <button class="close-btn" onclick="closeModal(this)"><i class="fas fa-times"></i></button>
                </div>
                <div class="row">
                    <div style="flex:1">
                        <div style="font-size:13px;color:var(--muted)">Lokasi</div>
                        <div style="font-weight:600" id="modal-locker"></div>
                    </div>
                    <div style="flex:1">
                        <div style="font-size:13px;color:var(--muted)">Status</div>
                        <div style="font-weight:600" id="modal-status"></div>
                    </div>
                </div>

                <div style="display:flex;gap:8px;margin-top:16px">
                    <button class="btn btn-animate" onclick="showPopupAndNavigate(event, '#', 'Memproses pengambilan...')"><i class="fas fa-hand-paper"></i> Ambil Barang</button>
                    <button class="btn btn-animate" onclick="showPopupAndNavigate(event, '#', 'Memperpanjang masa titip...')"><i class="fas fa-calendar-plus"></i> Perpanjang</button>
                </div>
            </div>
        </div>
    </template>

    <script>
        // search
        document.getElementById('item-search').addEventListener('input', function(){
            const q = this.value.trim().toLowerCase();
            document.querySelectorAll('#items-grid .item').forEach(el=>{
                const name = el.getAttribute('data-name') || '';
                el.style.display = q && name.indexOf(q) === -1 ? 'none' : 'flex';
            });
        });

        // popup + modal helpers
        function createPopup(message='Memproses...') {
            const overlay = document.createElement('div'); overlay.className='overlay';
            const holder = document.createElement('div'); holder.className='popup-card';
            const spinner = document.createElement('div'); spinner.className='spinner';
            const title = document.createElement('div'); title.textContent = message; title.style.fontWeight='600';
            holder.appendChild(spinner); holder.appendChild(title); overlay.appendChild(holder);
            document.body.appendChild(overlay);
            return {
                close(delay=0){ setTimeout(()=>{ if(overlay.parentNode) overlay.parentNode.removeChild(overlay); }, delay); }
            };
        }

        function showPopupAndNavigate(e, url, message){
            if(e && e.preventDefault) e.preventDefault();
            const btn = e && e.currentTarget ? e.currentTarget : null;
            if(btn) addRipple(btn, e);
            const popup = createPopup(message || 'Memproses...');
            setTimeout(()=> {
                if(url && url !== '#') { popup.close(0); setTimeout(()=> window.location.href = url, 180); }
                else popup.close(700);
            }, 700);
        }

        // ripple
        function addRipple(el, e){
            const rect = el.getBoundingClientRect();
            const r = document.createElement('span'); r.className='ripple';
            const size = Math.max(rect.width, rect.height) * 1.2; r.style.width = r.style.height = size + 'px';
            const x = (e && e.clientX ? e.clientX : rect.left + rect.width/2) - rect.left - size/2;
            const y = (e && e.clientY ? e.clientY : rect.top + rect.height/2) - rect.top - size/2;
            r.style.left = x + 'px'; r.style.top = y + 'px';
            el.appendChild(r);
            setTimeout(()=> r.remove(), 700);
        }

        // detail modal
        function openDetailModal(item) {
            const tpl = document.getElementById('detail-template');
            const clone = tpl.content.cloneNode(true);
            // fill data
            clone.querySelector('#modal-title').textContent = item.name;
            clone.querySelector('#modal-sub').textContent = 'Terakhir: ' + item.updated;
            clone.querySelector('#modal-locker').textContent = item.locker;
            clone.querySelector('#modal-status').textContent = item.status;
            const thumb = clone.querySelector('#modal-thumb');
            thumb.style.background = item.status === 'Kosong' ? 'linear-gradient(90deg,#10b981,#059669)' : 'linear-gradient(90deg,#6366f1,#8b5cf6)';
            thumb.innerHTML = '<i class="'+(item.icon||'fas fa-box')+'"></i>';
            document.body.appendChild(clone);
        }
        function closeModal(btn){
            const overlay = btn.closest('.overlay');
            if(!overlay) return;
            overlay.remove();
        }

        // keyboard accessibility: open active button ripple on keypress
        document.addEventListener('keydown', function(e){
            if((e.key==='Enter' || e.code==='Space') && document.activeElement && document.activeElement.classList.contains('btn-animate')){
                addRipple(document.activeElement, e);
            }
        });
    </script>
</body>
</html>