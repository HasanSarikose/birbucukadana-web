@extends('layouts.app')

@section('title', 'Anasayfa')

@section('content')
    @php
    $anasayfa = \Illuminate\Support\Facades\DB::table('anasayfa')->get();
    $duyuru = \Illuminate\Support\Facades\DB::table('duyuru')->get();
 @endphp
    <div class="text-center">
        @foreach($anasayfa as $item)
            <img src="{{ asset($item->image) }}" alt="Resim" class="img-fluid rounded">
            <h1 class="mt-2">{{ $item->baslik }}</h1>
            <p class="mt-3">{{ $item->anasayfa }}</p>
        @endforeach
    </div>

    <div class="announcements mt-4">
        <h2 class="text-center mb-2">Duyurular</h2>
        @foreach($duyuru as $item)
            <div class="announcement-slide active">
                <img src="{{ asset($item->image) }}" alt="Duyuru" class="img-fluid">
                <div class="announcement-caption">{{ $item->baslik }}: {{ $item->aciklama }}</div>
            </div>
        @endforeach
    </div>
@endsection
