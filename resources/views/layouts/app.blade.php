<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Parkir</title>
    
    <!-- CSS Template Anda -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<style>
    .header {
        position: absolute;
        top: 20px;
        right: 20px;
    }
</style>
<body>
    <div class="header">
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
            {{ auth()->user()->nama_lengkap }} ({{ auth()->user()->role }})
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

<div class="wrapper">
    <!-- Sidebar -->
    <aside class="sidebar-wrapper">
        <div class="sidebar-header">
            <div class="parking-icon">
                <i class="fas fa-parking" style="font-size: 50px; color: #0d6efd;"></i>
            </div>
            <div>
                <h4 class="logo-text">Sistem Parkir</h4>
            </div>
        </div>
        
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ url('/dashboard/' . Auth::user()->role) }}">
                    <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            @if(Auth::user()->role == 'admin')
            <li>
                <a href="{{ url('/users') }}">
                    <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
                    <div class="menu-title">User</div>
                </a>
            </li>
            <li>
                <a href="{{ url('/tarif') }}">
                    <div class="parent-icon"><i class="bi bi-tag-fill"></i></div>
                    <div class="menu-title">Tarif</div>
                </a>
            </li>
            <li>
                <a href="{{ url('/area') }}">
                    <div class="parent-icon"><i class="bi bi-map-fill"></i></div>
                    <div class="menu-title">Area Parkir</div>
                </a>
            </li>
            <li>
                <a href="{{ url('/kendaraan') }}">
                    <div class="parent-icon"><i class="bi bi-car-front-fill"></i></div>
                    <div class="menu-title">Kendaraan</div>
                </a>
            </li>
            <li>
                <a href="{{ url('/shift') }}">
                    <div class="parent-icon"><i class="bi bi-clock-fill"></i></div>
                    <div class="menu-title">Shift</div>
                </a>
            </li>
            <li>
                <a href="{{ url('/logs') }}">
                    <div class="parent-icon"><i class="bi bi-file-text-fill"></i></div>
                    <div class="menu-title">Log Aktivitas</div>
                </a>
            </li>
            @endif
            
            @if(Auth::user()->role == 'petugas')
            <li>
                <a href="{{ url('/transaksi/masuk') }}">
                    <div class="parent-icon"><i class="bi bi-box-arrow-in-right"></i></div>
                    <div class="menu-title">Kendaraan Masuk</div>
                </a>
            </li>
            <li>
                <a href="{{ url('/transaksi/keluar') }}">
                    <div class="parent-icon"><i class="bi bi-box-arrow-right"></i></div>
                    <div class="menu-title">Kendaraan Keluar</div>
                </a>
            </li>
            <li>
                <a href="{{ url('/transaksi/aktif') }}">
                    <div class="parent-icon"><i class="bi bi-car-front-fill"></i></div>
                    <div class="menu-title">Kendaraan Parkir</div>
                </a>
            </li>
            @endif
            
            @if(Auth::user()->role == 'owner')
            <li>
                <a href="{{ url('/laporan') }}">
                    <div class="parent-icon"><i class="bi bi-graph-up"></i></div>
                    <div class="menu-title">Laporan</div>
                </a>
            </li>
            @endif
        </ul>
    </aside>

    <!-- Konten Utama -->
    <div class="page-content">
        <div class="container-fluid">
                    @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>




@if(auth()->check() && auth()->user()->role == 'petugas')
<script>
    let sudahDiberitahu = false;

    function cekShift() {
        fetch('/cek-shift-aktif')
            .then(response => response.json())
            .then(data => {
                console.log('Shift aktif?', data.shift_aktif);
                
                if (data.shift_aktif === false) {
                    if (!sudahDiberitahu) {
                        // Hanya tampilkan alert sekali
                        alert('Shift Anda telah berakhir!');
                        sudahDiberitahu = true;
                    }
                    // Tidak redirect, tetap di halaman
                } else {
                    // Reset jika shift aktif kembali
                    sudahDiberitahu = false;
                }
            })
            .catch(error => console.log('Error:', error));
    }
    
    // Cek setiap 20 detik
    setInterval(cekShift, 20000);
    
    // Cek sekali saat halaman dimuat
    cekShift();
</script>
@endif


<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
</body>
</html>