@extends('admin.tema.capp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Etkinlik Düzenle</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{ $event->title }}</h3>
                        </div>
                        <form action="{{ route('admin.club_events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                @if($event->image)
                                    <div class="mb-4">
                                        <label>Mevcut Afiş:</label><br>
                                        <img src="{{ asset($event->image) }}" class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-8 form-group">
                                        <label>Etkinlik Başlığı <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>Etkinlik Tarihi <span class="text-danger">*</span></label>
                                        <input type="date" name="event_date" class="form-control" value="{{ $event->event_date }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Yeni Afiş Yükle (Değiştirmek istemiyorsanız boş bırakın)</label>
                                    <input type="file" name="image" class="form-control-file" accept="image/*">
                                </div>

                                <div class="form-group mt-4">
                                    <label>Etkinlik Detayları / Açıklama</label>
                                    <textarea name="content" class="form-control ckeditor" id="content" rows="10">{{ $event->content }}</textarea>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('admin.club_events.index') }}" class="btn btn-secondary">İptal</a>
                                <button type="submit" class="btn btn-info"><i class="fas fa-check"></i> Güncelle</button>
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
        });
    </script>
@endsection
