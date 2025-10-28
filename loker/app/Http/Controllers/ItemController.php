<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        // contoh data sementara — sesuaikan dengan model/DB Anda
        $items = [
            ['name' => 'Helm Motor', 'locker' => 'A-15', 'updated' => '2 jam lalu', 'status' => 'Terisi', 'icon' => 'fas fa-helmet-safety'],
            ['name' => 'Tas Laptop', 'locker' => 'B-08', 'updated' => '5 jam lalu', 'status' => 'Terisi', 'icon' => 'fas fa-briefcase'],
            ['name' => 'Tas Belanja', 'locker' => 'C-12', 'updated' => '1 hari lalu', 'status' => 'Terisi', 'icon' => 'fas fa-shopping-bag'],
        ];

        // jika nanti ada relasi: $items = auth()->user()->items()->latest()->get();

        return view('my-items', compact('items'));
    }
}