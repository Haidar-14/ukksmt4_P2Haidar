<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }
    
        public function create()
    {
        $shifts = \App\Models\Shift::all();
        return view('user.create', compact('shifts'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:tb_user',
            'password' => 'required|min:4',
            'role' => 'required'
        ]);
        
        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status_aktif' => 1,
            'id_shift' => $request->id_shift,
        ]);
        
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }
    
        public function edit($id)
{
    $user = User::findOrFail($id);
    $shifts = \App\Models\Shift::all();  // <== PASTIKAN ADA
    return view('user.edit', compact('user', 'shifts'));
}
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:tb_user,username,' . $id . ',id_user',
            'role' => 'required'
        ]);
        
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'role' => $request->role,
            'status_aktif' => $request->status_aktif ?? 1,
             'id_shift' => $request->id_shift
        ];
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        $user->update($data);
        
        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Jangan hapus user sendiri
        if ($user->id_user == auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri');
        }
        
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}