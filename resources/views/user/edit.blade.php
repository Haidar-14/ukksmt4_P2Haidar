@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit User</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('users.update', $user->id_user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="{{ $user->nama_lengkap }}" required>
            </div>
            
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
            </div>
            
            <div class="mb-3">
                <label>Password (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="form-control">
            </div>
            
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="owner" {{ $user->role == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>

                    <div class="mb-3">
            <label>Pilih Shift (khusus Petugas)</label>
            <select name="id_shift" class="form-control">
                <option value="">-- Tidak Ada Shift --</option>
                @foreach($shifts as $shift)
                    <option value="{{ $shift->id_shift }}" {{ $user->id_shift == $shift->id_shift ? 'selected' : '' }}>
                        {{ date('H:i', strtotime($shift->jam_masuk)) }} - {{ date('H:i', strtotime($shift->jam_keluar)) }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Hanya berlaku untuk role Petugas</small>
        </div>
            
            <div class="mb-3">
                <label>Status</label>
                <select name="status_aktif" class="form-control">
                    <option value="1" {{ $user->status_aktif == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $user->status_aktif == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection