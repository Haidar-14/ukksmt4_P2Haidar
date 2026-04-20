<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('assets/images/P-32x32.png') }}" type="image/png" />
  
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />

  <title>Login - Sistem Parkir</title>
  
  <style>
    .wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #052850 0%, #04254b 100%);
    }
    .authentication-card {
      max-width: 500px;
      margin: 0 auto;
    }
    .card {
      border-radius: 15px !important;
    }
    .radius-30 {
      border-radius: 30px;
    }
    .parking-icon i {
      font-size: 64px;
      color: #0d6efd;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <main class="authentication-content">
      <div class="container-fluid">
        <div class="authentication-card">
          <div class="card shadow overflow-hidden">
            <div class="row g-0">
              <div class="col-12">
                <div class="card-body p-4 p-sm-5">
                  <div class="text-center mb-4">
                    <div class="parking-icon">
                      <i class="fas fa-parking"></i>
                    </div>
                    <h5 class="card-title fw-bold">Sign In</h5>
                  </div>
                  
                
                  
                  <form method="POST" action="/login">
                    @csrf
                    
                    <div class="login-separater text-center mb-4">
                      <span>SIGN IN</span>
                      <hr>
                    </div>
                    
                    <div class="row g-3">
                      <div class="col-12">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control radius-30" placeholder="Username">
                      </div>
                      
                      <div class="col-12">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control radius-30" placeholder="Password">
                      </div>
                      
                      <div class="col-12">
                        <div class="d-grid">
                          <button type="submit" class="btn btn-primary radius-30">SIGN IN</button>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!-- AKHIR FORM -->

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/pace.min.js') }}"></script>
</body>
</html>