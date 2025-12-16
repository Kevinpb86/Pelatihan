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
        User::updateOrCreate(
            ['email' => 'admin@locker.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );

        // Kategori
        $categories = ['Kecil', 'Sedang', 'Besar'];
        foreach ($categories as $cat) {
            Category::updateOrCreate(['name' => $cat]);
        }

        // Unit - Menambahkan 10 loker
        $units = [
            ['code' => 'A1', 'name' => 'Loker A1', 'location' => 'Gedung A', 'price_per_hour' => 5000],
            ['code' => 'A2', 'name' => 'Loker A2', 'location' => 'Gedung A', 'price_per_hour' => 5000],
            ['code' => 'A3', 'name' => 'Loker A3', 'location' => 'Gedung A', 'price_per_hour' => 5000],
            ['code' => 'B1', 'name' => 'Loker B1', 'location' => 'Gedung A', 'price_per_hour' => 6000],
            ['code' => 'B2', 'name' => 'Loker B2', 'location' => 'Gedung A', 'price_per_hour' => 6000],
            ['code' => 'B3', 'name' => 'Loker B3', 'location' => 'Gedung A', 'price_per_hour' => 6000],
            ['code' => 'C1', 'name' => 'Loker C1', 'location' => 'Gedung A', 'price_per_hour' => 7000],
            ['code' => 'C2', 'name' => 'Loker C2', 'location' => 'Gedung A', 'price_per_hour' => 7000],
            ['code' => 'C3', 'name' => 'Loker C3', 'location' => 'Gedung A', 'price_per_hour' => 7000],
            ['code' => 'C4', 'name' => 'Loker C4', 'location' => 'Gedung A', 'price_per_hour' => 8000],
        ];

        foreach ($units as $unitData) {
            Unit::updateOrCreate(
                ['code' => $unitData['code']],
                $unitData
            );
        }
    }
}
