@extends('admin/tema.tapp')

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
                    <form action="{{ route('araceklePost') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Takım ID</label>
                                    <input type="number" class="form-control" name="team_id" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Araç Yılı</label>
                                    <input type="number" class="form-control" name="year" required>
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Araç Başlığı</label>
                                    <input type="text" class="form-control" name="baslik" required>
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Araç Fotoğrafı</label>
                                    <input type="file" class="form-control" name="image" accept="image/*" required>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <div class="form-group">
                                    <label>Araç Açıklaması</label>
                                    <textarea class="form-control" rows="4" name="aciklama" required></textarea>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-1">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Vazgeç</a>
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


@endsection


