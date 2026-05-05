<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use Illuminate\Http\Request;

class AreaParkirController extends Controller
{
    // Menampilkan semua data area
    public function index()
    {
        $areas = AreaParkir::all();
        return view('area.index', compact('areas'));
    }

    // Form tambah area
    public function create()
    {
        return view('area.create');
    }

    // Simpan area baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|unique:tb_area_parkir,nama_area',
            'kapasitas' => 'required|numeric|min:1',
        ]);

        AreaParkir::create([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
            'total' => 0, // awal masih kosong
        ]);

        return redirect()->route('area.index')->with('success', 'Area parkir berhasil ditambahkan');
    }

    // Form edit area
    public function edit($id)
    {
        $area = AreaParkir::findOrFail($id);
        return view('area.edit', compact('area'));
    }

    // Update area
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_area' => 'required|unique:tb_area_parkir,nama_area,' . $id . ',id_area',
            'kapasitas' => 'required|numeric|min:1',
        ]);

        $area = AreaParkir::findOrFail($id);
        $area->update([
            'nama_area' => $request->nama_area,
            'kapasitas' => $request->kapasitas,
        ]);

        return redirect()->route('area.index')->with('success', 'Area parkir berhasil diupdate');
    }

    // Hapus area
    public function destroy($id)
    {
        $area = AreaParkir::findOrFail($id);
        $area->delete();

        return redirect()->route('area.index')->with('success', 'Area parkir berhasil dihapus');
    }
}