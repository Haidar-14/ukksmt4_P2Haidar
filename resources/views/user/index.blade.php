@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">

    <!-- HEADER -->
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h4 class="mb-0">Manajemen User</h4>

        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            + Tambah User
        </a>
    </div>

    <!-- SEARCH -->
    <div class="p-3">
        <input type="text" id="searchUser" class="form-control"
               placeholder="Cari user (nama, username, role...)">
    </div>

    <!-- TABLE -->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="userTable">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Shift</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                     @php $no = 1; @endphp
                    @foreach($users as $user)
                    <tr>
                       <td>{{ $no++ }}</td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ $user->role }}
                            </span>
                        </td>
                        <!-- KOLOM SHIFT -->
                         <td>
                            @if($user->role == 'petugas' && $user->shift)
                                {{ date('H:i', strtotime($user->shift->jam_masuk)) }} - {{ date('H:i', strtotime($user->shift->jam_keluar)) }}
                            @else
                                -
                            @endif
                        </td>
                        
                        <td>
                            @if($user->status_aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('users.edit', $user->id_user) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('users.destroy', $user->id_user) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus user ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
            <div id="pesanKosong" class="text-center text-muted py-3" style="display: none;">
                Data tidak ditemukan
            </div>
        </div>
    </div>
</div>

<!-- SEARCH SCRIPT -->
<script>
    document.getElementById("searchUser").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#userTable tbody tr");
        let total = 0;

        rows.forEach(row => {
            if (row.textContent.toLowerCase().includes(filter)) {
                row.style.display = "";
                total++;
            } else {
                row.style.display = "none";
            }
        });

        let pesan = document.getElementById("pesanKosong");
        if (pesan) {
            pesan.style.display = total === 0 ? "block" : "none";
        }
    });
</script>
@endsection
