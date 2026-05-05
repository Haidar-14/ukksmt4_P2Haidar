<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShiftMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        
        
        if ($user && $user->role == 'petugas') {
            
            // Jika petugas tidak punya shift
            if (!$user->id_shift) {
                return redirect()->back()->with('error', 'Anda belum punya jadwal shift. Hubungi admin.');
            }
            
            $shift = $user->shift;
            $jamSekarang = Carbon::now()->format('H:i:s');
            
            if ($jamSekarang > $shift->jam_keluar) {
                return redirect()->route('shift.habis');
            }
            
            
            if ($jamSekarang < $shift->jam_masuk) {
                return redirect()->route('dashboard.petugas')
                ->with('error', 'Shift Anda belum dimulai. Mulai jam ' . date('H:i', strtotime($shift->jam_masuk)));
            }
        }
        
        return $next($request);
    }
}