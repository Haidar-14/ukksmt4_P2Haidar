@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="mb-0">Tambah User</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Isi Nama Lengkap" required>
            </div>

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Isi Username" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Isi Password" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="owner">Owner</option>
                </select>
            </div>


            <div id="shift_container" style="display: none;">
                <div class="mb-3">
                    <label>Pilih Shift (khusus Petugas)</label>
                    <select name="id_shift" class="form-control">
                        <option value="">-- Tidak Ada Shift --</option>
                        @foreach($shifts as $shift)
                            <option value="{{ $shift->id_shift }}">
                                {{ date('H:i', strtotime($shift->jam_masuk)) }} - {{ date('H:i', strtotime($shift->jam_keluar)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    const roleSelect = document.getElementById('role');
    const shiftContainer = document.getElementById('shift_container');

    roleSelect.addEventListener('change', function() {
        if (this.value === 'petugas') {
            shiftContainer.style.display = 'block';
        } else {
            shiftContainer.style.display = 'none';
        }
    });
</script>
@endsection