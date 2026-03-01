@extends('layouts.cmaster')

@section('title', $club->name . ' - 1.5 Adana')

@section('customCSS')
    <style>
        .club-intro { text-align: center; margin-bottom: 20px; }
        .club-intro h1 { font-size: 2.5rem; margin-bottom: 15px; }

        .club-photo { text-align: center; margin-bottom: 30px; }
        .club-photo img { max-width: 100%; height: auto; border-radius: 10px; max-height: 400px; object-fit: cover; }

        .club-card {
            max-width: 900px; margin: 0 auto;
            background-color: #161b22;
            border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            padding: 35px;
        }

        /* CKEditor'den gelen metinlerin rengi ve boyutu temaya uygun olsun */
        .club-card p, .club-card span, .club-card div {
            font-size: 1.15rem !important;
            color: #c9d1d9 !important;
            text-align: justify;
            line-height: 1.8;
        }

        @media (max-width: 768px) {
            .club-intro h1 { font-size: 2rem; }
            .club-card { padding: 20px; }
        }
    </style>
@endsection

@section('content')
    <div class="main-content container">

        <div class="club-intro">
            <h1>{{ $club->name }} - Bir Buçuk Adana</h1>
        </div>

        @if($club->logo)
            <div class="club-photo">
                <img src="{{ asset($club->logo) }}" alt="{{ $club->name }} Logosu" />
            </div>
        @endif

        <div class="club-card">
            @if($club->about)
                {!! $club->about !!}
            @else
                <p class="text-center text-muted" style="font-style: italic;">
                    Bu kulüp henüz detaylı bir tanıtım yazısı eklememiştir.
                </p>
            @endif
        </div>

    </div>
@endsection
