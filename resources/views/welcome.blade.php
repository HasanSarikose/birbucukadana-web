@php
use App\Models\Duyuru;
use App\Models\Anasayfa;
$anasayfa = Anasayfa::all();
$duyuru = Duyuru::all();
    @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>1.5 Adana</title>
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
            text-align: center;
            flex: 1;
        }
        .main-content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .main-content p {
            font-size: 1.1rem;
            line-height: 1.6;
            text-align: justify;
            max-width: 900px;
            margin: 0 auto;
            padding: 25px;
            background-color: #161b22;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            word-spacing: normal;
        }
        .announcements {
            position: relative;
            width: 60%;
            max-width: 700px;
            height: auto;
            margin: 5px auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        .announcement-slide {
            position: relative;
            display: none;
            text-align: center;
        }
        .announcement-slide.active {
            display: block;
        }
        .announcement-slide img {
            width: 100%;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        .announcement-caption {
            position: absolute;
            bottom: 10px;
            left: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            color: #c9d1d9;
            padding: 10px;
            font-size: 1rem;
            text-align: left;
            border-radius: 5px;
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
            .main-content {
                padding: 30px 15px;
            }
            .main-content p {
                padding: 15px;
                font-size: 1rem;
                line-height: 1.4;
                max-width: 100%;
                box-shadow: none;
            }
            .announcements {
                width: 95%;
            }
            .announcement-slide img {
                height: auto;
                object-fit: contain;
            }
            .announcement-caption {
                font-size: 0.9rem;
                padding: 5px;
            }
        }
    </style>
</head>
<body>
<!-- Navbar -->
@include('layouts.navbar')

<!-- Main Content -->
<div class="main-content">
    @foreach($anasayfa as $item)
    <img src="{{$item->image}}" alt="Placeholder Image" />
    <h1 class="mt-2">{{$item->baslik}}</h1>
    <p class="mt-1">
        {{$item->anasayfa}}
            </p>
</div>
@endforeach
<!-- Announcements Section -->
<div class="announcements">

    <h2 class="text-center mb-2">Duyurular</h2>
    @foreach($duyuru as $item)
    <div class="announcement-slide active">
        <img src="{{$item->image}}" alt="Duyuru 1" />
        <div class="announcement-caption">{{$item->baslik}}: {{$item->aciklama}}</div>
    </div>
        {{--
    <div class="announcement-slide">
        <img src="assets/images/placeholder.png" alt="Duyuru 2" />
        <div class="announcement-caption">Duyuru 2: Yeni sponsorlarımızı duyurmaktan mutluluk duyarız.</div>
    </div>
    <div class="announcement-slide">
        <img src="assets/images/placeholder.png" alt="Duyuru 3" />
        <div class="announcement-caption">Duyuru 3: Takımımız yeni çalışmalara başlıyor!</div>
    </div>
    --}}
        @endforeach
</div>

<!-- Footer -->
@include('layouts.footer')

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.2/firebase-app.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyABsPZfhtfXedAxG1h2rDkofbG5M6sfoFg",
        authDomain: "website-c8df9.firebaseapp.com",
        projectId: "website-c8df9",
        storageBucket: "website-c8df9.firebasestorage.app",
        messagingSenderId: "1001010560917",
        appId: "1:1001010560917:web:a85736b81109b96524809c"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);

    // Custom JS for Announcements Slider
    const slides = document.querySelectorAll('.announcement-slide');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            if (i === index) {
                slide.classList.add('active');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }
    if(slides.length > 0) {
        setInterval(nextSlide, 3000); // Change slide every 5 seconds
    }
</script>
</body>
</html>
