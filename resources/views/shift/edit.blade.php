@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Shift</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('shift.update', $shift->id_shift) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Jam Masuk</label>
                <input type="time" name="jam_masuk" class="form-control" value="{{ $shift->jam_masuk }}" required>
            </div>
            
            <div class="mb-3">
                <label>Jam Keluar</label>
                <input type="time" name="jam_keluar" class="form-control" value="{{ $shift->jam_keluar }}" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('shift.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection