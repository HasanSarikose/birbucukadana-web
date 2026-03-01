@php
    use App\Models\Advisor;
    $data = Advisor::all();
 @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danışmanlar - Bir Buçuk Adana</title>
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
        .advisor-card {
            background-color: #161b22;
            border: none;
            border-radius: 10px;
            color: #c9d1d9;
            margin-bottom: 30px;
            height: 100%; /* Kartın tamamını kullanmasını sağlıyoruz */
            display: flex;
            flex-direction: column; /* İçerik ve fotoğrafı dikey sırayla yerleştiriyoruz */
        }

        .advisor-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;


        }

        .advisor-card h5 {
            margin-top: 15px;
        }

        .advisor-card .social-icons a {
            color: #8b949e;
            margin: 0 5px;
        }

        .advisor-card .social-icons a:hover {
            color: #58a6ff;
        }

        .social-icons {
            display: flex;
            gap: 20px;
            align-items: center;
            justify-content: center;
        }

        .social-icon {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: black;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.05);
        }

        .social-icon i {
            margin-right: 8px;
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
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card advisor-card">
                    <img src="{{$item->image}}" class="card-img-top" alt="Advisor 1" />
                    <div class="card-body">
                        <h5 class="card-title">{{$item->name}}</h5>
                        <p class="card-text">{{$item->task}}</p>
                        <div class="social-icons">
                            <!-- LinkedIn Icon -->
                            <a href="{{$item->linkedin}}" target="_blank" class="social-icon">
                                <i class="fab fa-linkedin"></i> LinkedIn
                            </a>

                            <!-- Email Icon with Tooltip -->
                            <a href="mailto:{{$item->email}}" target="_blank" class="social-icon" title="E-posta gönder">
                                <i class="fas fa-envelope"></i> {{$item->email}}
                            </a>
                        </div>
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
