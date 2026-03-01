<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KULÜP PANELİ</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{asset('assets/back/')}}/dist/css/adminlte.min.css">

    @yield('customCSS')

</head>
<style>
    #preview-image {
        max-width: 150px;
        max-height: 150px;
        object-fit: cover;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('admin/tema/head')
    @include('admin.tema.casside')
    <div class="content-wrapper" >
        <section class="content" style="margin-top: 10px;">
            <div class="container-fluid">

                @yield('content')

            </div>
        </section>
    </div>
    @include('admin/tema/footer')
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>

<script src="{{asset('assets/back/')}}/plugins/jquery/jquery.min.js"></script>
<script src="{{asset('assets/back/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/back/')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="{{asset('assets/back/')}}/dist/js/adminlte.min.js"></script>

@yield('customJS')

</body>
</html>
