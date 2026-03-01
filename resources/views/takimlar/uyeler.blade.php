<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $team->name }} - Üyeler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
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
        .navbar-brand, .nav-link {
            color: #c9d1d9 !important;
        }
        .nav-link:hover {
            color: #58a6ff !important;
            transition: color 0.3s ease;
        }
        .main-content {
            padding: 50px 15px;
            flex: 1;
        }
        .team-member {
            background-color: #161b22;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            text-align: center;
            color: #8b949e;
        }
        .team-member img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .team-member h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #c9d1d9;
        }
        .team-member p {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }
        .team-member .social-links a {
            color: #c9d1d9;
            margin: 0 10px;
            font-size: 1.5rem;
        }
        .team-member .social-links a:hover {
            color: #58a6ff;
            transition: color 0.3s ease;
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

<!-- Dropdown Menü -->
<!-- Dropdown Menü -->
<div class="container mt-4">
    <div class="dropdown text-center">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="yearDropdown" data-bs-toggle="dropdown">
            {{ $selectedYear ?? 'Yıl Seçin' }} Yılı
        </button>
        <ul class="dropdown-menu" aria-labelledby="yearDropdown">
            @foreach($years as $year)
                <li>
                    <a class="dropdown-item" href="{{ route('takim.uyeler', ['team_slug' => $team->slug, 'year' => $year]) }}">
                        {{ $year }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- Ana İçerik -->
<div class="main-content container">
    <h2 class="text-center text-light mb-4">{{ $selectedYear }} Takım Üyeleri</h2>
    <div class="row g-4">
        @forelse($tuyeler as $tuye)
            <div class="col-lg-3 col-md-6 col-12">
                <div class="team-member">
                    <img src="{{ asset($tuye->image) }}" alt="{{ $tuye->name }}" />
                    <h3>{{ $tuye->name }}</h3>
                    <p>{{ $tuye->task }}</p>
                    <div class="social-icons">
                        <a href="{{ $tuye->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a><br>
                        <a href="mailto:{{ $tuye->email }}"><i class="fas fa-envelope"></i> {{ $tuye->email }}</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Bu yıla ait üye bulunamadı.</p>
        @endforelse
    </div>
</div>

<!-- Footer -->
@include('layouts.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
