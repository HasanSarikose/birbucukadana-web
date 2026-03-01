@extends('admin.tema.app')

@section('customCSS')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/back/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Takım Üyesi Düzenle</h3>
                    <div class="card-tools">
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('TUyelerEdit', $uye->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="form-control" readonly>
                                <strong>Takım İsimi:</strong> {{ $team->name ?? 'Takım Bulunamadı' }}
                            </div>
                            <div class="col-sm-6">
                                <label>Takım ID</label>
                                <input type="text" class="form-control" name="teamid" value="{{ $team->id }}"
                                       readonly>
                            </div>

                            <div class="col-sm-6">
                                <label>Yıl</label>
                                <input type="text" class="form-control" name="year"
                                       value="{{ old('year', $uye->year) }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>İsim</label>
                                <input type="text" class="form-control" name="name"
                                       value="{{ old('name', $uye->name) }}" required>
                            </div>

                            <div class="col-sm-6">
                                <label>Görev</label>
                                <input type="text" class="form-control" name="task"
                                       value="{{ old('task', $uye->task) }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>E-posta</label>
                                <input type="email" class="form-control" name="email"
                                       value="{{ old('email', $uye->email) }}" required>
                            </div>

                            <div class="col-sm-6">
                                <label>LinkedIn</label>
                                <input type="text" class="form-control" name="linkedin"
                                       value="{{ old('linkedin', $uye->linkedin) }}" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>Fotoğraf Yükle</label>
                                @if($uye->image)
                                    <div class="mb-3">
                                        <img src="{{ asset($uye->image) }}" alt="Mevcut Fotoğraf" class="img-fluid"
                                             id="preview-image">
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="image" id="image-input">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-1 text-left">
                                <a href="{{route('teamdashboard')}}" class="btn btn-secondary">Vazgeç</a>
                            </div>
                            <div class="col-sm-10 text-center"></div>
                            <div class="col-sm-1 text-right">
                                <button type="submit" class="btn btn-primary">Kaydet</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
    <script src="{{ asset('assets/back/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/back/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/back/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <script>
        document.getElementById('image-input').addEventListener('change', function (event) {
            let reader = new FileReader();
            reader.onload = function () {
                let output = document.getElementById('preview-image');
                if (output) {
                    output.src = reader.result;
                }
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
@endsection
