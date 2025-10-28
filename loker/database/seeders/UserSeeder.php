<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@loker.com',
            'password' => Hash::make('1234'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'test@loker.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
    }
}
