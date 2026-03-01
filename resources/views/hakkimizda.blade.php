@php
    use App\Models\Hakkimizda;
    use App\Models\PasttoNow;
    $hakkimizda = Hakkimizda::all();
    $post = PasttoNow::all();
 @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hakkımızda - Bir Buçuk Adana</title>
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
            padding: 100px 15px;
            flex: 1;
        }
        .intro-section {
            text-align: center;
            margin-bottom: 50px;
        }
        .intro-section img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            margin-bottom: 50px;
        }
        .intro-section p {
            font-size: 1rem;
            line-height: 1.4;
            background-color: #161b22;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            max-width: 80%;
            margin: 0 auto;
        }
        .timeline {
            position: relative;
            margin: 50px 0;
            padding-left: 30px;
        }
        .timeline::before {
            content: "";
            position: absolute;
            left: 15px;
            top: 0;
            height: 100%;
            width: 4px;
            background: #58a6ff;
        }
        .timeline-item {
            position: relative;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 50px;
        }
        .timeline-item img {
            max-width: 300px;
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            order: 1;
        }
        .timeline-item div {
            flex-grow: 1;
            background-color: #161b22;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            font-size: 1rem;
            line-height: 1.6;
            order: 2;
            position: relative;
        }
        .timeline-date {
            position: absolute;
            left: -100px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #0d1117;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: #c9d1d9;
            font-weight: bold;
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
            .intro-section {
                text-align: center;
            }
            .timeline-item {
                flex-direction: column;
            }
            .timeline-date {
                position: static;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
<!-- Navbar -->
@include('layouts.navbar')

<!-- Main Content -->
<div class="main-content">
    <!-- Intro Section -->
    @foreach($hakkimizda as $item)
    <div class="intro-section">
        <img src="{{$item->image}}" alt="Team Image" />
        <p>
            {{$item->hakkimizda}}
        </p>
    </div>
    @endforeach
    <!-- Timeline Section -->
    <div class="timeline">
        <h3 class="mb-4">Geçmişten Günümüze Bir Buçuk Adana</h3>

        @foreach($post as $item)
            <div class="timeline-item">
                <img src="{{ $item->image }}" alt="Image" />
                <div class="timeline-content">
                    <strong>{{ $item->baslik }}</strong>
                    <p>{{ $item->yazi }}</p>
                </div>
            </div>
        @endforeach
    </div>
        {{--
        <div class="timeline-item">
            <img src="../../../../../../public/assets/images/placeholder.png" alt="2016 Image" />
            <div>
                <strong>2016 - Shell Eco-marathon Katılımı</strong>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore eius, ducimus vel natus commodi quod. Adipisci nam sit ut fugit. Reiciendis ex nisi aliquid rem! Veritatis ut nulla corrupti reiciendis?
                </p>
            </div>
        </div>
        <div class="timeline-item">
            <img src="../../../../../../public/assets/images/placeholder.png" alt="2013 Image" />
            <div>
                <strong>2013 - Kuruluş</strong>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veritatis voluptatibus iusto mollitia maiores, minima esse ullam vero quod eius consequatur et sequi corrupti ab repellendus quia eaque? Ea, veniam deserunt!
                </p>
            </div>
        </div>
        --}}
    </div>
</div>

<!-- Footer -->
@include('layouts.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
