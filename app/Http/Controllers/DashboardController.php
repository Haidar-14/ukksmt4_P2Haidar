<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kendaraan;
use App\Models\AreaParkir;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin', [
            'totalKendaraan' => Kendaraan::count(),
            'totalTransaksiHariIni' => Transaksi::whereDate('waktu_masuk', Carbon::today())->count(),
            'areaTersedia' => AreaParkir::sum('kapasitas') - AreaParkir::sum('total'),
            'pendapatanHariIni' => Transaksi::whereDate('waktu_masuk', Carbon::today())->sum('biaya_total')
        ]);
    }
    
    public function petugas()
    {
        return view('dashboard.petugas', [
            'transaksiAktif' => Transaksi::where('status', 'masuk')->count(),
            'areaTerisi' => AreaParkir::sum('total'),
            'kapasitasTotal' => AreaParkir::sum('kapasitas')
        ]);
    }
    
    public function owner()
    {
        return view('dashboard.owner', [
            'pendapatanBulanIni' => Transaksi::whereMonth('waktu_masuk', Carbon::now()->month)->sum('biaya_total'),
            'totalTransaksi' => Transaksi::count(),
            'kendaraanTerdaftar' => Kendaraan::count()
        ]);
    }
}