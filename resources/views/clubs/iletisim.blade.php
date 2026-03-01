@extends('layouts.cmaster')

@section('title', $club->name . ' - İletişim')

@section('customCSS')
    <style>
        .contact-card {
            max-width: 800px;
            margin: 50px auto;
            background-color: #161b22;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            padding: 40px;
            text-align: center;
        }
        .social-icons a {
            display: inline-block;
            margin: 0 15px;
            font-size: 3rem;
            transition: transform 0.3s, opacity 0.3s;
        }
        .social-icons a:hover {
            transform: scale(1.1);
            opacity: 0.8;
        }
    </style>
@endsection

@section('content')
    <div class="main-content container">
        <div class="contact-card">

            <h2 style="color: #58a6ff; margin-bottom: 30px;">
                <i class="fas fa-address-book"></i> {{ $club->name }} İletişim
            </h2>

            <p style="color: #8b949e; font-size: 1.2rem; margin-bottom: 40px;">
                Kulübümüzle iletişime geçmek ve bizi sosyal medyadan takip etmek için aşağıdaki bağlantıları kullanabilirsiniz.
            </p>

            <div class="social-icons">
                @if($club->instagram)
                    <a href="{{ $club->instagram }}" target="_blank" style="color: #E1306C;" title="Instagram"><i class="fab fa-instagram"></i></a>
                @endif

                @if($club->linkedin)
                    <a href="{{ $club->linkedin }}" target="_blank" style="color: #0077b5;" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                @endif

                @if($club->twitter)
                    <a href="{{ $club->twitter }}" target="_blank" style="color: #1DA1F2;" title="Twitter"><i class="fab fa-twitter"></i></a>
                @endif

                @if($club->youtube)
                    <a href="{{ $club->youtube }}" target="_blank" style="color: #FF0000;" title="YouTube"><i class="fab fa-youtube"></i></a>
                @endif

                @if($club->nsosyal)
                    <a href="{{ $club->nsosyal }}" target="_blank" style="color: #c9d1d9;" title="Web / Diğer"><i class="fas fa-link"></i></a>
                @endif
            </div>

            @if(!$club->instagram && !$club->linkedin && !$club->twitter && !$club->youtube && !$club->nsosyal)
                <div class="alert alert-secondary mt-4" style="background-color: #0d1117; color: #c9d1d9; border: 1px solid #30363d;">
                    Henüz iletişim bilgisi eklenmemiştir.
                </div>
            @endif

        </div>
    </div>
@endsection
