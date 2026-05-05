@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Form Kendaraan Masuk</h1>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('transaksi.masuk') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Plat Nomor</label>
                        <input type="text" name="plat_nomor" class="form-control" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label>Jenis Kendaraan</label>
                        <select name="jenis_kendaraan" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="motor">Motor</option>
                            <option value="mobil">Mobil</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label>Warna</label>
                        <input type="text" name="warna" class="form-control" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label>Nama Pemilik</label>
                        <input type="text" name="pemilik" class="form-control" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label>Area Parkir</label>
                        <select name="id_area" class="form-control" required>
                            <option value="">Pilih Area</option>
                            @foreach($areas as $area)
                            <option value="{{ $area->id_area }}">
                                {{ $area->nama_area }} (Sisa: {{ $area->kapasitas - $area->total }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label>Tarif</label>
                        <select name="id_tarif" class="form-control" required>
                            <option value="">Pilih Tarif</option>
                            @foreach($tarifs as $tarif)
                            <option value="{{ $tarif->id_tarif }}">
                                {{ $tarif->jenis_kendaraan }} - Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}/jam
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-success">Simpan Masuk</button>
                <a href="{{ route('dashboard.petugas') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection