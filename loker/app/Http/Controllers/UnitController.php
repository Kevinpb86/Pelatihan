<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::where('status', 'available')->get();
        return view('units.index', compact('units'));
    }

    public function show(Unit $unit)
    {
        return view('units.show', compact('unit'));
    }
}
