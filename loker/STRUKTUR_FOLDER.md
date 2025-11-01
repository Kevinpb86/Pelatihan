# 📁 STRUKTUR FOLDER PROYEK LOKERHUB
## Penjelasan Lengkap Struktur Direktori Laravel

---

## 📂 OVERVIEW STRUKTUR UTAMA

```
loker/
├── app/                    # Core aplikasi (MVC Pattern)
├── bootstrap/              # Bootstrap & konfigurasi awal
├── config/                 # File konfigurasi aplikasi
├── database/               # Migrations, seeders, factories
├── public/                 # Entry point aplikasi (web accessible)
├── resources/              # Views, CSS, JavaScript (source files)
├── routes/                 # Definisi routes aplikasi
├── storage/                # File storage, logs, cache
├── tests/                  # Unit & Feature tests
├── vendor/                 # Dependencies Composer (auto-generated)
├── node_modules/           # Dependencies NPM (auto-generated)
├── artisan                 # Laravel CLI tool
├── composer.json           # PHP dependencies
├── package.json            # JavaScript dependencies
├── vite.config.js          # Konfigurasi Vite (build tool)
└── phpunit.xml             # Konfigurasi testing
```

---

## 📂 PENJELASAN DETAIL SETIAP FOLDER

### 1. 📁 **`app/`** - Core Application Logic
**Fungsi:** Berisi logika aplikasi utama menggunakan pattern MVC (Model-View-Controller)

```
app/
├── Console/
│   └── Commands/           # Custom Artisan commands
│       └── [Command files]
│
├── Http/
│   ├── Controllers/        # ⭐ CONTROLLER (Business Logic)
│   │   ├── AuthController.php
│   │   ├── ItemController.php
│   │   ├── AdminDashboardController.php
│   │   ├── UserDashboardController.php
│   │   ├── AdminUnitController.php
│   │   └── [Controller lainnya]
│   │
│   └── Middleware/         # Middleware (Auth, CSRF, dll)
│       └── [Middleware files]
│
├── Models/                 # ⭐ MODEL (Database Layer)
│   ├── User.php           # Model untuk tabel users
│   ├── Unit.php           # Model untuk tabel units
│   ├── Booking.php        # Model untuk tabel bookings
│   ├── Fine.php           # Model untuk tabel fines
│   └── Category.php       # Model untuk tabel categories
│
└── Providers/             # Service Providers
    └── AppServiceProvider.php
```

**Penjelasan:**
- **Controllers/**: Menangani request HTTP, validasi, dan memanggil Model
- **Models/**: Representasi tabel database, relasi, dan query database
- **Middleware/**: Filter request sebelum sampai ke Controller (auth, CSRF)
- **Console/Commands/**: Perintah custom untuk Artisan CLI
- **Providers/**: Service container binding dan bootstrap services

**Contoh Penggunaan:**
```php
// app/Http/Controllers/ItemController.php
class ItemController extends Controller {
    public function showStoreItem() {
        $units = Unit::all();  // Menggunakan Model Unit
        return view('store-item', compact('units'));  // Mengembalikan View
    }
}
```

---

### 2. 📁 **`bootstrap/`** - Bootstrap & Initialization
**Fungsi:** File yang diperlukan untuk bootstrap aplikasi Laravel

```
bootstrap/
├── app.php                 # Bootstrap aplikasi utama
├── cache/                  # Cache bootstrap files
│   ├── packages.php
│   └── services.php
└── providers.php           # Service providers registry
```

**Penjelasan:**
- File-file ini di-load pertama kali saat aplikasi Laravel dimulai
- Biasanya tidak perlu di-edit secara langsung
- Cache digunakan untuk meningkatkan performa

---

### 3. 📁 **`config/`** - Configuration Files
**Fungsi:** Berisi semua file konfigurasi aplikasi

```
config/
├── app.php                 # Konfigurasi aplikasi (name, timezone, locale)
├── auth.php                # Konfigurasi authentication
├── cache.php               # Konfigurasi cache
├── database.php            # Konfigurasi database connection
├── filesystems.php         # Konfigurasi file storage
├── logging.php             # Konfigurasi logging
├── mail.php                # Konfigurasi email
├── queue.php               # Konfigurasi queue
├── services.php            # Konfigurasi third-party services
└── session.php             # Konfigurasi session
```

**Penjelasan:**
- Semua konfigurasi aplikasi disimpan di sini
- Dapat diakses via `config('app.name')` atau `config('database.default')`
- Nilai default, tapi bisa di-override via `.env` file

**Contoh Penggunaan:**
```php
// config/app.php
'name' => env('APP_NAME', 'LokerHub'),
'timezone' => 'Asia/Jakarta',

// Akses di kode:
config('app.name')  // Returns: "LokerHub"
```

---

### 4. 📁 **`database/`** - Database Related Files
**Fungsi:** Migrations, seeders, factories untuk mengelola database

```
database/
├── database.sqlite         # SQLite database file (development)
│
├── migrations/             # ⭐ DATABASE SCHEMA (Version Control)
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 0001_01_01_000001_create_cache_table.php
│   ├── 2025_10_26_045041_create_units_table.php
│   ├── 2025_10_27_045041_create_bookings_table.php
│   ├── 2025_10_27_045042_create_fines_table.php
│   └── [migration lainnya]
│
├── factories/              # Database factories (untuk testing)
│   └── UserFactory.php     # Generate dummy data
│
└── seeders/                # Database seeders (data awal)
    └── DatabaseSeeder.php  # Main seeder
```

**Penjelasan:**
- **Migrations/**: Definisi struktur database (create table, alter table)
  - Setiap migration adalah versi schema database
  - Dapat di-rollback jika perlu
  - Format: `YYYY_MM_DD_HHMMSS_description.php`

- **Seeders/**: Data awal/dummy untuk development/testing
  - Jalankan: `php artisan db:seed`

- **Factories/**: Template untuk generate data dummy
  - Digunakan untuk testing dan development

**Contoh Migration:**
```php
// database/migrations/2025_10_26_045041_create_units_table.php
public function up() {
    Schema::create('units', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique();
        $table->string('name');
        $table->decimal('price_per_hour', 10, 2);
        $table->enum('status', ['available', 'booked']);
        $table->timestamps();
    });
}
```

**Command:**
```bash
php artisan migrate          # Jalankan semua migration
php artisan migrate:rollback # Rollback migration terakhir
php artisan db:seed          # Seed data dummy
```

---

### 5. 📁 **`public/`** - Public Entry Point
**Fungsi:** Folder yang diakses langsung oleh web browser (document root)

```
public/
├── index.php               # ⭐ ENTRY POINT aplikasi
├── .htaccess              # Apache configuration
├── favicon.ico            # Icon website
├── robots.txt             # SEO robots file
│
├── build/                 # Compiled assets (auto-generated)
│   ├── assets/
│   │   ├── app-[hash].css
│   │   └── app-[hash].js
│   └── manifest.json
│
├── hot                    # Vite HMR file (development)
└── storage/               # Symlink ke storage/app/public
```

**Penjelasan:**
- **`index.php`**: Entry point utama aplikasi
  - Semua request HTTP masuk melalui file ini
  - File ini memanggil bootstrap Laravel

- **`build/`**: Compiled assets dari Vite
  - CSS dan JavaScript yang sudah di-compile dan di-minify
  - Di-generate oleh `npm run build`

- **`storage/`**: Symlink untuk file yang bisa diakses publik (avatar, upload)

**Web Server Configuration:**
```apache
# Apache .htaccess
# Semua request diarahkan ke public/index.php
```

---

### 6. 📁 **`resources/`** - Source Files (Views, CSS, JS)
**Fungsi:** File sumber yang akan di-compile/di-render

```
resources/
├── views/                  # ⭐ VIEW (Blade Templates)
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   │
│   ├── Admin/
│   │   ├── dashboard.blade.php
│   │   ├── pemesanan.blade.php
│   │   ├── kelolaloker.blade.php
│   │   ├── kelolapengguna.blade.php
│   │   └── booking/
│   │       ├── index.blade.php
│   │       └── show.blade.php
│   │
│   ├── User/
│   │   ├── dashboard.blade.php
│   │   ├── booking/
│   │   └── unit/
│   │
│   ├── store-item.blade.php
│   ├── payment.blade.php
│   ├── my-items.blade.php
│   ├── takeitem.blade.php
│   ├── settings.blade.php
│   └── welcome.blade.php
│
├── css/
│   └── app.css            # ⭐ CSS Source (Tailwind CSS)
│
└── js/
    ├── app.js             # ⭐ JavaScript Source
    └── bootstrap.js       # JavaScript bootstrap
```

**Penjelasan:**
- **`views/`**: Blade templates (HTML dengan PHP syntax)
  - File `.blade.php` akan di-compile menjadi PHP
  - Support inheritance, components, directives
  - Dapat menggunakan data dari Controller

- **`css/app.css`**: CSS source file
  - Menggunakan Tailwind CSS
  - Di-compile oleh Vite menjadi file di `public/build/`

- **`js/app.js`**: JavaScript source file
  - Vanilla JavaScript atau framework
  - Di-compile oleh Vite

**Contoh Blade Template:**
```blade
{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email">
        <input type="password" name="password">
        <button type="submit">Login</button>
    </form>
@endsection
```

**Mengakses View dari Controller:**
```php
return view('auth.login', ['data' => $data]);
// Mencari: resources/views/auth/login.blade.php
```

---

### 7. 📁 **`routes/`** - Route Definitions
**Fungsi:** Definisi URL routing aplikasi

```
routes/
├── web.php                 # ⭐ Web Routes (HTTP)
└── console.php             # Console routes (Artisan commands)
```

**Penjelasan:**
- **`web.php`**: Definisi routes untuk web application
  - GET, POST, PUT, DELETE routes
  - Middleware groups
  - Route names

**Contoh Routes:**
```php
// routes/web.php
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index']);
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
});
```

**Route Types:**
- `Route::get()` - GET request
- `Route::post()` - POST request
- `Route::put()` - PUT request
- `Route::delete()` - DELETE request
- `Route::resource()` - RESTful resource routes

---

### 8. 📁 **`storage/`** - File Storage & Logs
**Fungsi:** Penyimpanan file, logs, cache, session

```
storage/
├── app/
│   ├── private/            # File private (tidak bisa diakses langsung)
│   └── public/             # File publik (via symlink)
│       └── avatars/        # Upload avatar users
│           └── [avatar files]
│
├── framework/
│   ├── cache/              # Framework cache
│   ├── sessions/           # Session files
│   ├── testing/            # Testing files
│   └── views/              # Compiled Blade views
│
└── logs/
    └── laravel.log         # ⭐ Application logs
```

**Penjelasan:**
- **`app/public/`**: File yang bisa diakses publik
  - Avatar, gambar, dokumen
  - Harus ada symlink ke `public/storage`

- **`framework/cache/`**: Cache files (routes, config, views)
- **`framework/sessions/`**: Session data
- **`framework/views/`**: Compiled Blade templates
- **`logs/`**: Application error logs

**Menyimpan File:**
```php
// Simpan file (misal: avatar)
$path = $request->file('avatar')->store('avatars', 'public');
// Tersimpan di: storage/app/public/avatars/[filename]

// Akses file:
asset('storage/avatars/filename.jpg')
// URL: http://domain.com/storage/avatars/filename.jpg
```

**Setup Symlink:**
```bash
php artisan storage:link
# Membuat symlink: public/storage → storage/app/public
```

---

### 9. 📁 **`tests/`** - Testing Files
**Fungsi:** Unit tests dan Feature tests

```
tests/
├── Feature/                # Feature tests (end-to-end)
│   └── ExampleTest.php
├── Unit/                   # Unit tests (isolated)
│   └── ExampleTest.php
└── TestCase.php            # Base test case
```

**Penjelasan:**
- **Feature Tests**: Test fitur lengkap (request → response)
- **Unit Tests**: Test fungsi/class secara terpisah

**Jalankan Tests:**
```bash
php artisan test            # Run all tests
php artisan test --filter LoginTest  # Run specific test
```

---

### 10. 📁 **`vendor/`** - Composer Dependencies
**Fungsi:** Dependencies PHP dari Composer (auto-generated)

```
vendor/
├── laravel/
│   └── framework/          # Laravel framework core
├── symfony/                # Symfony components
├── monolog/                # Logging library
├── psr/                    # PSR standards
└── autoload.php            # Composer autoloader
```

**Penjelasan:**
- Folder ini di-generate oleh `composer install`
- **JANGAN EDIT** file di sini
- Dependencies didefinisikan di `composer.json`

**Composer Commands:**
```bash
composer install            # Install dependencies
composer update             # Update dependencies
composer require package    # Add new package
```

---

### 11. 📁 **`node_modules/`** - NPM Dependencies
**Fungsi:** Dependencies JavaScript dari NPM (auto-generated)

```
node_modules/
├── vite/                   # Vite build tool
├── tailwindcss/            # Tailwind CSS
├── axios/                  # HTTP client
└── [packages lainnya]
```

**Penjelasan:**
- Folder ini di-generate oleh `npm install`
- **JANGAN EDIT** file di sini
- Dependencies didefinisikan di `package.json`

**NPM Commands:**
```bash
npm install                 # Install dependencies
npm run dev                 # Development mode (watch)
npm run build               # Production build
```

---

## 📄 FILE-FILE PENTING DI ROOT

### **`artisan`**
- Laravel CLI tool
- Command: `php artisan [command]`
- Contoh: `php artisan migrate`, `php artisan serve`

### **`composer.json`**
- Definisi PHP dependencies
- Contoh:
```json
{
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0"
    }
}
```

### **`package.json`**
- Definisi JavaScript dependencies
- Contoh:
```json
{
    "devDependencies": {
        "vite": "^7.0.7",
        "tailwindcss": "^4.1.16"
    }
}
```

### **`vite.config.js`**
- Konfigurasi Vite (build tool)
- Definisi entry points (CSS, JS)
- Plugin configuration

### **`phpunit.xml`**
- Konfigurasi PHPUnit untuk testing

### **`.env`** (tidak ada di repo, harus dibuat)
- Environment variables
- Database credentials
- APP_KEY, APP_URL, dll
- **PENTING**: Jangan commit ke Git!

---

## 🔄 FLOW KERJA DALAM LARAVEL

```
1. USER REQUEST
   ↓
2. public/index.php (Entry Point)
   ↓
3. bootstrap/app.php (Bootstrap)
   ↓
4. routes/web.php (Match Route)
   ↓
5. Middleware (Auth, CSRF, dll)
   ↓
6. Controller (app/Http/Controllers/)
   ↓
7. Model (app/Models/) → Database
   ↓
8. View (resources/views/) → Render HTML
   ↓
9. RESPONSE ke User
```

---

## 🗂️ ORGANISASI FOLDER UNTUK PROJECT INI

### **Struktur Khusus Project LOKERHUB:**

```
app/Http/Controllers/
├── AuthController.php          # Login, Register, Settings
├── ItemController.php          # Simpan & Ambil Barang
├── UserDashboardController.php # Dashboard User
├── AdminDashboardController.php # Dashboard Admin
├── AdminUnitController.php     # Kelola Loker
└── [Controller lainnya]

app/Models/
├── User.php                    # Users table
├── Unit.php                    # Units/Locker table
├── Booking.php                 # Bookings table
├── Fine.php                    # Fines table
└── Category.php                # Categories table

resources/views/
├── auth/                       # Login & Register
├── Admin/                      # Admin pages
│   ├── dashboard.blade.php
│   ├── pemesanan.blade.php
│   ├── kelolaloker.blade.php
│   └── kelolapengguna.blade.php
├── User/                       # User pages
│   └── dashboard.blade.php
├── store-item.blade.php        # Pilih loker
├── payment.blade.php           # Pembayaran
├── my-items.blade.php          # Daftar barang
└── takeitem.blade.php          # Ambil barang
```

---

## 🎯 BEST PRACTICES

### **✅ DO:**
- Simpan file sesuai struktur MVC
- Gunakan namespace yang benar
- Organisir views berdasarkan modul/fitur
- Pisahkan controller berdasarkan tanggung jawab
- Gunakan migration untuk schema database

### **❌ DON'T:**
- Jangan edit file di `vendor/` atau `node_modules/`
- Jangan commit `.env` ke Git
- Jangan simpan file di `public/` selain yang perlu
- Jangan hardcode credentials di code (gunakan `.env`)

---

## 📊 SIZE & IMPORTANCE

| Folder | Size | Penting | Edit Frequency |
|--------|------|---------|----------------|
| `app/` | Medium | ⭐⭐⭐⭐⭐ | Very Often |
| `resources/views/` | Medium | ⭐⭐⭐⭐⭐ | Very Often |
| `routes/` | Small | ⭐⭐⭐⭐⭐ | Often |
| `database/migrations/` | Small | ⭐⭐⭐⭐ | Sometimes |
| `config/` | Small | ⭐⭐⭐ | Rarely |
| `public/` | Small | ⭐⭐⭐ | Rarely |
| `storage/` | Variable | ⭐⭐⭐ | Auto |
| `vendor/` | Large | ⭐⭐ | Never |
| `node_modules/` | Large | ⭐⭐ | Never |

---

## 🚀 COMMAND SUMMARY

```bash
# Development
php artisan serve            # Jalankan development server
npm run dev                  # Compile assets (watch mode)
php artisan migrate          # Run migrations
php artisan db:seed          # Seed database

# Build
npm run build                # Build assets untuk production
php artisan config:cache     # Cache config
php artisan route:cache      # Cache routes

# Maintenance
php artisan storage:link     # Create storage symlink
php artisan key:generate     # Generate APP_KEY
php artisan optimize         # Optimize application
```

---

**Struktur folder ini mengikuti standar Laravel dan best practices untuk pengembangan web application yang scalable dan maintainable.**

