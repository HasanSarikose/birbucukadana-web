@extends('admin/tema.tapp')

@section('customCSS')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .file-upload-input {
            border: 2px dashed #dee2e6;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .file-upload-input:hover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }
        .preview-image {
            max-width: 150px;
            margin-top: 10px;
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Yeni Sponsor Ekle</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('SponsorEklePost')}}" method="post" enctype="multipart/form-data" id="sponsorForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Takım ID</label>
                                    <input type="number"
                                           class="form-control"
                                           name="team_id"
                                           required
                                           placeholder="Takım ID giriniz">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sponsorluk Paketi</label>
                                    <select name="package_id"
                                            class="form-control select2"
                                            style="width: 100%;"
                                            required>
                                        <option value="">Paket Seçiniz</option>
                                        @foreach ($paket as $package)
                                            <option value="{{ $package->id }}">
                                                {{ $package->order }}. {{ $package->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sponsor İsmi</label>
                                    <input type="text"
                                           class="form-control"
                                           name="name"
                                           required
                                           placeholder="Sponsor şirket adını giriniz">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sponsor Logosu</label>
                                    <div class="file-upload-input" onclick="document.getElementById('logoInput').click()">
                                        <i class="fas fa-cloud-upload-alt fa-2x text-muted"></i>
                                        <p class="mb-0">Dosya sürükleyin veya tıklayın</p>
                                        <small class="text-muted">(PNG/JPG/JPEG)</small>
                                        <input type="file"
                                               name="logo_path"
                                               id="logoInput"
                                               hidden
                                               required
                                               accept="image/*">
                                    </div>
                                    <img id="preview" class="preview-image" alt="Logo Önizleme">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12 text-right">
                                <a href="{{route('dashboard')}}" class="btn btn-lg btn-secondary mr-2">
                                    <i class="fas fa-times-circle"></i> Vazgeç
                                </a>
                                <button type="submit" class="btn btn-lg btn-primary">
                                    <i class="fas fa-save"></i> Kaydet
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
    <!-- InputMask -->
    <script src="{{asset('assets/back/')}}/plugins/moment/moment.min.js"></script>
    <script src="{{asset('assets/back/')}}/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- Select2 -->
    <script src="{{asset('assets/back/')}}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            // Select2 Initialization
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: "Paket seçiniz",
                allowClear: true
            });

            // Image Preview
            document.getElementById('logoInput').addEventListener('change', function(e) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').style.display = 'block';
                    document.getElementById('preview').src = e.target.result;
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
