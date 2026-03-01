<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$team->name}}</title>
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
        .team-intro {
            text-align: center;
            margin-bottom: 20px;
        }
        .team-intro h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        .team-photo {
            text-align: center;
            margin-bottom: 20px;
        }
        .team-photo img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .team-card {
            max-width: 900px;
            margin: 0 auto;
            background-color: #161b22;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            padding: 25px;
        }
        .team-card p {
            font-size: 1.2rem;
            color: #8b949e;
            text-align: justify;
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
            .team-intro h1 {
                font-size: 2rem;
            }
            .team-card p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
<!-- Navbar -->
@include('layouts.tnavbar')

<!-- Main Content -->
<div class="main-content container">
    <div class="team-intro">
        <h1>{{$team->name }} - Bir Buçuk Adana</h1>
    </div>
    <div class="team-photo">
            <img src="{{ asset($tanasayfa->image)}}" alt="Team1 Fotoğrafı" />
    </div>
    <div class="team-card">
        <p>
           {{$tanasayfa->anasayfa}}
        </p>
    </div>
</div>

<!-- Footer -->
@include('layouts.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

