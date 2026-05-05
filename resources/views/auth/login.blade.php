<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/P-32x32.png') }}" type="image/png" />
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <title>Login - Sistem Parkir</title>
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #261ac4 100%);
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 480px;
        }
        
        .login-header {
            background: linear-gradient(135deg, #667eea 0%,#2315e7 100%);
            padding: 35px;
            text-align: center;
            color: white;
        }
        
        .login-header i {
            font-size: 70px;
            margin-bottom: 15px;
        }
        
        .login-header h4 {
            margin: 0;
            font-weight: 600;
            font-size: 28px;
        }
        
        .login-header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        
        .login-body {
            padding: 35px;
        }
        
        /* PERBAIKAN: Ukuran label */
        .form-label {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
            display: block;
        }
        
        /* PERBAIKAN: Ukuran input */
        .form-control {
            border-radius: 10px;
            padding: 14px 12px;
            border: 1px solid #ccc;
            font-size: 15px;
            height: auto;
            width: 95%;
        }
        
        .input-group-text {
            padding: 14px 12px;
            background: #f8f9fa;
        }
        
        .form-control:focus {
            box-shadow: none;
            border-color: #667eea;
        }
        
        /* PERBAIKAN: Tombol login */
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%,#2315e7 100%);
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            width: 100%;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }
        
        /* Jarak antar form group */
        .mb-3 {
            margin-bottom: 25px !important;
        }
        
       
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <i class="fas fa-parking"></i>
        <h4>Sistem Parkir</h4>
        <p>Masukan Username dan Password</p>
    </div>
    
    <div class="login-body">
        
        <!-- Pesan Error -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-user"></i> Username</label>
                <input type="text" name="username" class="form-control" 
                       value="{{ old('username') }}" placeholder="Masukkan username" required autofocus>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>
        
    </div>
</div>

<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

</body>
</html>