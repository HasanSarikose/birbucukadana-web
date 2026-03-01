@extends('layouts.cmaster')

@section('title', $club->name . ' - Etkinlikler')

@section('customCSS')
    <style>
        .event-card {
            background-color: #161b22;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            transition: transform 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .event-card:hover {
            transform: translateY(-5px);
        }
        .event-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 3px solid #58a6ff;
        }
        .event-body {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .event-date {
            color: #58a6ff;
            font-size: 0.9rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .event-title {
            color: #c9d1d9;
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .event-content {
            color: #8b949e;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        /* GEÇMİŞ ETKİNLİKLER İÇİN ÖZEL EFEKTLER */
        .past-event {
            opacity: 0.7; /* Kartı hafif soluk yapar */
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .past-event:hover {
            opacity: 1; /* Üzerine gelince tekrar canlanır */
        }
        .past-event .event-image {
            border-bottom: 3px solid #8b949e; /* Mavi çizgiyi gri yapar */
            filter: grayscale(60%); /* Fotoğrafı hafif siyah-beyaz yapar */
        }
        .past-event .event-date {
            color: #8b949e; /* Tarih rengini gri yapar */
        }
    </style>
@endsection

@section('content')
    <div class="main-content container pb-5">
        <div class="text-center mb-5">
            <h1 style="color: #58a6ff;"><i class="fas fa-calendar-alt"></i> Etkinlikler ve Duyurular</h1>
            <p style="color: #8b949e; font-size: 1.2rem;">{{ $club->name }} kulübünün tüm faaliyetleri.</p>
        </div>

        @php
            // Bugünün tarihini alıp etkinlikleri ikiye bölüyoruz
            $today = \Carbon\Carbon::today()->toDateString();
            $upcomingEvents = $club->events->where('event_date', '>=', $today);
            $pastEvents = $club->events->where('event_date', '<', $today);
        @endphp

        @if($club->events->count() == 0)
            <div class="col-12 text-center mt-5">
                <div class="alert alert-secondary" style="background-color: #161b22; color: #8b949e; border: none;">
                    <i class="fas fa-info-circle fa-2x mb-3"></i><br>
                    Bu kulüp henüz bir etkinlik veya duyuru paylaşmamıştır.
                </div>
            </div>
        @else

            @if($upcomingEvents->count() > 0)
                <h3 class="mb-4" style="color: #58a6ff; border-bottom: 1px solid #30363d; padding-bottom: 10px;">
                    <i class="fas fa-hourglass-half"></i> Gelecek Etkinlikler
                </h3>
                <div class="row mb-5">
                    @foreach($upcomingEvents as $event)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="event-card">
                                @if($event->image)
                                    <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="event-image">
                                @else
                                    <div class="event-image d-flex align-items-center justify-content-center" style="background-color: #0d1117;">
                                        <i class="fas fa-image fa-3x" style="color: #30363d;"></i>
                                    </div>
                                @endif

                                <div class="event-body">
                                    <div class="event-date"><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('d.m.Y') }}</div>
                                    <div class="event-title">{{ $event->title }}</div>

                                    <div class="event-content">
                                        {{ Str::limit(strip_tags($event->content), 100) }}
                                    </div>

                                    <div class="mt-auto text-right">
                                        <a href="{{ route('kulup.etkinlik_detay', ['slug' => $club->slug, 'event_slug' => $event->slug]) }}" class="btn btn-outline-info btn-sm rounded-pill px-3">
                                            Devamını Oku <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($pastEvents->count() > 0)
                <h3 class="mb-4" style="color: #8b949e; border-bottom: 1px solid #30363d; padding-bottom: 10px;">
                    <i class="fas fa-history"></i> Geçmiş Etkinlikler
                </h3>
                <div class="row">
                    @foreach($pastEvents as $event)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="event-card past-event">
                                @if($event->image)
                                    <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="event-image">
                                @else
                                    <div class="event-image d-flex align-items-center justify-content-center" style="background-color: #0d1117;">
                                        <i class="fas fa-image fa-3x" style="color: #30363d;"></i>
                                    </div>
                                @endif

                                <div class="event-body">
                                    <div class="event-date"><i class="far fa-calendar-check"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('d.m.Y') }}</div>
                                    <div class="event-title">{{ $event->title }}</div>

                                    <div class="event-content">
                                        {{ Str::limit(strip_tags($event->content), 100) }}
                                    </div>

                                    <div class="mt-auto text-right">
                                        <a href="{{ route('kulup.etkinlik_detay', ['slug' => $club->slug, 'event_slug' => $event->slug]) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                                            Detayları Gör <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        @endif
    </div>
@endsection
