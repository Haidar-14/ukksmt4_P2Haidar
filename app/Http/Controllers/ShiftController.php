<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    // Tampilkan semua data shift
    public function index()
    {
        $shifts = Shift::all();
        return view('shift.index', compact('shifts'));
    }
    
    // Form tambah shift
    public function create()
    {
        return view('shift.create');
    }
    
    // Simpan shift baru
    public function store(Request $request)
    {
        $request->validate([
            'jam_masuk' => 'required',
            'jam_keluar' => 'required'
        ]);
        
           Shift::create([
        'jam_masuk' => $request->jam_masuk,
        'jam_keluar' => $request->jam_keluar,
    ]);
        
        return redirect()->route('shift.index')->with('success', 'Shift berhasil ditambahkan');
    }
    
    // Form edit shift
    public function edit($id)
    {
        $shift = Shift::findOrFail($id);
        return view('shift.edit', compact('shift'));
    }
    
    // Update shift
    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_masuk' => 'required',
            'jam_keluar' => 'required'
        ]);
        
        $shift = Shift::findOrFail($id);
        $shift->update($request->all());
        
        return redirect()->route('shift.index')->with('success', 'Shift berhasil diupdate');
    }
    
    // Hapus shift
    public function destroy($id)
    {
        $shift = Shift::findOrFail($id);
        $shift->delete();
        
        return redirect()->route('shift.index')->with('success', 'Shift berhasil dihapus');
    }
}