@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Petugas</h1>
    
    <!-- Info Shift -->
    @if(auth()->user()->shift)
    <div class="alert alert-info">
        <strong>Shift Anda:</strong> {{ date('H:i', strtotime(auth()->user()->shift->jam_masuk)) }} - {{ date('H:i', strtotime(auth()->user()->shift->jam_keluar)) }}
    </div>
    @endif
    
    <div class="row">
        <!-- Card Transaksi Aktif -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Kendaraan Parkir</h5>
                    <h2>{{ $transaksiAktif }}</h2>
                 
                </div>
            </div>
        </div>
        
        <!-- Card Slot Terisi -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Area Terisi</h5>
                    <h2>{{ $areaTerisi }} / {{ $kapasitasTotal }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Kendaraan Masuk</h5>
                    <h2>{{ $areaTerisi }} / {{ $kapasitasTotal }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-2">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Area Terisi</h5>
                    <h2>{{ $areaTerisi }} / {{ $kapasitasTotal }}</h2>
                </div>
            </div>
        </div>
    </div>
    
{{--      --}}
</div>
@endsection