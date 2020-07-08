<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kerja Praktek | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a class="login-title" href="#"><b>PKL Komsi</b><br>Mahasiswa Login System</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form class="form" method="POST" action="{{route('login')}}">
      @csrf
        <div class="input-group mb-3">
          <input type="text" id="username" class="form-control" placeholder="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username">
          @if ($errors->has('username'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('username') }}</strong>
              </span>
          @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" placeholder="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
          @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          <div style="text-align:left; font-size: 13px;">
            <p>Lupa password ? Hubungi akademik</p>
          </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button href="/admin" class="btn btn-primary btn-block btn-flat">{{ __('LOGIN') }}</button>
          </div>
          
          <!-- /.col -->
        </div>
        <br>
          
        <br>
        @if (Session::has('error'))
              <div style="text-align:center">
                <p style="text-align:center"><strong >{{ \Illuminate\Support\Facades\Session::get('error') }}</strong></p>
              </div>
            @endif
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>