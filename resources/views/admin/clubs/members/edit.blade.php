@extends('admin/tema.capp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Üye Düzenle</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{ $member->name }} Bilgilerini Güncelle</h3>
                        </div>
                        <form action="{{ route('admin.club_members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                @if($member->image)
                                    <div class="text-center mb-3">
                                        <img src="{{ asset($member->image) }}" class="img-circle elevation-2" style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Ad Soyad <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ $member->name }}" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Unvan / Görev <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" value="{{ $member->title }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Yeni Fotoğraf Yükle (Değiştirmek istemiyorsanız boş bırakın)</label>
                                    <input type="file" name="image" class="form-control-file" accept="image/*">
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6 form-group">
                                        <label><i class="fab fa-instagram text-danger"></i> Instagram Linki</label>
                                        <input type="url" name="instagram" class="form-control" value="{{ $member->instagram }}">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label><i class="fab fa-linkedin text-primary"></i> LinkedIn Linki</label>
                                        <input type="url" name="linkedin" class="form-control" value="{{ $member->linkedin }}">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('admin.club_members.index') }}" class="btn btn-secondary">İptal</a>
                                <button type="submit" class="btn btn-info"><i class="fas fa-check"></i> Güncelle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
