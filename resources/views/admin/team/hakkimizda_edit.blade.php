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
                    <form action="{{ route('ThakkimizdaUpdate', $thakkimizda->id ?? 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Takım İsmi</label>
                                <input type="text" class="form-control" value="{{ $team->name ?? 'Takım Bulunamadı' }}" readonly>
                            </div>

                            <div class="col-sm-6">
                                <label>Takım ID</label>
                                <input type="text" class="form-control" name="team_id" value="{{ $team->id }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>Başlık</label>
                                <input type="text" class="form-control" name="baslik" value="{{ old('title', $thakkimizda->baslik) }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>Mevcut Fotoğraf</label>
                                @if($thakkimizda->image)
                                    <div class="mb-2">
                                        <img src="{{ asset($thakkimizda->image) }}" alt="Başarı Görseli" class="img-fluid" id="preview-image">
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="image" id="image-input">
                            </div>
                        </div>
                        <div class="row mt-12">
                            <div class="col-sm-6">
                                <label>Hakkimizda</label>
                                <input type="text" class="form-control" name="hakkimizda" value="{{ old('title', $thakkimizda->hakkimizda) }}" required>
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

