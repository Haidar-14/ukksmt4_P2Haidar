@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Tambah Shift</h3>
    </div>
    <div class="card-body">
            <form action="{{ route('shift.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label>Jam Masuk</label>
            <input type="time" name="jam_masuk" class="form-control" placeholder="Masukan jam" required>
        </div>
        
        <div class="mb-3">
            <label>Jam Keluar</label>
            <input type="time" name="jam_keluar" class="form-control" placeholder="Masukan jam" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan
        </button>
         <a href="{{ route('shift.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    </div>
</div>
@endsection