@extends('layouts.cmaster')

@section('title', $event->title . ' - ' . $club->name)

@section('customCSS')
    <style>
        .event-detail-card {
            background-color: #161b22;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            padding: 40px;
            color: #c9d1d9;
        }
        .event-detail-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        /* CKEditor içeriklerinin düzgün görünmesi için */
        .ck-content-area img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin: 15px 0;
        }
        .ck-content-area a {
            color: #58a6ff;
        }
    </style>
@endsection

@section('content')
    <div class="main-content container pb-5">

        <div class="mb-4">
            <a href="{{ route('kulup.etkinlikler', $club->slug) }}" class="btn btn-outline-light btn-sm rounded-pill">
                <i class="fas fa-arrow-left"></i> Tüm Etkinliklere Dön
            </a>
        </div>

        <div class="event-detail-card">
            @if($event->image)
                <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="event-detail-image">
            @endif

            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4" style="border-color: #30363d !important;">
                <h1 style="color: #58a6ff; margin:0;">{{ $event->title }}</h1>
                <span class="badge badge-info" style="font-size: 1rem; background-color: #1f6feb; border: 1px solid #58a6ff;">
                <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('d.m.Y') }}
            </span>
            </div>

            <div class="ck-content-area" style="font-size: 1.1rem; line-height: 1.8;">
                {!! $event->content !!}
            </div>

        </div>
    </div>
@endsection
