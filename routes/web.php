<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\AreaParkirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;

// CEK SHIFT AKTIF (untuk auto redirect)
Route::middleware(['auth'])->get('/cek-shift-aktif', function () {
    $user = auth()->user();
    
    if ($user && $user->role == 'petugas' && $user->shift) {
        $now = \Carbon\Carbon::now();
        $start = \Carbon\Carbon::parse($user->shift->jam_masuk);
        $end = \Carbon\Carbon::parse($user->shift->jam_keluar);
        
        $isActive = $now->between($start, $end);
        
        return response()->json([
            'active' => $isActive,
            'now' => $now->format('H:i:s'),
            'shift_start' => $start->format('H:i:s'),
            'shift_end' => $end->format('H:i:s')
        ]);
    }
    
    return response()->json(['active' => true]);
});

// ROUTE UNTUK CEK SESSION
Route::get('/cek-session', function () {
    return [
        'login_status' => auth()->check(),
        'user' => auth()->user() ? auth()->user()->username : null,
        'role' => auth()->user() ? auth()->user()->role : null,
    ];
});


// // TEST ROUTE - LANGSUNG TAMPIL
// Route::get('/dashboard/admin', function () {
//     return "HALAMAN ADMIN - Login berhasil! User: " . auth()->user()->nama_lengkap;
// })->middleware('auth');

// Route::get('/dashboard/petugas', function () {
//     return "HALAMAN PETUGAS - Login berhasil! User: " . auth()->user()->nama_lengkap;
// })->middleware('auth');

// Route::get('/dashboard/owner', function () {
//     return "HALAMAN OWNER - Login berhasil! User: " . auth()->user()->nama_lengkap;
// })->middleware('auth');






Route::get('/', function () {
    return redirect('login');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard/petugas', [DashboardController::class, 'petugas'])->name('dashboard.petugas');
    Route::get('/dashboard/owner', [DashboardController::class, 'owner'])->name('dashboard.owner');
});

//admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    //User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
    //tarif
     Route::get('/tarif', [TarifController::class, 'index'])->name('tarif.index');
    Route::get('/tarif/create', [TarifController::class, 'create'])->name('tarif.create');
    Route::post('/tarif', [TarifController::class, 'store'])->name('tarif.store');
    Route::get('/tarif/{id}/edit', [TarifController::class, 'edit'])->name('tarif.edit');
      Route::put('/tarif/{id}', [TarifController::class, 'update'])->name('tarif.update');
    Route::delete('/tarif/{id}', [TarifController::class, 'destroy'])->name('tarif.destroy');
    
         //Area Parkir
     Route::get('/area', [AreaParkirController::class, 'index'])->name('area.index');
    Route::get('/area/create', [AreaParkirController::class, 'create'])->name('area.create');
         Route::post('/area', [AreaParkirController::class, 'store'])->name('area.store');
    Route::get('/area/{id}/edit', [AreaParkirController::class, 'edit'])->name('area.edit');
    Route::put('/area/{id}', [AreaParkirController::class, 'update'])->name('area.update');
      Route::delete('/area/{id}', [AreaParkirController::class, 'destroy'])->name('area.destroy');
    
//Kendaraan
Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index');
Route::get('/kendaraan/create', [KendaraanController::class, 'create'])->name('kendaraan.create');
Route::post('/kendaraan', [KendaraanController::class, 'store'])->name('kendaraan.store');
Route::get('/kendaraan/{id}/edit', [KendaraanController::class, 'edit'])->name('kendaraan.edit');
    Route::put('/kendaraan/{id}', [KendaraanController::class, 'update'])->name('kendaraan.update');
    Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy'])->name('kendaraan.destroy');
    
    //Shift
    Route::get('/shift', [ShiftController::class, 'index'])->name('shift.index');
    Route::get('/shift/create', [ShiftController::class, 'create'])->name('shift.create');
Route::post('/shift', [ShiftController::class, 'store'])->name('shift.store');
    Route::get('/shift/{id}/edit', [ShiftController::class, 'edit'])->name('shift.edit');
    Route::put('/shift/{id}', [ShiftController::class, 'update'])->name('shift.update');
    Route::delete('/shift/{id}', [ShiftController::class, 'destroy'])->name('shift.destroy');
Route::get('/shift-habis', [ShiftController::class, 'shiftHabis'])->name('shift.habis');
Route::post('/shift-logout', [ShiftController::class, 'shiftLogout'])->name('shift.logout');


    // Log Aktivitas
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
});


//petugas
Route::middleware(['auth', 'role:petugas'])->prefix('transaksi')->group(function () {
    
Route::get('/masuk', [TransaksiController::class, 'formMasuk'])->name('transaksi.masuk');
        Route::post('/masuk', [TransaksiController::class, 'prosesMasuk']);
     Route::get('/keluar', [TransaksiController::class, 'formKeluar'])->name('transaksi.keluar');
     Route::post('/keluar', [TransaksiController::class, 'prosesKeluar']);
     Route::get('/cetak/{id}', [TransaksiController::class, 'cetakStruk'])->name('transaksi.cetak');
    Route::get('/aktif', [TransaksiController::class, 'aktif'])->name('transaksi.aktif');
});

//owner
Route::middleware(['auth', 'role:owner'])->group(function () {
    
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/rekap', [LaporanController::class, 'rekap'])->name('laporan.rekap');
});

// Cek apakah shift petugas masih aktif (untuk auto redirect)
Route::get('/cek-shift-aktif', function () {
    $user = auth()->user();
    if ($user && $user->role == 'petugas' && $user->shift) {
        $now = now();
        $jamMulai = \Carbon\Carbon::parse($user->shift->jam_masuk);
        $jamSelesai = \Carbon\Carbon::parse($user->shift->jam_keluar);
        $shiftAktif = $now->between($jamMulai, $jamSelesai);
        return response()->json(['shift_aktif' => $shiftAktif]);
    }
    return response()->json(['shift_aktif' => true]);
})->middleware('auth');


require __DIR__.'/auth.php';