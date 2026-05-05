@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">

    <!-- HEADER -->
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h4 class="mb-0">Shift</h4>

        <a href="{{ route('shift.create') }}" class="btn btn-primary btn-sm">
            + Tambah Shift
        </a>
    </div>

    <!-- SEARCH -->
    <div class="p-3">
        <input type="text" id="searchUser" class="form-control"
               placeholder="Cari">
    </div>

    <!-- TABLE -->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="userTable">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($shifts as $shift)
                    <tr>
                        <td>{{ $shift->id_shift }}</td>
                        <td>{{ $shift->jam_masuk }}</td>
                        <td>{{ $shift->jam_keluar }}</td>
                        <td class="text-center">
                            <a href="{{ route('shift.edit', $shift->id_shift) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('shift.destroy', $shift->id_shift) }}"
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
    document.getElementById("searchShift").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#shiftTable tbody tr");
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
</script>>
@endsection
