@extends('layouts.cmaster')

@section('title', $club->name . ' - Yönetim Kurulu')

@section('customCSS')
    <style>
        .member-card {
            background-color: #161b22;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            padding: 30px 20px;
            text-align: center;
            transition: transform 0.3s ease;
            height: 100%;
        }
        .member-card:hover {
            transform: translateY(-10px);
        }
        .member-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #58a6ff;
            margin-bottom: 20px;
        }
        .member-name {
            font-size: 1.5rem;
            color: #c9d1d9;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .member-title {
            color: #8b949e;
            font-size: 1.1rem;
            margin-bottom: 15px;
        }
        .member-social a {
            color: #c9d1d9;
            font-size: 1.5rem;
            margin: 0 10px;
            transition: color 0.3s;
        }
        .member-social a:hover {
            color: #58a6ff;
        }
    </style>
@endsection

@section('content')
    <div class="main-content container">

        <div class="text-center mb-5">
            <h1 style="color: #58a6ff;"><i class="fas fa-users"></i> {{ $club->name }} Yönetim Kurulu</h1>
            <p style="color: #8b949e; font-size: 1.2rem;">Kulübümüze değer katan ekibimizle tanışın.</p>
        </div>

        <div class="row justify-content-center">
            @forelse($club->members as $member)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="member-card">
                        @if($member->image)
                            <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" class="member-photo">
                        @else
                            <img src="{{ asset('assets/back/dist/img/avatar.png') }}" alt="Varsayılan Foto" class="member-photo" style="border-color: #8b949e;">
                        @endif

                        <div class="member-name">{{ $member->name }}</div>
                        <div class="member-title">{{ $member->title }}</div>

                        <div class="member-social">
                            @if($member->linkedin)
                                <a href="{{ $member->linkedin }}" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                            @endif
                            @if($member->instagram)
                                <a href="{{ $member->instagram }}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center mt-5">
                    <div class="alert alert-secondary" style="background-color: #161b22; color: #8b949e; border: none;">
                        <i class="fas fa-info-circle fa-2x mb-3"></i><br>
                        Bu kulüp henüz yönetim kurulu üyelerini eklememiştir.
                    </div>
                </div>
            @endforelse
        </div>

    </div>
@endsection
