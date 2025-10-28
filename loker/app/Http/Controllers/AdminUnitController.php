<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class AdminUnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('Admin.unit.index', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:units,code',
            'name' => 'required',
            'location' => 'required',
            'price_per_day' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented',
        ]);

        $unit = Unit::create($request->all());

        return redirect()->route('Admin.unit.index')
            ->with('success', 'Unit berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $request->validate([
            'code' => 'required|unique:unit,code,' . $id,
            'name' => 'required',
            'location' => 'required',
            'price_per_day' => 'required|numeric|min:0',
            'status' => 'required|in:available,rented',
        ]);

        $unit->update($request->all());

        return redirect()->route('Admin.unit.index')
            ->with('success', 'Unit berhasil diperbarui');
    }

    public function destroy($id)
    {
        Unit::findOrFail($id)->delete();
        return redirect()->route('Admin.unit.index')
            ->with('success', 'Unit berhasil dihapus');
    }
}
