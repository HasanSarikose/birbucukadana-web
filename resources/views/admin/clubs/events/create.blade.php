@extends('admin.tema.capp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yeni Etkinlik Ekle</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Etkinlik Bilgileri</h3>
                        </div>
                        <form action="{{ route('admin.club_events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-8 form-group">
                                        <label>Etkinlik Başlığı <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" required placeholder="Örn: Yapay Zeka Zirvesi 2026">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Etkinlik Tarihi <span class="text-danger">*</span></label>
                                        <input type="date" name="event_date" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Afiş / Kapak Fotoğrafı</label>
                                    <input type="file" name="image" class="form-control-file" accept="image/*">
                                </div>

                                <div class="form-group mt-4">
                                    <label>Etkinlik Detayları / Açıklama</label>
                                    <textarea name="content" class="form-control ckeditor" id="content" rows="10"></textarea>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('admin.club_events.index') }}" class="btn btn-secondary">İptal</a>
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Etkinliği Kaydet</button>
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
        CKEDITOR.replace('content', {
            height: 300,
            // İstersen resim yükleme rotasını buraya da ekleyebilirsin
        });
    </script>
@endsection
