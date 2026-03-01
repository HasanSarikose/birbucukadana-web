@extends('admin/tema.app')

@section('customCSS')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/back/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection


@section('content')

    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">

                    <div class="card-tools">

                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('galerieditPost', ['id' => $galeri->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        </div>

                        <div class="row">
                        </div>

                        <div class="row">
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Galeri Başlık Düzenle</label>
                                    <textarea class="form-control" rows="3" name="title" id="title" required>{{ old('title', $galeri->title) }}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Duyuru Açıklama Düzenle</label>
                                    <textarea class="form-control" rows="3" name="yazi" id="yazi" required>{{ old('yazi', $galeri->yazi) }}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label>Duyuru Fotoğraf Yükle</label>
                                <!-- Gösterilecek mevcut fotoğraf -->
                                @if($galeri->image)
                                    <div class="mb-3">
                                        <img src="{{ asset($galeri->image) }}" alt="Mevcut Fotoğraf" class="img-fluid" id="preview-image">
                                    </div>
                                @endif
                                <input type="file" name="image" class="form-control" id="image-input">
                            </div>
                            <br>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-1 text-left">
                                <a href="{{route('galerilistele')}}" class="btn btn-secondary"> Vazgeç </a>
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
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
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
        document.getElementById('image-input').addEventListener('change', function(event) {
            let reader = new FileReader();
            reader.onload = function() {
                let output = document.getElementById('preview-image');
                if (output) {
                    output.src = reader.result;
                }
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>


@endsection


