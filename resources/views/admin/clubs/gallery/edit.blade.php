@extends('admin.tema.capp')

@section('content')
    <section class="content-header">
        <div class="container-fluid"><h1>Fotoğrafı Düzenle</h1></div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card card-info">
                        <form action="{{ route('admin.club_gallery.update', $image->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group text-center mb-4">
                                    <label class="d-block">Mevcut Fotoğraf</label>
                                    <img src="{{ asset($image->image) }}" class="img-thumbnail" style="max-height: 250px;">
                                </div>

                                <div class="form-group">
                                    <label>Fotoğrafı Değiştir (İstemiyorsanız boş bırakın)</label>
                                    <input type="file" name="image" class="form-control" onchange="previewImage(this, 'edit-preview')">
                                    <div class="mt-2">
                                        <img id="edit-preview" src="#" alt="Yeni Fotoğraf Önizleme" style="display: none; width: 150px; height: 90px; object-fit: cover; border: 2px solid #17a2b8;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Fotoğraf Açıklaması</label>
                                    <input type="text" name="caption" class="form-control" value="{{ $image->caption }}">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('admin.club_gallery.index') }}" class="btn btn-secondary">İptal</a>
                                <button type="submit" class="btn btn-info">Değişiklikleri Kaydet</button>
                            </div>
                        </form>
                    </div>
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
