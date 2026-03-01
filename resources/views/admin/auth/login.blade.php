<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/back/')}}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<a href="{{url('/')}}">Home</a>
<div class="login-box">
    <div class="login-logo">
        <a href="{{route('login')}}"></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <div>
                @if (session('sonuc'))
                    <div class="alert alert-danger">
                        {{ session('sonuc') }}
                    </div>
                @endif
            </div>

            <form action="{{route('loginPost')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email - Kullanıcı Adı">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password - Şifreniz">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



            <p class="mb-1">
    <span class="text-danger">
        Şifrenizi unuttuysanız, lütfen <strong>Hasan Sarıköse</strong> ile iletişime geçiniz.<br>
        Tel: <a href="tel:+905331481870">+90 533 148 18 70</a>
    </span>
            </p>
            <!--
            <p class="mb-0">
                <a href="#" class="text-center">Yeni Üyelik</a>
            </p>
            -->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('assets/back/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/back/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/back/')}}/dist/js/adminlte.min.js"></script>
</body>
</html>

