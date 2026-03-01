<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PANEL ADMİN</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/back/')}}/dist/css/adminlte.min.css">

    @yield('customCSS')

</head>
<style>
    #preview-image {
        max-width: 150px; /* Fotoğraf boyutunu 150px'e sınırlıyoruz */
        max-height: 150px; /* Yüksekliği de 150px'e sınırlıyoruz */
        object-fit: cover; /* Görüntünün orantısız şekilde kırpılmasını sağlar */
    }

</style>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">


    <!-- Navbar -->
    @include('admin/tema/head')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.tema.tasside')
    <!-- End Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >

        <!-- Main content -->
        <section class="content" style="margin-top: 10px;">

            <div class="container-fluid">


                @yield('content')


            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer  -->
    @include('admin/tema/footer')
    <!-- End Footer  -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/back/')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/back/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/back/')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/back/')}}/dist/js/adminlte.min.js"></script>

@yield('customJS')

</body>
</html>
