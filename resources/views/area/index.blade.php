@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">

    <!-- HEADER -->
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h4 class="mb-0">Area Parkir</h4>

        <a href="{{ route('area.create') }}" class="btn btn-primary btn-sm">
            + Tambah Area parkir
        </a>
    </div>


    <!-- TABLE -->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="userTable">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Area</th>
                        <th>Kapasitas</th>
                        <th>Total</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($areas as $i => $area)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $area->nama_area }}</td>
                    <td>{{ $area->kapasitas }}</td>
                    <td>{{ $area->total }}</td>
                    <td>
                        @php $sisa = $area->kapasitas - $area->total; @endphp
                        <span class="badge bg-{{ $sisa > 0 ? 'success' : 'danger' }}">
                            {{ $sisa }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('area.edit', $area->id_area) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('area.destroy', $area->id_area) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </table>
                @endforeach
            </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
