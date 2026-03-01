@extends('admin/tema.app')

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
                    <h3 class="card-title">Takım Güncelle</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('takimeklePost') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold">Takım Bilgileri</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Takım Adı <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control bg-light" name="name" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Sosyal Medya Bilgileri</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Web Sitesi Linki </label>
                                        <input type="text" class="form-control" name="website">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>İnstagram Linki </label>
                                        <input type="text" class="form-control" name="instagram">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Linkedin Linki </label>
                                        <input type="text" class="form-control" name="linkedin">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-primary mb-3">Logo Yükle</label>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card border-0 shadow-lg hover-shadow">
                                        <div class="card-body p-5">
                                            <div class="upload-container text-center"
                                                 id="uploadContainer"
                                                 style="border: 3px dashed #dee2e6; border-radius: 15px; background: #f8f9fa; min-height: 300px; cursor: pointer; transition: all 0.3s ease;"
                                                 ondragover="handleDragOver(event)"
                                                 ondrop="handleDrop(event)"
                                                 onclick="document.getElementById('logoUpload').click()">

                                                <div id="uploadContent" class="py-5">
                                                    <i class="fas fa-cloud-upload-alt fa-4x text-muted mb-4"></i>
                                                    <h3 class="text-dark mb-2">Logo Yükle</h3>
                                                    <p class="text-muted mb-0">
                                                        Sürükle bırak yapın veya tıklayın<br>
                                                        <span class="small">(PNG, JPG, JPEG - Max 5MB)</span>
                                                    </p>
                                                </div>

                                                <img id="newLogoPreview"
                                                     class="img-fluid rounded-lg shadow mt-4 preview-zoom"
                                                     style="max-height: 250px; display: none; transition: transform 0.3s ease;">
                                            </div>

                                            <input type="file"
                                                   name="logo"
                                                   id="logoUpload"
                                                   class="d-none"
                                                   accept="image/*"
                                                   onchange="previewLogo(event)">
                                        </div>
                                    </div>

                                    <!-- Dosya Bilgisi -->
                                    <div class="text-center mt-3">
                                        <small class="text-muted" id="fileInfo"></small>
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
        function previewLogo(event) {
            const input = event.target;
            const container = document.getElementById('uploadContainer');
            const preview = document.getElementById('newLogoPreview');
            const uploadContent = document.getElementById('uploadContent');
            const fileInfo = document.getElementById('fileInfo');

            if(input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();

                // Dosya bilgilerini göster
                fileInfo.innerHTML = `
            <i class="fas fa-file-image"></i>
            ${file.name} - ${(file.size/1024/1024).toFixed(2)}MB
        `;

                // Görsel önizleme
                reader.onload = function(e) {
                    preview.style.display = 'block';
                    preview.src = e.target.result;
                    uploadContent.style.display = 'none';
                    container.style.borderColor = '#28a745';
                    container.style.background = '#e8f5e9';
                }

                reader.readAsDataURL(file);
            }
        }

        function handleDragOver(e) {
            e.preventDefault();
            e.stopPropagation();
            e.dataTransfer.dropEffect = 'copy';
            e.currentTarget.style.borderColor = '#007bff';
        }

        function handleDrop(e) {
            e.preventDefault();
            e.stopPropagation();
            const files = e.dataTransfer.files;
            document.getElementById('logoUpload').files = files;
            previewLogo({ target: document.getElementById('logoUpload') });
        }
    </script>
@endsection
