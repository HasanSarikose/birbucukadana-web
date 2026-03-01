@extends('admin/tema.tapp')

@section('customCSS')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Araç Düzenle</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('aracUpdate', ['id' => $arac->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Takım Bilgileri -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Takım İsmi</label>
                                    <input type="text" class="form-control" value="{{ $team->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Takım ID</label>
                                    <input type="text" class="form-control" name="team_id" value="{{ $team->id }}" required>
                                </div>
                            </div>

                            <!-- Araç Yılı -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Araç Yılı</label>
                                    <input type="number" class="form-control" name="year" value="{{ $arac->year }}" required>
                                </div>
                            </div>

                            <!-- Araç Başlığı -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Araç Başlığı</label>
                                    <input type="text" class="form-control" name="baslik" value="{{ $arac->baslik }}" required>
                                </div>
                            </div>

                            <!-- Fotoğraf Alanı -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mevcut Fotoğraf</label><br>
                                    @if($arac->image)
                                        <img src="{{ asset($arac->image) }}" class="img-thumbnail" style="max-height: 200px;">
                                    @else
                                        <div class="text-muted">Fotoğraf bulunamadı</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Yeni Fotoğraf Yükle (Opsiyonel)</label>
                                    <input type="file" class="form-control-file" name="image" accept="image/*">
                                    <small class="form-text text-muted">
                                        Sadece JPG, PNG veya JPEG formatları (Max 2MB)
                                    </small>
                                </div>
                            </div>

                            <!-- Açıklama -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Araç Açıklaması</label>
                                    <textarea class="form-control" rows="5" name="aciklama" required>{{ $arac->aciklama }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <a href="{{ route('teamdashboard') }}" class="btn btn-secondary">Vazgeç</a>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button type="submit" class="btn btn-primary">Güncelle</button>
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
        $(function () {
            // Select2 aktivasyonu
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@endsection
