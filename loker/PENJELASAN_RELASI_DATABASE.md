# PENJELASAN RELASI DATABASE YANG TERHUBUNG

Dokumen ini menjelaskan hubungan fungsional (relasi) antar tabel dalam sistem dengan contoh use case konkret yang diimplementasikan dalam kode.

**Catatan Penting:** Diagram ERD hanya menampilkan tabel-tabel bisnis (business entities). Tabel sistem internal Laravel seperti `migrations` tidak ditampilkan karena merupakan detail implementasi framework dan bukan bagian dari domain model bisnis.

---

## 1. RELASI USER → BOOKINGS (One-to-Many)

### Deskripsi
**User dapat melakukan banyak pemesanan (bookings)**, tetapi setiap booking hanya dimiliki oleh satu user.

### Implementasi di Kode

#### A. User Membuat Booking
**Lokasi:** `app/Http/Controllers/ItemController.php` (method `processPayment`)

```248:255:app/Http/Controllers/ItemController.php
        Booking::create([
            'user_id' => Auth::id(),
            'unit_id' => $unit->id,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'total_price' => $totalPrice,
            'status' => 'active',
        ]);
```

**Alur:**
1. User yang sudah login (`Auth::id()`) memilih unit dan melakukan pembayaran
2. Sistem membuat record baru di tabel `bookings` dengan `user_id` = ID user yang sedang login
3. Foreign key `user_id` menghubungkan booking dengan user yang membuatnya

#### B. User Melihat Booking Miliknya
**Lokasi:** `app/Http/Controllers/UserBookingController.php` (method `index`)

```16:19:app/Http/Controllers/UserBookingController.php
        $bookings = Booking::with('unit')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
```

**Alur:**
1. Sistem mengambil semua booking dimana `user_id` = ID user yang login
2. Relasi `hasMany` pada model User memungkinkan: `$user->bookings` untuk mendapatkan semua booking milik user tersebut

#### C. Model Relasi
**Lokasi:** `app/Models/User.php`

```57:59:app/Models/User.php
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
```

**Penggunaan:**
```php
$user = Auth::user();
$allBookings = $user->bookings; // Mengambil semua booking user
$activeBookings = $user->bookings()->where('status', 'active')->get();
```

---

## 2. RELASI USER → PASSWORD RESET (Self-Relation)

### Deskripsi
**User dapat mengganti password di bagian pengaturan** dengan memverifikasi password lama terlebih dahulu.

### Implementasi di Kode

#### A. User Mengubah Password
**Lokasi:** `app/Http/Controllers/AuthController.php` (method `updatePassword`)

```110:126:app/Http/Controllers/AuthController.php
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
```

**Alur:**
1. User mengakses halaman Settings (`/settings`)
2. User memasukkan password lama dan password baru
3. Sistem memverifikasi password lama dengan `Hash::check()` terhadap `users.password`
4. Jika valid, password baru di-hash dan di-update di tabel `users`
5. Relasi: User mengupdate dirinya sendiri (self-relation) di tabel `users`

#### B. Route Pengaturan Password
**Lokasi:** `routes/web.php`

```181:181:routes/web.php
Route::put('/settings/password', [AuthController::class, 'updatePassword'])->middleware('auth')->name('settings.password.update');
```

**Form di View:**
- Route form: `route('settings.password.update')`
- Method: `PUT`
- Middleware: `auth` (harus login)

---

## 3. RELASI BOOKING → FINE (One-to-Many)

### Deskripsi
**Satu booking dapat memiliki banyak fine (denda)** jika terjadi keterlambatan atau pelanggaran.

### Implementasi di Kode

#### A. User Membayar Fine
**Lokasi:** `app/Http/Controllers/ItemController.php` (method `payFine`)

```263:280:app/Http/Controllers/ItemController.php
    public function payFine($id)
    {
        $booking = Booking::with('fine')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        if (!$booking->fine) {
            return back()->with('error', 'Tidak ada denda untuk booking ini.');
        }

        // Update status fine menjadi dibayar
        $booking->fine->update([
            'paid' => true,
        ]);

        return back()->with('success', 'Denda berhasil dibayar. Anda sekarang bisa mengambil barang.');
    }
```

**Alur:**
1. User memiliki booking yang memiliki fine
2. Sistem mengambil booking beserta relasi fine-nya: `Booking::with('fine')`
3. Fine diupdate statusnya menjadi `paid = true`
4. Foreign key `fines.booking_id` menghubungkan fine dengan booking

#### B. Model Relasi
**Lokasi:** `app/Models/Booking.php`

```40:42:app/Models/Booking.php
    public function fine(){
        return $this->hasOne(Fine::class);
    }
```

**Penggunaan:**
```php
$booking = Booking::find(1);
if ($booking->fine) {
    echo "Total denda: " . $booking->fine->amount;
    echo "Status: " . ($booking->fine->paid ? "Lunas" : "Belum Lunas");
}
```

---

## 4. RELASI UNIT → BOOKINGS (One-to-Many)

### Deskripsi
**Satu unit (loker) dapat dipesan dalam banyak booking**, tetapi pada satu waktu hanya satu booking aktif.

### Implementasi di Kode

#### A. Cek Ketersediaan Unit
**Lokasi:** `app/Http/Controllers/ItemController.php` (method `processPayment`)

```226:233:app/Http/Controllers/ItemController.php
        $hasActiveBooking = Booking::where('unit_id', $unit->id)
            ->where('status', 'active')
            ->exists();

        if ($hasActiveBooking) {
            return redirect()->route('store-item')
                ->with('error', 'Loker yang dipilih tidak tersedia.');
        }
```

**Alur:**
1. Sebelum membuat booking, sistem mengecek apakah unit sudah memiliki booking aktif
2. Query: Mencari booking dengan `unit_id` yang sama dan status `active`
3. Jika ada, unit tidak tersedia untuk booking baru

#### B. Update Status Unit Setelah Booking
```257:257:app/Http/Controllers/ItemController.php
        $unit->update(['status' => 'booked']);
```

Setelah booking dibuat, status unit diubah menjadi `'booked'` untuk mencegah double booking.

#### C. Model Relasi
**Lokasi:** `app/Models/Unit.php`

```17:20:app/Models/Unit.php
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
```

---

## 5. RELASI UNIT ↔ CATEGORIES (Many-to-Many)

### Deskripsi
**Satu unit dapat memiliki banyak kategori**, dan **satu kategori dapat diterapkan pada banyak unit** melalui tabel pivot `unit_category`.

### Implementasi di Kode

#### A. Model Relasi Unit
**Lokasi:** `app/Models/Unit.php`

```25:29:app/Models/Unit.php
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'unit_category')
                    ->withTimestamps();
    }
```

#### B. Model Relasi Category
**Lokasi:** `app/Models/Category.php`

```17:21:app/Models/Category.php
    public function units()
    {
        return $this->belongsToMany(Unit::class, 'unit_category')
                    ->withTimestamps();
    }
```

**Penggunaan:**
```php
// Menambahkan kategori ke unit
$unit = Unit::find(1);
$unit->categories()->attach([1, 2, 3]); // ID kategori

// Mengambil semua kategori unit
$categories = $unit->categories;

// Mengambil semua unit dalam kategori
$category = Category::find(1);
$units = $category->units;
```

---

## 6. RELASI USER → SESSIONS (One-to-Many)

### Deskripsi
**Satu user dapat memiliki banyak sesi aktif** (misalnya login dari browser berbeda atau device berbeda).

### Implementasi
- Laravel secara otomatis menyimpan sesi di tabel `sessions`
- `sessions.user_id` dapat NULL untuk sesi tamu (guest)
- Saat user login, `sessions.user_id` diisi dengan ID user

**Contoh Query:**
```php
// Mengambil semua sesi aktif user
$sessions = \Illuminate\Support\Facades\DB::table('sessions')
    ->where('user_id', Auth::id())
    ->where('last_activity', '>', now()->subHours(2))
    ->get();
```

---

## RINGKASAN RELASI FUNGSIONAL

| Relasi | Tipe | Contoh Use Case |
|--------|------|-----------------|
| **User → Bookings** | One-to-Many | User membuat booking untuk menyimpan barang |
| **User → Users** (self) | Self-Relation | User mengubah password di settings |
| **Booking → Fine** | One-to-Many | Booking yang terlambat mendapat denda |
| **Unit → Bookings** | One-to-Many | Unit dapat dipesan berkali-kali (tidak bersamaan) |
| **Unit ↔ Categories** | Many-to-Many | Unit dapat memiliki beberapa kategori |
| **User → Sessions** | One-to-Many | User dapat login dari banyak device |

---

## ALUR INTEGRASI RELASI

### Contoh: Alur Lengkap User Menyimpan Barang

```
1. User Login
   └─> Relasi: User → Sessions (membuat sesi)

2. User Memilih Unit
   └─> Relasi: Unit → Bookings (cek ketersediaan)
   └─> Relasi: Unit ↔ Categories (tampilkan kategori unit)

3. User Membuat Booking
   └─> Relasi: User → Bookings (user_id)
   └─> Relasi: Unit → Bookings (unit_id)
   └─> Update: Unit.status = 'booked'

4. Jika Booking Terlambat
   └─> Relasi: Booking → Fine (membuat record fine)
   └─> User harus bayar fine sebelum ambil barang

5. User Ambil Barang
   └─> Update: Booking.status = 'completed'
   └─> Update: Unit.status = 'available'
```

### Contoh: Alur User Mengubah Password

```
1. User Login (Autentikasi)
   └─> Verifikasi: users.password vs input password

2. User Akses Settings
   └─> Route: /settings (middleware: auth)

3. User Mengubah Password
   └─> Verifikasi: Hash::check(current_password, users.password)
   └─> Update: users.password = Hash::make(new_password)
   └─> Self-relation: User mengupdate dirinya sendiri
```

---

## CATATAN PENTING

1. **Foreign Key Constraints:**
   - `bookings.user_id` → `users.id` (CASCADE)
   - `bookings.unit_id` → `units.id` (CASCADE)
   - `fines.booking_id` → `bookings.id` (CASCADE)

2. **Validasi Business Logic:**
   - User maksimal 2 booking aktif
   - Unit tidak bisa dipesan jika status 'booked'
   - Fine harus dibayar sebelum ambil barang

3. **Security:**
   - Password selalu di-hash sebelum disimpan
   - Middleware `auth` melindungi route yang memerlukan login
   - Verifikasi password lama sebelum update password baru

---

*Dokumen ini menjelaskan relasi database berdasarkan implementasi aktual di kode sistem.*

