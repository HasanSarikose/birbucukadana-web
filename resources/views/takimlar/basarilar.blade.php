<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$team->team_name}} - Başarılar</title>
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
        .achievement {
            background-color: #161b22;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            text-align: center;
            color: #8b949e;
        }
        .achievement img {
            width: 100%;
            max-width: 400px;
            height: auto;
            margin-bottom: 15px;
        }
        .achievement h4 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: #c9d1d9;
        }
        .achievement p {
            font-size: 1rem;
            margin-bottom: 15px;
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
@include('layouts.tnavbar')

<!-- Main Content -->
<div class="main-content container">
    <div class="row g-4">
        <!-- Achievement 1 -->
        @foreach($achievements as $achievement)
            <div class="col-lg-4 col-md-6 col-12">
                <div class="achievement">
                    <img src="{{ asset($achievement->image) }}" alt="{{ $achievement->title }}" />
                    <h4>{{ $achievement->title }}</h4>
                    <p>{{ $achievement->description }}</p>
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
