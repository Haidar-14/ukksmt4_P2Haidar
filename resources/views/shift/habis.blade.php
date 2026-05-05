<!DOCTYPE html>
<html>
<head>
    <title>Shift Selesai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center shadow">
                <div class="card-header bg-warning">
                    <h4> Shift Telah Selesai</h4>
                </div>
                <div class="card-body">
                    <p>Silakan klik tombol di bawah untuk keluar.</p>
                    <form method="POST" action="{{ route('shift.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>