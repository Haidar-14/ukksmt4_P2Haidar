@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mb-4">Dashboard Admin</h1>
    
    <div class="row">
        <!-- Card Total Kendaraan -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Kendaraan</h5>
                    <h2>{{ $totalKendaraan }}</h2>
                </div>
            </div>
        </div>
        
        <!-- Card Transaksi Hari Ini -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Transaksi Hari Ini</h5>
                    <h2>{{ $totalTransaksiHariIni }}</h2>
                </div>
            </div>
        </div>
        
        <!-- Card Area Tersedia -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Slot Parkir Tersedia</h5>
                    <h2>{{ $areaTersedia }}</h2>
                </div>
            </div>
        </div>
        
        <!-- Card Pendapatan -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Pendapatan Hari Ini</h5>
                    <h2>Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
@endsection