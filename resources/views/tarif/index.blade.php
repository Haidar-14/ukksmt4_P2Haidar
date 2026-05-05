@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">

    <div class="card-header d-flex justify-content-between align-item-center bg-white">
        <h3 class="mb-0">Tarif Parkir</h3>
        <a href="{{ route('tarif.create') }}" class="btn btn-primary btn-sm">Tambah Tarif</a>
    </div>

    <div class="p-3 ">
        <input type="text" id="searchTarif" class="form-control" placeholder="Cari">
    </div>

    <div class="card-body pt-0">
        <div class="table-reponsive">
            <table class="table table-hover align-middle" id="tarifTable">
            <thead  class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Jenis Kendaraan</th>
                    <th>Tarif/Jam</th>
                    <th>Maksimal Harian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
               <tbody>
                @foreach($tarifs as $i => $tarif)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $tarif->jenis_kendaraan }}</td>
                    <td>Rp {{ number_format($tarif->tarif_per_jam, 0, ',', '.') }}</td>
                    <td>
                        @if($tarif->tarif_maksimal_harian)
                            Rp {{ number_format($tarif->tarif_maksimal_harian, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('tarif.edit', $tarif->id_tarif) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('tarif.destroy', $tarif->id_tarif) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
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
<script>
    document.getElementById("searchTarif").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#tarifTable tbody tr");
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