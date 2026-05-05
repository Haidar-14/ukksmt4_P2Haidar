@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Tarif</h3>
    </div>
    <div class="card-body">
            <form action="{{ route('tarif.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label>Jenis kendaraan</label>
            <input type="text" name="jenis_kendaraan" class="form-control" required>
            <small></small>
        </div>
        
         <div class="mb-3">
                <label class="form-label">Tarif per Jam (Rp)</label>
                <input type="number" name="tarif_per_jam" class="form-control" placeholder="Rp"  required>
                <small class="text-muted">Biaya parkir per jam dalam Rupiah</small>
            </div>

             <div class="mb-3">
                <label class="form-label">Tarif Maksimal Harian (Rp) - <small>Opsional</small></label>
                <input type="number" name="tarif_maksimal_harian" class="form-control" 
                       placeholder="Contoh: 10000" >
                <small class="text-muted">Kosongkan jika tidak ada batasan maksimal</small>
            </div>
        
        <button type="submit" class="btn btn-primary">Simpan
        </button>
         <a href="{{ route('tarif.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    </div>
</div>
@endsection