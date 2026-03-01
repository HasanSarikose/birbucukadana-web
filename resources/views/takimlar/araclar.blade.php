<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Araçlarımız - Bir Buçuk Adana</title>
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
        .vehicle-section {
            margin-bottom: 30px;
        }
        .vehicle-section h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .vehicle {
            text-align: center;
            margin-bottom: 30px;
        }
        .vehicle img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
        }
        .vehicle p {
            font-size: 1.1rem;
            color: #8b949e;
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
            .vehicle img {
                max-width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>
<!-- Navbar -->
@include('layouts.tnavbar')

<!-- Main Content -->
<div class="main-content container">
    @php
        $yillaraGoreAraclar = $arac->groupBy('year');
    @endphp

    @foreach($yillaraGoreAraclar as $yil => $araclar)
        <div class="vehicle-section">
            <h3>{{ $yil }}</h3>
            <div class="row">
                @foreach($araclar as $item)
                    <div class="col-lg-6 col-md-12 vehicle">
                        <!-- Başlık en önce, açıklama sonra gelsin -->
                        <h4>{{ $item->baslik }}</h4> <!-- Başlık kısmı -->
                        <img src="{{ asset($item->image) }}" alt="{{ $item->baslik }}" />
                        <p>{{ $item->aciklama }}</p> <!-- Açıklama kısmı -->
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
<!-- Footer -->
@include('layouts.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
