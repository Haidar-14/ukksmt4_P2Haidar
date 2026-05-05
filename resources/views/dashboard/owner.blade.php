@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Owner</h1>
    
    <div class="row">
        <!-- Card Pendapatan -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Pendapatan Bulan Ini</h5>
                    <h2>Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h2>
                    <p>Total pemasukan</p>
                </div>
            </div>
        </div>
        
        <!-- Card Total Transaksi -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Transaksi</h5>
                    <h2>{{ $totalTransaksi }}</h2>

                </div>
            </div>
        </div>
        
        <!-- Card Kendaraan -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Kendaraan Terdaftar</h5>
                    <h2>{{ $kendaraanTerdaftar }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Laporan</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('laporan.index') }}" class="btn btn-primary">Rekap Transaksi</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection