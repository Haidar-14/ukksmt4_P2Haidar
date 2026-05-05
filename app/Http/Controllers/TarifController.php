<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    // Tampilkan semua tarif
    public function index()
    {
        $tarifs = Tarif::all();
        return view('tarif.index', compact('tarifs'));
    }

    // Form tambah tarif
    public function create()
    {
        return view('tarif.create');
    }

    // Simpan tarif baru
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'tarif_per_jam' => 'required|numeric|min:0', // meulai nomor dari 0
            'tarif_maksimal_harian' => 'nullable|numeric|min:0', // isi nya pke angka
        ]);

        Tarif::create($request->all());

        return redirect()->route('tarif.index')->with('success', 'Tarif berhasil ditambahkan');
    }

    // Form edit tarif
    public function edit($id)
    {
        $tarif = Tarif::findOrFail($id);
        return view('tarif.edit', compact('tarif'));
    }

    // Update tarif
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'tarif_per_jam' => 'required|numeric|min:0',
            'tarif_maksimal_harian' => 'nullable|numeric|min:0',
        ]);

        $tarif = Tarif::findOrFail($id);
        $tarif->update($request->all());

        return redirect()->route('tarif.index')->with('success', 'Tarif berhasil diupdate');
    }

    // Hapus tarif
    public function destroy($id)
    {
        $tarif = Tarif::findOrFail($id);
        $tarif->delete();

        return redirect()->route('tarif.index')->with('success', 'Tarif berhasil dihapus');
    }
}