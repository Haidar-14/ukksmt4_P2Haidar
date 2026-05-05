<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kendaraan;
use App\Models\Tarif;
use App\Models\AreaParkir;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    
    public function formMasuk()
    {
        $areas = AreaParkir::whereRaw('total < kapasitas')->get();
        $tarifs = Tarif::all();
        
        return view('transaksi.masuk', compact('areas', 'tarifs'));
    }
    
    public function prosesMasuk(Request $request)
    {
        // Validasi input
        $request->validate([
            'plat_nomor' => 'required',
            'jenis_kendaraan' => 'required',
            'warna' => 'required',
            'pemilik' => 'required',
            'id_area' => 'required',
            'id_tarif' => 'required',
        ]);
        
        // Cari kendaraan berdasarkan plat nomor, jika tidak ada maka buat baru
        $kendaraan = Kendaraan::firstOrCreate(
            ['plat_nomor' => $request->plat_nomor],
            [
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'warna' => $request->warna,
                'pemilik' => $request->pemilik,
                'id_user' => auth()->id()
            ]
        );
        
        // Buat transaksi baru (status masuk)
        $transaksi = Transaksi::create([
            'id_kendaraan' => $kendaraan->id_kendaraan,
            'id_tarif' => $request->id_tarif,
            'id_area' => $request->id_area,
            'waktu_masuk' => Carbon::now(),
            'status' => 'masuk',
            'id_user' => auth()->id()
        ]);
        
        // Update jumlah slot terisi di area parkir
        $area = AreaParkir::find($request->id_area);
        $area->increment('total');
        
        // Catat ke log aktivitas
        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => "Kendaraan {$request->plat_nomor} masuk parkir",
            'waktu_aktivitas' => Carbon::now()
        ]);
        
        // Redirect ke halaman cetak struk
        return redirect()->route('transaksi.cetak', $transaksi->id_parkir)
            ->with('success', 'Kendaraan masuk berhasil');
    }
    
    public function formKeluar()
    {
        return view('transaksi.keluar');
    }
    
    public function prosesKeluar(Request $request)
    {
        $request->validate(['plat_nomor' => 'required']);
        
        $transaksi = Transaksi::whereHas('kendaraan', function($q) use ($request) {
            $q->where('plat_nomor', $request->plat_nomor);
        })->where('status', 'masuk')->first();
        
        
        if (!$transaksi) {
            return back()->with('error', 'Kendaraan tidak ditemukan atau sudah keluar');
        }
        

        $transaksi->waktu_keluar = Carbon::now();
        $transaksi->status = 'keluar';
        

        $transaksi->hitungBiaya();
        $transaksi->save();
        

        $area = AreaParkir::find($transaksi->id_area);
        if ($area) {
            $area->decrement('total');
        }
        
        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => "Kendaraan {$request->plat_nomor} keluar parkir. Biaya: Rp " . number_format($transaksi->biaya_total, 0, ',', '.'),
            'waktu_aktivitas' => Carbon::now()
        ]);
        
        return redirect()->route('transaksi.cetak', $transaksi->id_parkir)
            ->with('success', 'Kendaraan keluar berhasil');
    }
    
   

    public function cetakStruk($id)
    {
        $transaksi = Transaksi::with(['kendaraan', 'tarif'])->findOrFail($id);
        return view('transaksi.struk', compact('transaksi'));
    }
    
 
    public function aktif()
    {
        $transaksiAktif = Transaksi::with(['kendaraan'])->where('status', 'masuk')->get();
        
        return view('transaksi.aktif', compact('transaksiAktif'));
    }
}