# 🎯 PRESENTASI SISTEM MANAJEMEN LOKER (LOKERHUB)
## Platform Digital untuk Penyewaan Loker Self-Service

---

## 📋 DAFTAR ISI

1. [Executive Summary](#1-executive-summary)
2. [Overview Sistem](#2-overview-sistem)
3. [Teknologi Stack](#3-teknologi-stack)
4. [Arsitektur Sistem](#4-arsitektur-sistem)
5. [Database Design](#5-database-design)
6. [Fitur-Fitur Lengkap](#6-fitur-fitur-lengkap)
7. [User Journey & Flow](#7-user-journey--flow)
8. [Security Features](#8-security-features)
9. [Use Cases & Scenarios](#9-use-cases--scenarios)
10. [Kelebihan & Keunikan](#10-kelebihan--keunikan)
11. [Detail Halaman Aplikasi](#11-detail-halaman-aplikasi)
12. [Statistik & Analytics](#12-statistik--analytics)
13. [Future Enhancements](#13-future-enhancements)

---

## 1. EXECUTIVE SUMMARY

### 1.1 Visi & Misi
**Visi:** Menjadi platform digital terdepan untuk manajemen loker self-service yang efisien, mudah digunakan, dan dapat diandalkan.

**Misi:** 
- Memberikan solusi otomatis untuk penyewaan loker
- Meningkatkan efisiensi operasional melalui sistem digital
- Memberikan pengalaman pengguna yang seamless dan modern

### 1.2 Tujuan Sistem
- ✅ Mengotomasi proses penyewaan dan pengembalian loker
- ✅ Memberikan manajemen real-time untuk admin
- ✅ Menyediakan dashboard analitik untuk pengambilan keputusan
- ✅ Menerapkan sistem denda otomatis untuk keterlambatan
- ✅ Menyediakan berbagai metode pembayaran yang fleksibel

### 1.3 Target Pengguna
- **User (Pengguna Akhir):** Mahasiswa, pekerja, atau individu yang membutuhkan penyimpanan sementara
- **Admin (Administrator):** Staf pengelola loker yang bertanggung jawab atas operasional sistem

---

## 2. OVERVIEW SISTEM

### 2.1 Deskripsi Sistem
**LOKERHUB** adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola penyewaan loker secara digital. Sistem ini memungkinkan pengguna untuk:
- Mencari dan memilih loker yang tersedia
- Menyimpan barang dengan proses pembayaran online
- Melacak barang yang sedang dititipkan
- Mengambil barang dengan sistem pembayaran denda otomatis

Sistem ini juga memberikan kontrol penuh kepada admin untuk mengelola loker, pengguna, pemesanan, dan melihat laporan keuangan.

### 2.2 Jenis Aplikasi
- **Web Application** (Browser-based)
- **Role-based Access Control** (Admin & User)
- **Real-time Status Updates**
- **Payment Integration Ready**

### 2.3 Karakteristik Utama
1. **Self-Service:** Pengguna dapat melakukan semua transaksi sendiri
2. **Real-time:** Status loker update secara real-time
3. **Automated:** Sistem denda dan notifikasi otomatis
4. **Secure:** Multi-layer security dengan authentication & authorization
5. **Scalable:** Arsitektur yang dapat dikembangkan lebih lanjut

---

## 3. TEKNOLOGI STACK

### 3.1 Backend
| Teknologi | Versi | Keterangan |
|-----------|-------|------------|
| **PHP** | 8.2+ | Bahasa pemrograman utama |
| **Laravel Framework** | 12.0 | Framework web application |
| **Eloquent ORM** | Built-in | Object-Relational Mapping |
| **Carbon** | Built-in | Date & Time manipulation |

### 3.2 Frontend
| Teknologi | Keterangan |
|-----------|------------|
| **Blade Templating Engine** | Laravel's templating system |
| **Tailwind CSS** | Utility-first CSS framework |
| **JavaScript (Vanilla)** | Client-side interactivity |
| **Font Awesome 6.4.0** | Icon library |
| **Vite** | Modern frontend build tool |

### 3.3 Database
- **SQLite** (Development)
- **MySQL/PostgreSQL Ready** (Production-ready)

### 3.4 Development Tools
- **Composer** - PHP Dependency Manager
- **NPM** - JavaScript Package Manager
- **Git** - Version Control

---

## 4. ARSITEKTUR SISTEM

### 4.1 Arsitektur MVC (Model-View-Controller)

```
┌─────────────────────────────────────────────────────────────┐
│                        CLIENT (Browser)                      │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐     │
│  │   Views      │  │   JavaScript │  │     CSS      │     │
│  │  (Blade)     │  │              │  │  (Tailwind)  │     │
│  └──────────────┘  └──────────────┘  └──────────────┘     │
└─────────────────────────────────────────────────────────────┘
                            ↕ HTTP Request/Response
┌─────────────────────────────────────────────────────────────┐
│                    LARAVEL APPLICATION                       │
│  ┌────────────────────────────────────────────────────┐    │
│  │              ROUTES (web.php)                      │    │
│  │  - Authentication Middleware                       │    │
│  │  - Role-based Access Control                       │    │
│  └────────────────────────────────────────────────────┘    │
│                         ↕                                   │
│  ┌────────────────────────────────────────────────────┐    │
│  │            CONTROLLERS                             │    │
│  │  ┌─────────────┐  ┌─────────────┐  ┌──────────┐  │    │
│  │  │AuthController│  │ItemController│ │Admin...   │  │    │
│  │  └─────────────┘  └─────────────┘  └──────────┘  │    │
│  └────────────────────────────────────────────────────┘    │
│                         ↕                                   │
│  ┌────────────────────────────────────────────────────┐    │
│  │              MODELS (Eloquent)                     │    │
│  │  ┌──────┐  ┌──────┐  ┌──────┐  ┌──────┐  ┌─────┐ │    │
│  │  │ User │  │ Unit │  │Booking│  │ Fine │ │Cat..│ │    │
│  │  └──────┘  └──────┘  └──────┘  └──────┘  └─────┘ │    │
│  └────────────────────────────────────────────────────┘    │
│                         ↕                                   │
│  ┌────────────────────────────────────────────────────┐    │
│  │            DATABASE (SQLite/MySQL)                 │    │
│  │  ┌──────┐  ┌──────┐  ┌──────┐  ┌──────┐  ┌─────┐ │    │
│  │  │users │  │units │  │bookings│ │fines │ │cat..│ │    │
│  │  └──────┘  └──────┘  └──────┘  └──────┘  └─────┘ │    │
│  └────────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────────┘
```

### 4.2 Flow Request Response

```
1. User mengakses URL → Routes mengecek middleware
2. Routes memanggil Controller sesuai endpoint
3. Controller berinteraksi dengan Model
4. Model melakukan query ke Database
5. Data dikembalikan ke Controller
6. Controller mengirim data ke View (Blade)
7. Blade merender HTML dengan data
8. Response dikirim ke Client
```

### 4.3 Authentication Flow

```
┌──────────┐     ┌──────────┐     ┌──────────┐     ┌──────────┐
│   Login  │────▶│ Validate │────▶│   Auth   │────▶│ Redirect │
│   Form   │     │Credentials│     │  Session │     │Dashboard │
└──────────┘     └──────────┘     └──────────┘     └──────────┘
                                            │
                                            ▼
                                    ┌──────────────┐
                                    │ Check Role   │
                                    │ Admin/User   │
                                    └──────────────┘
                                    │         │
                            ┌───────┘         └───────┐
                            ▼                         ▼
                    ┌──────────────┐          ┌──────────────┐
                    │ Admin        │          │ User         │
                    │ Dashboard    │          │ Dashboard    │
                    └──────────────┘          └──────────────┘
```

---

## 5. DATABASE DESIGN

### 5.1 Entity Relationship Diagram (Konseptual)

```
┌──────────────┐         ┌──────────────┐         ┌──────────────┐
│     User     │         │    Booking   │         │     Unit     │
├──────────────┤         ├──────────────┤         ├──────────────┤
│ id (PK)      │◄──┐     │ id (PK)      │     ┌───│ id (PK)      │
│ name         │   │     │ user_id (FK) │     │   │ code         │
│ email        │   │     │ unit_id (FK) │──┐  │   │ name         │
│ password     │   │     │ start_time   │  │  │   │ location     │
│ role         │   │     │ end_time     │  │  │   │ price_per_hr │
│ avatar       │   │     │ total_price  │  │  │   │ status       │
│ phone        │   │     │ status       │  │  │   │ created_at   │
│ bio          │   │     │ created_at   │  │  │   │ updated_at   │
│ address      │   │     │ updated_at   │  │  │   └──────────────┘
│ created_at   │   │     └──────────────┘  │  │
│ updated_at   │   │            │           │  │
└──────────────┘   │            │           │  │
       │           │            │           │  │
       │           │            ▼           │  │
       │           │     ┌──────────────┐   │  │
       │           │     │     Fine     │   │  │
       │           │     ├──────────────┤   │  │
       │           │     │ id (PK)      │   │  │
       │           │     │ booking_id   │◄──┘  │
       │           │     │ amount       │      │
       │           │     │ paid         │      │
       │           │     │ created_at   │      │
       │           │     │ updated_at   │      │
       │           │     └──────────────┘      │
       │           │                           │
       └───────────┴───────────────────────────┘
              (One User has Many Bookings)
```

### 5.2 Detail Tabel Database

#### **Table: users**
| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PK, AI | Primary key |
| name | string(255) | NOT NULL | Nama pengguna |
| email | string(255) | UNIQUE, NOT NULL | Email (untuk login) |
| email_verified_at | timestamp | NULLABLE | Verifikasi email |
| password | string(255) | NOT NULL | Password (hashed) |
| role | enum | DEFAULT 'user' | Role: 'admin' atau 'user' |
| avatar | string(255) | NULLABLE | Path foto profil |
| phone | string(20) | NULLABLE | Nomor telepon |
| bio | text | NULLABLE | Bio pengguna |
| address | text | NULLABLE | Alamat |
| remember_token | string(100) | NULLABLE | Token remember |
| created_at | timestamp | | Waktu dibuat |
| updated_at | timestamp | | Waktu diupdate |

**Relationships:**
- `hasMany(Booking)` - Satu user dapat memiliki banyak booking

#### **Table: units**
| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PK, AI | Primary key |
| code | string | UNIQUE, NOT NULL | Kode loker (contoh: "LK-001") |
| name | string(255) | NOT NULL | Nama loker |
| location | string(255) | NULLABLE | Lokasi fisik loker |
| price_per_hour | decimal(10,2) | NOT NULL | Harga per jam |
| status | enum | DEFAULT 'available' | Status: available, booked, overdue, etc. |
| created_at | timestamp | | Waktu dibuat |
| updated_at | timestamp | | Waktu diupdate |

**Relationships:**
- `hasMany(Booking)` - Satu unit dapat memiliki banyak booking

#### **Table: bookings**
| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PK, AI | Primary key |
| user_id | bigint | FK → users.id, CASCADE | ID pengguna |
| unit_id | bigint | FK → units.id, CASCADE | ID unit/loker |
| start_time | datetime | NOT NULL | Waktu mulai sewa |
| end_time | datetime | NOT NULL | Waktu akhir sewa |
| total_price | decimal(10,2) | NOT NULL | Total harga pembayaran |
| status | enum | DEFAULT 'active' | Status: active, completed, overdue, cancelled |
| created_at | timestamp | | Waktu dibuat |
| updated_at | timestamp | | Waktu diupdate |

**Relationships:**
- `belongsTo(User)` - Setiap booking dimiliki oleh satu user
- `belongsTo(Unit)` - Setiap booking untuk satu unit
- `hasOne(Fine)` - Satu booking dapat memiliki satu denda

#### **Table: fines**
| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PK, AI | Primary key |
| booking_id | bigint | FK → bookings.id | ID booking terkait |
| amount | decimal(10,2) | NOT NULL | Jumlah denda |
| paid | boolean | DEFAULT false | Status pembayaran denda |
| created_at | timestamp | | Waktu dibuat |
| updated_at | timestamp | | Waktu diupdate |

**Relationships:**
- `belongsTo(Booking)` - Setiap denda terkait dengan satu booking

### 5.3 Indexing & Performance
- Primary keys di semua tabel
- Foreign keys dengan CASCADE delete
- Unique constraint pada `users.email` dan `units.code`
- Index pada kolom yang sering di-query:
  - `bookings.user_id`
  - `bookings.unit_id`
  - `bookings.status`

---

## 6. FITUR-FITUR LENGKAP

### 6.1 Fitur untuk USER (Pengguna)

#### ✅ **6.1.1 Autentikasi & Profil**
- **Login** - Autentikasi dengan email & password
- **Register** - Pendaftaran akun baru (otomatis role 'user')
- **Remember Me** - Fitur untuk tetap login
- **Update Profil** - Edit nama, email, phone, bio, address
- **Upload Avatar** - Upload dan update foto profil
- **Ganti Password** - Update password dengan validasi

#### ✅ **6.1.2 Dashboard User**
- **Statistik Ringkas:**
  - Total barang yang sedang dititipkan
  - Jumlah loker terisi
  - Barang yang akan berakhir (expiring soon)
  - Jumlah loker kosong yang tersedia
- **Aktivitas Terbaru:**
  - Timeline aktivitas (booking dibuat, barang diambil, pengingat)
  - Icon dan warna untuk setiap jenis aktivitas
- **Status Loker Real-time:**
  - Visualisasi semua loker dengan status:
    - 🟢 **Available** (Kosong/Tersedia)
    - 🔴 **Occupied** (Terisi)
    - 🔵 **Reserved** (Dipesan)
    - 🟡 **Maintenance** (Perawatan)
- **Barang Terbaru** - Daftar 5 barang terakhir yang dititipkan

#### ✅ **6.1.3 Simpan Barang (Store Item)**
- **Pilih Loker:**
  - Tampilan grid semua loker dengan status real-time
  - Filter berdasarkan status (available, occupied, maintenance)
  - Visual indicator untuk setiap loker
- **Form Input:**
  - Nama barang
  - Kategori barang
  - Durasi penyewaan (jam)
  - Validasi input
- **Validasi Ketersediaan:**
  - Sistem memastikan loker yang dipilih benar-benar tersedia
  - Mencegah double booking

#### ✅ **6.1.4 Pembayaran (Payment)**
- **Ringkasan Pemesanan:**
  - Detail loker yang dipilih
  - Informasi barang
  - Durasi penyewaan
  - Waktu mulai dan akhir
  - Total harga (harga/jam × durasi)
- **Metode Pembayaran:**
  - 🏦 **QRIS** (Default)
  - 🏛️ **Transfer Bank** (BCA)
  - 💰 **DANA**
  - 💜 **OVO**
  - 🟢 **GoPay**
- **Proses Pembayaran:**
  - Validasi harga
  - Pembuatan booking otomatis setelah pembayaran
  - Update status loker menjadi 'booked'

#### ✅ **6.1.5 Daftar Barang Saya (My Items)**
- **List Booking Aktif:**
  - Nama barang
  - Kode loker
  - Status (Terisi/Kosong)
  - Waktu update terakhir
  - Waktu mulai dan akhir
  - Total harga
- **Aksi:**
  - Lihat detail
  - Ambil barang
  - Bayar denda (jika ada)

#### ✅ **6.1.6 Ambil Barang (Take Item)**
- **Detail Booking:**
  - Informasi lengkap barang
  - Kode dan lokasi loker
  - Waktu mulai dan akhir sewa
  - Total harga pembayaran
- **Sistem Denda Otomatis:**
  - Cek apakah melewati `end_time`
  - Hitung denda otomatis:
    ```
    Denda = (Waktu Terlambat dalam Jam) × Rp 5.000
    ```
  - Tampilkan notifikasi denda jika terlambat
- **Proses Pengambilan:**
  - Update status booking menjadi 'completed' atau 'overdue'
  - Update status loker menjadi 'available'
  - Redirect ke "My Items" dengan notifikasi

#### ✅ **6.1.7 Bayar Denda**
- **Notifikasi Denda:**
  - Tampil otomatis jika booking terlambat
  - Detail jumlah denda
  - Tombol "Bayar Denda"
- **Proses Pembayaran:**
  - Update status fine menjadi 'paid'
  - User dapat mengambil barang setelah membayar denda

### 6.2 Fitur untuk ADMIN

#### ✅ **6.2.1 Dashboard Admin**
- **Statistik Komprehensif:**
  - **Total Pengguna** (hanya user biasa, bukan admin)
    - Growth percentage vs bulan lalu
  - **Total Pemesanan**
    - Growth percentage vs bulan lalu
  - **Status Unit/Loker:**
    - Total unit
    - Unit tersedia
    - Unit terisi
    - Unit maintenance
  - **Pendapatan Bulan Ini:**
    - Total revenue bulan ini
    - Growth percentage vs bulan lalu
- **Pemesanan Terbaru:**
  - List 5 booking terbaru dengan detail user dan unit
- **Alert & Notifikasi:**
  - Unit yang akan berakhir (expiring soon)
  - Booking yang perlu perhatian

#### ✅ **6.2.2 Kelola Pemesanan (Bookings Management)**
- **List Semua Pemesanan:**
  - Tabel dengan pagination (10/25/50 per halaman)
  - Informasi: User, Unit, Waktu, Status, Harga
- **Filter & Search:**
  - Search berdasarkan nama/email user
  - Search berdasarkan kode/nama unit
  - Filter berdasarkan status
- **CRUD Operations:**
  - **Create** - Buat pemesanan baru (untuk user tertentu)
  - **Read** - Lihat detail pemesanan lengkap
  - **Update** - Edit informasi pemesanan
  - **Delete** - Hapus pemesanan
- **Detail Pemesanan:**
  - Informasi lengkap user
  - Detail unit/loker
  - Timeline booking
  - Status fine (jika ada)

#### ✅ **6.2.3 Kelola Loker (Units Management)**
- **List Semua Loker:**
  - Tabel dengan semua unit
  - Kolom: Code, Name, Location, Price/Hour, Status
- **CRUD Operations:**
  - **Create** - Tambah loker baru
    - Validasi: code harus unique
    - Set default status 'available'
  - **Update** - Edit informasi loker (name, location, price)
  - **Update Status** - Ubah status (available, booked, overdue)
  - **Delete** - Hapus loker (dengan validasi jika ada booking aktif)
- **Validasi:**
  - Code harus unique
  - Price per hour harus numeric dan >= 0

#### ✅ **6.2.4 Kelola Pengguna (Users Management)**
- **List Semua Pengguna:**
  - Tabel dengan pagination
  - Informasi: Name, Email, Role, Created At
- **Filter & Search:**
  - Search berdasarkan nama/email
  - Filter berdasarkan role (admin/user)
- **CRUD Operations:**
  - **Create** - Buat akun pengguna baru
    - Input: name, email, password, role
    - Password otomatis di-hash
  - **Update** - Edit informasi pengguna
    - Password optional (jika kosong, tidak diupdate)
    - Validasi email unique (kecuali untuk user yang sama)
  - **Delete** - Hapus pengguna
    - Proteksi: Admin tidak bisa hapus akun sendiri
- **Role Management:**
  - Set role: 'admin' atau 'user'
  - Hanya admin yang bisa akses halaman ini

#### ✅ **6.2.5 Analytics & Reporting**
- **Revenue Tracking:**
  - Pendapatan bulan ini vs bulan lalu
  - Growth calculation
- **User Growth:**
  - Total user vs bulan lalu
  - Percentage growth
- **Booking Analytics:**
  - Total booking vs bulan lalu
  - Percentage growth
- **Unit Utilization:**
  - Percentage penggunaan loker
  - Unit yang paling sering digunakan (dapat dikembangkan)

---

## 7. USER JOURNEY & FLOW

### 7.1 User Journey - Menyimpan Barang

```
1. USER LOGIN
   ↓
2. DASHBOARD USER
   - Lihat statistik
   - Lihat status loker
   ↓
3. KLIK "Simpan Barang" / Navigate ke /store-item
   ↓
4. PILIH LOKER
   - Lihat grid loker dengan status real-time
   - Pilih loker yang "Available" (hijau)
   ↓
5. ISI FORM
   - Nama barang
   - Kategori barang
   - Durasi (jam)
   - Submit form
   ↓
6. VALIDASI KETERSEDIAAN
   - Sistem cek apakah loker masih tersedia
   - Jika tidak tersedia → Error, kembali ke step 4
   ↓
7. HALAMAN PEMBAYARAN
   - Review detail pemesanan
   - Pilih metode pembayaran (QRIS/Bank/DANA/OVO/GoPay)
   - Konfirmasi total harga
   ↓
8. PROSES PEMBAYARAN
   - Submit pembayaran
   - Sistem validasi harga
   - Sistem create booking dengan status 'active'
   - Update status unit menjadi 'booked'
   ↓
9. NOTIFIKASI SUKSES
   - Redirect ke /my-items
   - Tampilkan pesan sukses
   - Booking muncul di list "My Items"
```

### 7.2 User Journey - Mengambil Barang

```
1. DASHBOARD USER / MY ITEMS
   ↓
2. PILIH BARANG YANG INGIN DIAMBIL
   - Klik "Lihat Detail" atau "Ambil Barang"
   ↓
3. HALAMAN DETAIL BARANG
   - Lihat informasi lengkap booking
   - Lihat waktu mulai dan akhir
   ↓
4. CEK KETERLAMBATAN
   - Sistem otomatis cek: waktu sekarang vs end_time
   ↓
5A. JIKA TIDAK TELAT:
    - Klik "Ambil Barang"
    - Update booking status: 'completed'
    - Update unit status: 'available'
    - Redirect ke /my-items dengan notifikasi sukses
    
5B. JIKA TELAT:
    - Sistem hitung denda otomatis
    - Tampilkan notifikasi denda
    - Create record Fine dengan amount = (jam telat × Rp 5.000)
    - User harus bayar denda terlebih dahulu
    ↓
6. BAYAR DENDA (jika telat)
   - Klik "Bayar Denda"
   - Update fine status: paid = true
   ↓
7. AMBIL BARANG
   - Update booking status: 'overdue' → 'completed'
   - Update unit status: 'available'
   - Redirect ke /my-items
```

### 7.3 Admin Journey - Kelola Sistem

```
1. ADMIN LOGIN
   ↓
2. DASHBOARD ADMIN
   - Lihat statistik lengkap
   - Lihat pemesanan terbaru
   - Lihat alert & notifikasi
   ↓
3. KELOLA PEMESANAN
   - Search/Filter pemesanan
   - View detail pemesanan
   - Create/Update/Delete pemesanan
   ↓
4. KELOLA LOKER
   - View semua loker
   - Tambah loker baru
   - Edit informasi loker
   - Update status loker
   - Hapus loker
   ↓
5. KELOLA PENGGUNA
   - View semua pengguna
   - Search/Filter pengguna
   - Tambah pengguna baru
   - Edit pengguna
   - Set role (admin/user)
   - Hapus pengguna
```

---

## 8. SECURITY FEATURES

### 8.1 Authentication & Authorization

#### **8.1.1 Password Security**
- ✅ Password di-hash menggunakan bcrypt
- ✅ Minimum 8 karakter untuk password baru
- ✅ Password confirmation pada registrasi
- ✅ Validasi password saat ganti password
- ✅ Password tidak ditampilkan di response API

#### **8.1.2 Session Management**
- ✅ Laravel session security
- ✅ Session regeneration setelah login
- ✅ Remember token untuk "Remember Me"
- ✅ Session invalidation pada logout
- ✅ CSRF protection pada semua form

#### **8.1.3 Role-Based Access Control (RBAC)**
- ✅ Middleware authentication pada routes protected
- ✅ Role check untuk akses admin area
- ✅ Redirect berdasarkan role setelah login
- ✅ Proteksi: Admin tidak bisa hapus akun sendiri

### 8.2 Input Validation

#### **8.2.1 Server-Side Validation**
- ✅ Validasi semua input di Controller
- ✅ Validasi email format & uniqueness
- ✅ Validasi numeric untuk harga
- ✅ Validasi date untuk waktu booking
- ✅ Validasi file upload (avatar: image, max 5MB)

#### **8.2.2 SQL Injection Prevention**
- ✅ Menggunakan Eloquent ORM (parameterized queries)
- ✅ Tidak ada raw SQL query yang tidak aman
- ✅ Foreign key constraints

### 8.3 Data Protection

#### **8.3.1 Data Access Control**
- ✅ User hanya bisa lihat booking milik sendiri
- ✅ User tidak bisa akses data user lain
- ✅ Admin memiliki akses penuh (dengan validasi)

#### **8.3.2 File Upload Security**
- ✅ Validasi file type (hanya image)
- ✅ Validasi file size (max 5MB)
- ✅ File disimpan di storage yang aman
- ✅ Old file dihapus saat update avatar

### 8.4 Business Logic Security

#### **8.4.1 Booking Validation**
- ✅ Validasi loker tersedia sebelum create booking
- ✅ Validasi harga (cegah manipulation)
- ✅ Validasi waktu (end_time > start_time)
- ✅ Mencegah double booking untuk unit yang sama

#### **8.4.2 Fine Calculation**
- ✅ Denda dihitung server-side (bukan client-side)
- ✅ Denda otomatis, tidak bisa diubah manual
- ✅ History denda tersimpan di database

---

## 9. USE CASES & SCENARIOS

### 9.1 Use Case 1: Mahasiswa Menyimpan Laptop

**Actor:** Mahasiswa (User)
**Goal:** Menyimpan laptop sementara saat kuliah

**Scenario:**
1. Mahasiswa login ke sistem
2. Lihat dashboard, cari loker yang tersedia
3. Pilih loker "LK-015" yang statusnya "Available"
4. Isi form: Nama: "Laptop Asus", Kategori: "Elektronik", Durasi: 4 jam
5. Sistem hitung harga: Rp 10.000/jam × 4 jam = Rp 40.000
6. Pilih pembayaran QRIS
7. Bayar dan booking dibuat
8. Laptop disimpan di loker LK-015
9. Mahasiswa dapat melanjutkan aktivitas

**Post-condition:**
- Booking aktif dengan status 'active'
- Loker LK-015 status menjadi 'booked'
- User dapat lihat di "My Items"

---

### 9.2 Use Case 2: Karyawan Mengambil Barang yang Terlambat

**Actor:** Karyawan (User)
**Goal:** Mengambil barang yang sudah melewati waktu sewa

**Scenario:**
1. Karyawan login dan buka "My Items"
2. Lihat ada barang yang seharusnya diambil 2 jam yang lalu
3. Klik "Lihat Detail" pada booking tersebut
4. Sistem otomatis detect keterlambatan
5. Sistem hitung denda: 2 jam × Rp 5.000 = Rp 10.000
6. Sistem create record Fine
7. Tampilkan notifikasi denda
8. User klik "Bayar Denda"
9. Status fine menjadi 'paid'
10. User klik "Ambil Barang"
11. Booking status update menjadi 'completed'
12. Loker menjadi 'available'

**Post-condition:**
- Fine telah dibayar
- Barang berhasil diambil
- Loker tersedia kembali

---

### 9.3 Use Case 3: Admin Menambah Loker Baru

**Actor:** Admin
**Goal:** Menambahkan loker baru ke sistem

**Scenario:**
1. Admin login
2. Navigate ke "Kelola Loker"
3. Klik "Tambah Loker Baru"
4. Isi form:
   - Code: "LK-050"
   - Name: "Loker Besar"
   - Location: "Lantai 2, Blok A"
   - Price per Hour: Rp 12.000
5. Submit form
6. Sistem validasi: code harus unique
7. Loker baru dibuat dengan status 'available'
8. Loker muncul di list dan tersedia untuk booking

**Post-condition:**
- Loker baru tersedia di sistem
- User dapat memilih loker baru ini saat menyimpan barang

---

### 9.4 Use Case 4: Admin Melihat Laporan Pendapatan

**Actor:** Admin
**Goal:** Melihat statistik pendapatan bulan ini

**Scenario:**
1. Admin login
2. Lihat Dashboard Admin
3. Sistem menampilkan:
   - Total Pendapatan Bulan Ini: Rp 2.500.000
   - Pendapatan Bulan Lalu: Rp 2.000.000
   - Growth: +25%
4. Admin dapat melihat breakdown lebih detail dengan:
   - Lihat "Kelola Pemesanan"
   - Filter berdasarkan tanggal
   - Export data (dapat dikembangkan)

**Post-condition:**
- Admin memiliki informasi pendapatan yang akurat
- Dapat membuat keputusan bisnis berdasarkan data

---

## 10. KELEBIHAN & KEUNIKAN

### 10.1 Kelebihan Sistem

#### **🚀 Otomatisasi Penuh**
- Proses penyewaan sepenuhnya otomatis
- Sistem denda otomatis
- Update status real-time
- Tidak perlu intervensi manual

#### **📊 Real-time Status**
- Status loker update secara real-time
- Visual indicator yang jelas (warna & icon)
- Mencegah konflik booking

#### **💰 Multiple Payment Methods**
- Mendukung 5 metode pembayaran
- Fleksibel untuk berbagai preferensi user
- Siap integrasi payment gateway

#### **🔒 Security yang Kuat**
- Multi-layer security (authentication, authorization, validation)
- Password hashing
- CSRF protection
- Role-based access control

#### **📱 User-Friendly Interface**
- UI modern dengan Tailwind CSS
- Responsive design
- Smooth animations
- Intuitive navigation

#### **📈 Analytics & Reporting**
- Dashboard dengan statistik lengkap
- Growth tracking
- Revenue analytics
- User & booking insights

### 10.2 Keunikan Sistem

#### **🎯 Self-Service Model**
- User dapat melakukan semua transaksi sendiri
- Mengurangi beban admin
- Tersedia 24/7 (jika server aktif)

#### **⚡ Automatic Fine Calculation**
- Denda dihitung otomatis berdasarkan keterlambatan
- Transparent: User tahu berapa denda yang harus dibayar
- Mencegah dispute

#### **🔄 Real-time Locker Availability**
- Status loker update real-time berdasarkan booking aktif
- Mencegah double booking
- User selalu tahu loker mana yang tersedia

#### **👥 Dual Role System**
- Admin dan User dengan akses berbeda
- Admin memiliki kontrol penuh
- User memiliki akses terbatas sesuai kebutuhan

---

## 11. DETAIL HALAMAN APLIKASI

### 11.1 Halaman Login (`/login`)

**Deskripsi:**
Halaman autentikasi pertama yang dilihat user. Desain modern dengan gradient background dan form yang user-friendly.

**Fitur:**
- Form login dengan email & password
- Toggle show/hide password
- Remember Me checkbox
- Link "Lupa Password?" (dapat dikembangkan)
- Link "Daftar sekarang" untuk registrasi
- Error handling & validation messages
- Responsive design

**Element UI:**
- Gradient background (slate-blue-indigo)
- Logo dengan animation
- Card dengan backdrop blur
- Icon pada input field
- Smooth transitions

---

### 11.2 Dashboard User (`/dashboard` - untuk user)

**Deskripsi:**
Halaman utama user setelah login. Menampilkan overview aktivitas, statistik, dan status loker.

**Sections:**

1. **Header/Navigation:**
   - Logo & nama aplikasi
   - Menu: Dashboard, Simpan Barang, Barang Saya, Pengaturan, Logout
   - Profile dropdown dengan avatar

2. **Statistik Cards (4 cards):**
   - Total Barang (booking aktif)
   - Loker Terisi
   - Akan Berakhir (expiring soon)
   - Loker Kosong

3. **Aktivitas Terbaru:**
   - Timeline aktivitas (10 terbaru)
   - Icon & warna per jenis aktivitas
   - Timestamp dengan relative time

4. **Status Loker Real-time:**
   - Grid semua loker
   - Color coding:
     - 🟢 Hijau: Available
     - 🔴 Merah: Occupied
     - 🔵 Biru: Reserved
     - 🟡 Kuning: Maintenance
   - Hover effect & animations

5. **Barang Terbaru:**
   - List 5 booking aktif terbaru
   - Quick action: Lihat detail

---

### 11.3 Simpan Barang (`/store-item`)

**Deskripsi:**
Halaman untuk memilih loker dan mengisi form informasi barang.

**Sections:**

1. **Grid Loker:**
   - Tampilan grid semua loker
   - Status indicator per loker
   - Filter berdasarkan status
   - Click untuk select loker

2. **Form Input:**
   - Nama barang (text input)
   - Kategori barang (dropdown/select)
   - Durasi (number input, dalam jam)
   - Validasi client-side & server-side

3. **Summary:**
   - Preview informasi sebelum submit
   - Estimasi harga

---

### 11.4 Pembayaran (`/payment`)

**Deskripsi:**
Halaman konfirmasi dan pembayaran sebelum booking dibuat.

**Sections:**

1. **Stepper/Progress:**
   - Step 1: Pilih Loker ✓
   - Step 2: Isi Form ✓
   - Step 3: Pembayaran (current)

2. **Ringkasan Pemesanan:**
   - Informasi loker (code, name, location)
   - Informasi barang (name, category)
   - Durasi penyewaan
   - Waktu mulai & akhir
   - Harga per jam
   - **Total harga**

3. **Metode Pembayaran:**
   - Grid pilihan: QRIS, Bank, DANA, OVO, GoPay
   - Active state dengan visual feedback
   - Detail per metode:
     - QRIS: QR code display
     - Bank: Rekening info
     - E-wallet: Nominal info

4. **Action Buttons:**
   - "Bayar & Titip Sekarang" (primary)
   - "Kembali" (secondary)

---

### 11.5 My Items (`/my-items`)

**Deskripsi:**
Halaman daftar semua barang yang sedang dititipkan user.

**Sections:**

1. **Header:**
   - Title "Barang Saya"
   - Count badge (jumlah booking aktif)

2. **List Items:**
   - Card per booking
   - Informasi:
     - Nama barang
     - Kode loker
     - Status
     - Waktu update
     - Start time & end time
     - Total price
   - Action buttons:
     - "Lihat Detail"
     - "Ambil Barang"

3. **Empty State:**
   - Message jika tidak ada booking aktif
   - CTA: "Simpan Barang Sekarang"

---

### 11.6 Detail & Ambil Barang (`/take-item/{id}`)

**Deskripsi:**
Halaman detail booking dan form untuk mengambil barang.

**Sections:**

1. **Booking Information:**
   - Detail lengkap booking
   - Informasi user
   - Informasi unit/loker
   - Timeline: start time → end time
   - Status booking

2. **Fine Information (jika telat):**
   - Alert/Notification denda
   - Jumlah denda
   - Waktu keterlambatan
   - Tombol "Bayar Denda" (jika belum dibayar)

3. **Action Buttons:**
   - "Ambil Barang" (primary)
   - "Kembali" (secondary)

---

### 11.7 Dashboard Admin (`/admin/dashboard`)

**Deskripsi:**
Halaman utama admin dengan statistik komprehensif.

**Sections:**

1. **Navigation Sidebar:**
   - Dashboard
   - Kelola Pemesanan
   - Kelola Loker
   - Kelola Pengguna
   - Logout

2. **Statistik Cards (6 cards):**
   - Total Pengguna (dengan growth %)
   - Total Pemesanan (dengan growth %)
   - Total Unit
   - Unit Tersedia
   - Unit Terisi
   - Unit Maintenance
   - Pendapatan Bulan Ini (dengan growth %)

3. **Pemesanan Terbaru:**
   - Table dengan 5 booking terbaru
   - Column: User, Unit, Waktu, Status, Harga
   - Link ke detail

4. **Alert/Notifications:**
   - Unit yang akan berakhir
   - Booking yang perlu perhatian

---

### 11.8 Kelola Pemesanan (`/admin/bookings`)

**Deskripsi:**
Halaman manajemen semua pemesanan oleh admin.

**Features:**
- Search bar (by user name/email atau unit code/name)
- Filter by status
- Pagination (10/25/50 per page)
- Table dengan columns:
  - ID
  - User (name, email)
  - Unit (code, name)
  - Start Time
  - End Time
  - Total Price
  - Status
  - Actions (View, Edit, Delete)

**Actions:**
- Create new booking (modal/form)
- View detail booking
- Edit booking
- Delete booking

---

### 11.9 Kelola Loker (`/admin/kelolaloker`)

**Deskripsi:**
Halaman CRUD untuk mengelola loker.

**Features:**
- Table semua loker
- Columns: Code, Name, Location, Price/Hour, Status, Actions
- Create form (modal):
  - Code (unique)
  - Name
  - Location
  - Price per Hour
- Edit form (inline atau modal)
- Update status (dropdown)
- Delete dengan confirmation

---

### 11.10 Kelola Pengguna (`/admin/kelolapengguna`)

**Deskripsi:**
Halaman manajemen semua pengguna sistem.

**Features:**
- Search bar (by name/email)
- Filter by role (admin/user)
- Pagination
- Table dengan columns:
  - Name
  - Email
  - Role
  - Created At
  - Actions
- Create form:
  - Name, Email, Password, Role
- Edit form:
  - Name, Email, Password (optional), Role
- Delete dengan proteksi (tidak bisa hapus akun sendiri)

---

### 11.11 Settings (`/settings`)

**Deskripsi:**
Halaman pengaturan profil dan password user.

**Sections:**

1. **Update Profile Tab:**
   - Form: Name, Email, Phone, Bio, Address
   - Avatar upload (dengan preview)
   - Validasi & error handling

2. **Change Password Tab:**
   - Form: Current Password, New Password, Confirm Password
   - Validasi password saat ini
   - Validasi password baru (min 8 karakter)

---

## 12. STATISTIK & ANALYTICS

### 12.1 Metrik yang Dilacak

#### **Untuk User:**
- Total barang yang dititipkan
- Jumlah loker terisi
- Barang yang akan berakhir
- Loker kosong tersedia

#### **Untuk Admin:**
- Total pengguna (dengan growth %)
- Total pemesanan (dengan growth %)
- Unit utilization (tersedia/terisi/maintenance)
- Pendapatan bulan ini (dengan growth %)
- Pemesanan terbaru
- Unit yang akan berakhir

### 12.2 Growth Calculation

**Formula Growth:**
```
Growth % = ((Current Period - Previous Period) / Previous Period) × 100
```

**Example:**
- Pendapatan bulan ini: Rp 2.500.000
- Pendapatan bulan lalu: Rp 2.000.000
- Growth = ((2.500.000 - 2.000.000) / 2.000.000) × 100 = +25%

### 12.3 Revenue Calculation

**Formula:**
```
Total Revenue = Sum of all bookings.total_price where status = 'active' or 'completed'
Monthly Revenue = Sum of bookings.total_price where created_at in current month
```

---

## 13. FUTURE ENHANCEMENTS

### 13.1 Fitur yang Dapat Dikembangkan

#### **🔔 Notifikasi & Alert**
- Email notification untuk:
  - Booking confirmation
  - Reminder sebelum berakhir
  - Fine notification
- Push notification (jika dibuat mobile app)
- SMS notification untuk alert penting

#### **💳 Payment Gateway Integration**
- Integrasi dengan payment gateway real (Midtrans, Doku, dll)
- Webhook untuk payment confirmation
- Payment status tracking
- Refund mechanism

#### **📱 Mobile Application**
- Native mobile app (iOS/Android)
- QR code scanner untuk pembayaran
- Push notifications
- Biometric authentication

#### **📊 Advanced Analytics**
- Revenue by period (daily, weekly, monthly, yearly)
- Popular unit/loker analysis
- User behavior analytics
- Peak hours analysis
- Export report (PDF/Excel)

#### **🔍 Advanced Search & Filter**
- Filter booking by date range
- Sort by various columns
- Export filtered data
- Advanced search dengan multiple criteria

#### **📝 History & Audit Log**
- Complete booking history
- User activity log
- Admin action log
- Audit trail untuk security

#### **🎫 Reservation System**
- Pre-booking/Reservation
- Waiting list untuk loker popular
- Auto-assign loker jika preferred tidak tersedia

#### **⭐ Rating & Review**
- User dapat rate pengalaman
- Review/Feedback system
- Admin dapat lihat feedback

#### **🔐 Two-Factor Authentication (2FA)**
- SMS/Email OTP
- Google Authenticator integration
- Enhanced security

#### **🌐 Multi-language Support**
- Bahasa Indonesia & Inggris (sudah ada sebagian)
- Bahasa lainnya jika diperlukan

#### **📧 Email System**
- Email verification
- Password reset via email
- Newsletter/Announcement

#### **🔗 API Integration**
- RESTful API untuk mobile app
- Third-party integration
- Webhook support

---

## 📝 KESIMPULAN

### Poin-Poin Penting Presentasi:

1. **Sistem yang Lengkap & Terintegrasi**
   - Semua fitur essential untuk manajemen loker
   - Flow yang jelas dan user-friendly

2. **Teknologi Modern**
   - Laravel 12 (latest)
   - Modern frontend stack
   - Best practices

3. **Scalable & Maintainable**
   - MVC architecture
   - Clean code structure
   - Easy to extend

4. **Secure**
   - Multiple security layers
   - Role-based access
   - Data protection

5. **User-Centric Design**
   - Intuitive interface
   - Real-time feedback
   - Smooth experience

6. **Business-Ready**
   - Payment ready
   - Analytics & reporting
   - Admin tools

---

## 📞 INFORMASI TEKNIS

### System Requirements:
- PHP 8.2+
- Composer
- Node.js & NPM (untuk frontend assets)
- SQLite (development) atau MySQL/PostgreSQL (production)
- Web server (Apache/Nginx)

### Installation:
```bash
composer install
npm install
php artisan key:generate
php artisan migrate
npm run build
php artisan serve
```

### Default Credentials:
- Admin: (dibuat melalui seeder atau manual)
- User: Daftar melalui halaman register

---

**Dokumen ini mencakup semua aspek sistem untuk keperluan presentasi yang komprehensif.**

