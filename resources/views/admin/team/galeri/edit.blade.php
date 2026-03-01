@extends('admin/tema.tapp')

@section('customCSS')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .image-preview-container {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            background: #f8f9fa;
            min-height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            margin-bottom: 15px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .custom-file-input {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }
        .custom-file-label {
            cursor: pointer;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border-radius: 4px;
            transition: background 0.3s ease;
        }
        .custom-file-label:hover {
            background: #0056b3;
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-primary shadow">
                <div class="card-header">
                    <h3 class="card-title">Fotoğraf Güncelle</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('TGaleriUpdate', ['id' => $galeri->id]) }}" method="POST" enctype="multipart/form-data" id="galleryForm">
                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold">Takım Bilgileri</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Takım Adı</label>
                                        <input type="text" class="form-control bg-light" value="{{ $team->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Takım ID <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="team_id" value="{{ $galeri->team_id }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Fotoğraf Yönetimi</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="image-preview-container">
                                        @if($galeri->image)
                                            <img src="{{ asset($galeri->image) }}" class="image-preview" id="currentImage">
                                        @else
                                            <div class="text-muted mb-3">Mevcut fotoğraf bulunamadı</div>
                                        @endif
                                        <div class="text-muted">Mevcut Fotoğraf</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="image-preview-container" id="newImageContainer">
                                        <label for="imageUpload" class="custom-file-label mb-3">
                                            <i class="fas fa-cloud-upload-alt"></i> Yeni Fotoğraf Yükle
                                        </label>
                                        <input type="file" class="custom-file-input" name="image" id="imageUpload" accept="image/*">
                                        <img src="" class="image-preview" id="newImagePreview" style="display: none;">
                                        <small class="text-muted d-block mt-2">PNG, JPG veya JPEG (Max 5MB)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Fotoğraf Detayları</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Başlık <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="baslik" value="{{ $galeri->baslik }}" required placeholder="Fotoğraf başlığını girin">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Açıklama <span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="4" name="aciklama" required placeholder="Fotoğraf açıklamasını girin">{{ $galeri->aciklama }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Vazgeç
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Değişiklikleri Kaydet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageUpload = document.getElementById('imageUpload');
            const newImagePreview = document.getElementById('newImagePreview');
            const newImageContainer = document.getElementById('newImageContainer');

            imageUpload.addEventListener('change', function(e) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    newImagePreview.style.display = 'block';
                    newImagePreview.src = e.target.result;
                    newImageContainer.querySelector('.text-muted').style.display = 'none';
                }
                if(this.files[0]) {
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection
