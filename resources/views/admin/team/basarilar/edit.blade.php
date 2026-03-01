@extends('admin.tema.app')

@section('customCSS')
    <link rel="stylesheet" href="{{ asset('assets/back/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Başarıyı Düzenle</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('basarilareditPost', $basari->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Takım İsmi</label>
                                <input type="text" class="form-control" value="{{ $team->name ?? 'Takım Bulunamadı' }}" readonly>
                            </div>

                            <div class="col-sm-6">
                                <label>Takım ID</label>
                                <input type="text" class="form-control" name="team_id" value="{{ $team->id }}" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>Başlık</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title', $basari->title) }}" required>
                            </div>

                            <div class="col-sm-6">
                                <label>Açıklama</label>
                                <textarea class="form-control" name="description" rows="3" required>{{ old('description', $basari->description) }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>Mevcut Fotoğraf</label>
                                @if($basari->image)
                                    <div class="mb-2">
                                        <img src="{{ asset($basari->image) }}" alt="Başarı Görseli" class="img-fluid" id="preview-image">
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="image" id="image-input">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-1">
                                <a href="{{ route('teamdashboard') }}" class="btn btn-secondary">Vazgeç</a>
                            </div>
                            <div class="col-sm-10 text-center"></div>
                            <div class="col-sm-1 text-right">
                                <button type="submit" class="btn btn-primary">Güncelle</button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
    <script src="{{ asset('assets/back/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        document.getElementById('image-input').addEventListener('change', function (event) {
            let reader = new FileReader();
            reader.onload = function () {
                let output = document.getElementById('preview-image');
                if (output) {
                    output.src = reader.result;
                }
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
@endsection
