@extends('admin.tema.capp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Fotoğraf Galerisi</h1></div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card card-outline card-primary">
                <div class="card-header"><h3 class="card-title">Yeni Fotoğraf Yükle</h3></div>
                <form action="{{ route('admin.club_gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label>Fotoğraf Seç</label>
                                <input type="file" name="image" id="gallery-photo-add" class="form-control" required onchange="previewImage(this, 'preview-img')">
                                <div class="mt-2">
                                    <img id="preview-img" src="#" alt="Önizleme" style="display: none; width: 100px; height: 60px; object-fit: cover; border: 1px solid #ddd;">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label>Açıklama (Opsiyonel)</label>
                                <input type="text" name="caption" class="form-control" placeholder="Örn: Tanışma Toplantısı 2024">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-upload"></i> Yükle</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card mt-4">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap align-middle">
                        <thead>
                        <tr>
                            <th style="width: 150px">Fotoğraf</th>
                            <th>Açıklama</th>
                            <th>Yükleme Tarihi</th>
                            <th class="text-right">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($images as $img)
                            <tr>
                                <td>
                                    <img src="{{ asset($img->image) }}" class="img-thumbnail" style="width: 100px; height: 60px; object-fit: cover;">
                                </td>
                                <td>{{ $img->caption ?? '-' }}</td>
                                <td>{{ $img->created_at->format('d.m.Y H:i') }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.club_gallery.edit', $img->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="{{ route('admin.club_gallery.destroy', $img->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bu fotoğrafı silmek istediğinize emin misiniz?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">Henüz fotoğraf yüklenmedi.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJS')
    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "#";
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
