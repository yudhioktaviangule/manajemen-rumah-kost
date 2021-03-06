<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{env('APP_NAME')}} | Log in</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('lte3/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('lte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('lte3/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition" style="background:url({{asset('lte3/dist/img/bgapps.png')}})">
  <div class="container-fluid" style="">
    <div class="row justify-content-end">
      
      <div class="col col-lg-4" style="margin-top:10%">
        <div class="login-logo">
          
        </div>
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Selamat Datang di {{env('APP_NAME')}}</p>

            <form action="" method="post">
              @csrf
              <div class="input-group mb-3">
                <input required type="email" name='email' class="form-control" placeholder="Email">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input required type="password" name='password' class="form-control" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>

              <div class='form-group'>
                  <button class="btn btn-sm btn-info btn-block">
                      <i class="fas fa-lock"></i>
                      Login
                  </button>
              </div>
          
            </form>

            <div class="social-auth-links text-center mb-3">
              
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-0">
              <a href="{{route('register')}}" class="text-center"><i class="fas fa-edit"></i> Booking Kamar</a>
            </p>
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
    </div>
  </div>
<script src="{{asset('lte3/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('lte3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('lte3/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
