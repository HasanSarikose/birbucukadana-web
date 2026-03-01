@extends('admin/tema.capp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yeni Üye Ekle</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Üye Bilgileri</h3>
                        </div>
                        <form action="{{ route('admin.club_members.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Ad Soyad <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required placeholder="Örn: Ahmet Yılmaz">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Unvan / Görev <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" required placeholder="Örn: Kulüp Başkanı">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Üye Fotoğrafı</label>
                                    <input type="file" name="image" class="form-control-file" accept="image/*">
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6 form-group">
                                        <label><i class="fab fa-instagram text-danger"></i> Instagram Linki</label>
                                        <input type="url" name="instagram" class="form-control" placeholder="https://instagram.com/kullaniciadi">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><i class="fab fa-linkedin text-primary"></i> LinkedIn Linki</label>
                                        <input type="url" name="linkedin" class="form-control" placeholder="https://linkedin.com/in/kullaniciadi">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('admin.club_members.index') }}" class="btn btn-secondary">İptal</a>
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Üyeyi Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
