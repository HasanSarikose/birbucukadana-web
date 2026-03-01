@extends('admin/tema.tapp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yeni Kulüp ve Yönetici Ekle</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Kulüp Ekle</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mx-auto">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Kulüp ve Yetkili Bilgileri</h3>
                        </div>

                        <form action="{{ route('admin.clubs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <h5 class="text-info border-bottom pb-2 mb-3">1. Kulüp Bilgileri</h5>

                                <div class="form-group">
                                    <label for="club_name">Kulüp Adı <span class="text-danger">*</span></label>
                                    <input type="text" name="club_name" class="form-control" id="club_name" placeholder="Örn: Yapay Zeka Kulübü" required value="{{ old('club_name') }}">
                                </div>

                                <div class="form-group">
                                    <label for="about">Hakkında (Opsiyonel)</label>
                                    <textarea name="about" class="form-control" id="about" rows="3" placeholder="Kulüp hakkında kısa bir açıklama...">{{ old('about') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="logo">Kulüp Logosu (Opsiyonel)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="logo" class="custom-file-input" id="logo" accept="image/png, image/jpeg, image/jpg">
                                            <label class="custom-file-label" for="logo">Dosya Seçin</label>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="text-info border-bottom pb-2 mb-3 mt-5">2. Kulüp Yöneticisi (Admin) Bilgileri</h5>
                                <p class="text-muted text-sm">Bu bilgiler ile kulüp yöneticisi sisteme giriş yapabilecektir.</p>

                                <div class="form-group">
                                    <label for="user_name">Yönetici Adı Soyadı <span class="text-danger">*</span></label>
                                    <input type="text" name="user_name" class="form-control" id="user_name" placeholder="Örn: Ahmet Yılmaz" required value="{{ old('user_name') }}">
                                </div>

                                <div class="form-group">
                                    <label for="email">Giriş E-Posta Adresi <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Örn: iletisim@yapayzeka.com" required value="{{ old('email') }}">
                                </div>

                                <div class="form-group">
                                    <label for="password">Giriş Şifresi <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="En az 6 karakter" required>
                                </div>

                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Kulübü ve Yöneticiyi Kaydet</button>
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
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endsection
