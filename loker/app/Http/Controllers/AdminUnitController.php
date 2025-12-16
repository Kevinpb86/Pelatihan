<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;

class AdminUnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy('code')->get();
        return view('Admin.kelolaloker', compact('units'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:50|unique:units,code',
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'price_per_hour' => 'nullable|numeric|min:0',
        ]);

        $data['status'] = 'available';
        Unit::create($data);

        return redirect()->route('admin.kelolaloker.index')->with('success', 'Loker berhasil ditambahkan');
    }

    public function update(Request $request, Unit $unit)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'price_per_hour' => 'nullable|numeric|min:0',
        ]);

        $unit->update($data);

        return redirect()->route('admin.kelolaloker.index')->with('success', 'Data loker diperbarui');
    }

    public function updateStatus(Request $request, Unit $unit)
    {
        $data = $request->validate([
            'status' => 'required|in:available,booked,overdue',
        ]);

        $unit->update(['status' => $data['status']]);

        return redirect()->route('admin.kelolaloker.index')->with('success', 'Status loker diperbarui');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('admin.kelolaloker.index')->with('success', 'Loker berhasil dihapus');
    }
}

