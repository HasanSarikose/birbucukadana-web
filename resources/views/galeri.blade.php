@php
    use App\Models\Galeri;
    $data = Galeri::all();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fotoğraf Galerisi - Bir Buçuk Adana</title>
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
        .dropdown-menu {
            background-color: #161b22;
            border: none;
        }
        .dropdown-item {
            color: #c9d1d9;
        }
        .dropdown-item:hover {
            background-color: #0d1117;
            color: #58a6ff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .main-content {
            padding: 50px 15px;
            flex: 1;
        }

        .photo-card {
            background-color: #161b22;
            border: none;
            border-radius: 10px;
            color: #c9d1d9;
            margin-bottom: 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .photo-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.4s ease; /* Animasyon süresi */
        }

        .photo-card:hover img {
            transform: scale(1.05); /* Hafif büyüme */
        }

        .photo-card h5 {
            margin-top: 15px;
        }

        .photo-card p {
            font-size: 0.9em;
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
    </style>
</head>
<body>
<!-- Navbar -->
@include('layouts.navbar')

<!-- Main Content -->
<div class="main-content container">
    <div class="row">
        @foreach($data as $item)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card photo-card">
                    <img src="{{$item->image}}" alt="Photo Placeholder" />
                    <div class="card-body">
                        <h5 class="card-title">{{$item->title}}</h5>
                        <p class="card-text">{{$item->yazi}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Footer -->
@include('layouts.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
