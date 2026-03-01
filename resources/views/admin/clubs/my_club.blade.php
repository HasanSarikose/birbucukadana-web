@extends('admin/tema.capp')

@section('customCSS')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kulüp Bilgilerim</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 mx-auto">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">{{ $club->name }} Bilgilerini Güncelle</h3>
                        </div>

                        <form action="{{ route('admin.clubs.update_my_club') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="club-cover-image text-center mb-4" style="position: relative; width: 100%; height: 300px; overflow: hidden; border-radius: 8px; background-color: #f4f6f9;">
                                    @if($club->logo)
                                        <img src="{{ asset($club->logo) }}" alt="Kulüp Kapak Görseli" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div style="display: flex; justify-content: center; align-items: center; height: 100%; color: #adb5bd;">
                                            <i class="fas fa-image fa-4x"></i>
                                        </div>
                                    @endif
                                    <label for="logo" class="btn btn-sm btn-light" style="position: absolute; bottom: 10px; right: 10px; opacity: 0.8; cursor: pointer;">
                                        <i class="fas fa-camera"></i> Görseli Değiştir
                                    </label>
                                    <input type="file" name="logo" id="logo" class="d-none" accept="image/png, image/jpeg, image/jpg">
                                </div>

                                <div class="form-group">
                                    <label for="name">Kulüp Adı</label>
                                    <input type="text" name="name" class="form-control form-control-lg" id="name" value="{{ $club->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="about">Hakkında / Açıklama</label>
                                    <textarea name="about" class="form-control ckeditor" id="about" rows="10">{{ $club->about }}</textarea>
                                </div>

                                <h5 class="text-info border-bottom pb-2 mb-3 mt-4"><i class="fas fa-link"></i> Sosyal Medya Hesapları</h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="instagram">Instagram Linki</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fab fa-instagram text-danger"></i></span>
                                                </div>
                                                <input type="url" name="instagram" class="form-control" id="instagram" value="{{ $club->instagram }}" placeholder="https://instagram.com/kulubunuz">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="linkedin">LinkedIn Linki</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fab fa-linkedin text-primary"></i></span>
                                                </div>
                                                <input type="url" name="linkedin" class="form-control" id="linkedin" value="{{ $club->linkedin }}" placeholder="https://linkedin.com/in/kulubunuz">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="twitter">Twitter (X) Linki</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fab fa-twitter text-info"></i></span>
                                                </div>
                                                <input type="url" name="twitter" class="form-control" id="twitter" value="{{ $club->twitter }}" placeholder="https://twitter.com/kulubunuz">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="youtube">YouTube Linki</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fab fa-youtube text-danger"></i></span>
                                                </div>
                                                <input type="url" name="youtube" class="form-control" id="youtube" value="{{ $club->youtube }}" placeholder="https://youtube.com/c/kulubunuz">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="nsosyal">Nsosyal linki</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-globe text-secondary"></i></span>
                                            </div>
                                            <input type="text" name="nsosyal" class="form-control" id="nsosyal" value="{{ $club->nsosyal }}" placeholder="https://...">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="logo">Yeni Logo Yükle</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="logo" class="custom-file-input" id="logo" accept="image/png, image/jpeg, image/jpg">
                                            <label class="custom-file-label" for="logo">Dosya Seçin</label>
                                        </div>
                                    </div>
                                    <small class="text-muted">Boş bırakırsanız mevcut logonuz değişmez.</small>
                                </div>

                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save"></i> Değişiklikleri Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJS')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <script>
        // CKEditor'ü textarea'ya uygula
        CKEDITOR.replace('about', {
            height: 300, // Editörün yüksekliği
            filebrowserUploadUrl: "{{route('admin.clubs.upload_image', ['_token' => csrf_token() ])}}", // Resim yükleme rotası
            filebrowserUploadMethod: 'form'
        });

        // Kapak görseli üzerindeki dosya seçme inputu değiştiğinde resmin önizlemesini yap
        $('#logo').on('change', function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('.club-cover-image img').attr('src', event.target.result);
                    // Eğer daha önce resim yoksa, img etiketini oluştur
                    if ($('.club-cover-image img').length === 0) {
                        $('.club-cover-image').prepend('<img src="'+event.target.result+'" alt="Kulüp Kapak Görseli" style="width: 100%; height: 100%; object-fit: cover;">');
                        $('.club-cover-image .text-muted').remove(); // "Resim Yok" yazısını kaldır
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
