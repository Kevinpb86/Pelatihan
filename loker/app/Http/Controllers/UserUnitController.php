<?php

namespace App\Http\Controllers;

use App\Models\Unit;

class UserUnitController extends Controller
{
    public function index()
    {
        $units = Unit::where('status', 'available')->get();
        return view('User.unit.index', compact('units'));
    }
}
