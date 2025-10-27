<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; // ✅ Tambahkan ini
use Illuminate\Database\Console\Seeds\WithoutModelEvents; // ✅ Tambahkan ini

use App\Models\User;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@locker.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Kategori
        $categories = ['Kecil', 'Sedang', 'Besar'];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }

        // Unit
        Unit::create([
            'code' => 'LK001',
            'name' => 'Loker Kecil 1',
            'location' => 'Gedung A',
            'price_per_day' => 5000
        ]);

        Unit::create([
            'code' => 'LK002',
            'name' => 'Loker Sedang 1',
            'location' => 'Gedung A',
            'price_per_day' => 8000
        ]);
    }
}
