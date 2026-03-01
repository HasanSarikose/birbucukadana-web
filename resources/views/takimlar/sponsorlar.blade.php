<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sponsorlarımız - {{$team->name}}</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        rel="stylesheet"
    />
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .navbar {
            background-color: #161b22;
        }
        .navbar-brand,
        .nav-link {
            color: #c9d1d9 !important;
        }
        .navbar-brand img {
            height: 40px;
            width: auto;
        }
        .nav-link:hover {
            color: #58a6ff !important;
            transition: color 0.3s ease;
        }
        .main-content {
            padding: 50px 15px;
            flex: 1;
        }
        .sponsor-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .sponsor-section h3 {
            margin-bottom: 20px;
        }
        .sponsor {
            margin-bottom: 30px;
        }
        .sponsor img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        footer {
            background-color: #161b22;
            padding: 10px 0;
            text-align: center;
            color: #8b949e;
            width: 100%;
            margin-top: auto;
        }
        @media (max-width: 768px) {
            .sponsor img {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>
<!-- Navbar -->
@include('layouts.tnavbar')

<!-- Main Content -->
<div class="main-content container">
    <!-- Paketleri döngüye al -->
    @foreach($packages as $package)
        <!-- Sadece sponsorları varsa göster -->
        @if($package->sponsors->isNotEmpty())
            <h3 class="my-4">{{ $package->title }} Sponsorlar</h3>

            <div class="row">
                @foreach($package->sponsors as $sponsor)
                    <div class="col-lg-4 col-md-6 col-sm-12 sponsor">
                        <img src="{{ asset($sponsor->logo_path) }}" alt="{{ $sponsor->name }}">
                        <h5>{{ $sponsor->name }}</h5>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach

    <!-- Hiç paket yoksa veya tüm paketler boşsa -->
    @if($packages->isEmpty() || !$packages->contains(function ($package) { return $package->sponsors->isNotEmpty(); }))
        <div class="alert alert-info text-center">
            Henüz aktif sponsor bulunmamaktadır.
        </div>
    @endif
</div>

<!-- Footer -->
@include('layouts.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
