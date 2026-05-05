<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\LogAktivitas;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        // Coba autentikasi
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Cek status aktif
            if ($user->status_aktif != 1) {
                Auth::logout();
                return back()->withErrors(['username' => 'Akun Anda tidak aktif.']);
            }
            
            // Catat log login
            LogAktivitas::create([
                'id_user' => $user->id_user,
                'aktivitas' => 'Login',
                'waktu_aktivitas' => now()
            ]);
            
            // REDIRECT LANGSUNG KE URL
            if ($user->role == 'admin') {
                return redirect('http://127.0.0.1:8000/dashboard/admin');
            } elseif ($user->role == 'petugas') {
                return redirect('http://127.0.0.1:8000/dashboard/petugas');
            } elseif ($user->role == 'owner') {
                return redirect('http://127.0.0.1:8000/dashboard/owner');
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            LogAktivitas::create([
                'id_user' => Auth::user()->id_user,
                'aktivitas' => 'Logout',
                'waktu_aktivitas' => now()
            ]);
        }
        
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}