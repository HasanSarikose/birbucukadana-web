@extends('layouts.cmaster')

@section('title', $club->name . ' - Galeri')

@section('customCSS')
    <style>
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            cursor: pointer;
            height: 250px;
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
            text-align: center;
        }
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
    </style>
@endsection

@section('content')
    <div class="container pb-5">
        <div class="text-center mb-5">
            <h1 style="color: #58a6ff;"><i class="fas fa-images"></i> Fotoğraf Galerisi</h1>
            <p style="color: #8b949e;">{{ $club->name }} kulübünden kareler.</p>
        </div>

        <div class="row">
            @forelse($club->galleries as $img)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="gallery-item" data-toggle="modal" data-target="#imageModal{{ $img->id }}">
                        <img src="{{ asset($img->image) }}" alt="{{ $img->caption }}">
                        @if($img->caption)
                            <div class="gallery-overlay">{{ $img->caption }}</div>
                        @endif
                    </div>
                </div>

                <div class="modal fade" id="imageModal{{ $img->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style="background: transparent; border: none;">
                            <div class="modal-body p-0 text-center">
                                <img src="{{ asset($img->image) }}" class="img-fluid rounded shadow-lg">
                                @if($img->caption)
                                    <p class="text-white mt-3" style="font-size: 1.2rem;">{{ $img->caption }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">Henüz fotoğraf eklenmedi.</div>
            @endforelse
        </div>
    </div>
@endsection
