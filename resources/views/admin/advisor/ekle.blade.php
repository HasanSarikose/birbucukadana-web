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
                    <form action="{{route('advisoreklePost')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        </div>

                        <div class="row">
                        </div>

                        <div class="row">
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Danışman Fotoğraf Yükle</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <br>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Danışman Ad-Soyad Ekle</label>
                                    <textarea class="form-control" rows="3" name="name" id="name" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Danışman Email Ekle</label>
                                    <textarea class="form-control" rows="3" name="email" id="email" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Danışman Linkedin Adresi Ekle</label>
                                    <textarea class="form-control" rows="3" name="linkedin" id="linkedin" required></textarea>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Danışman Görev Ekle</label>
                                    <textarea class="form-control" rows="3" name="task" id="task" required></textarea>
                                </div>
                            </div>
                            <br>
                        </div>


                        <hr>

                        <hr>

                        <div class="row">
                            <div class="col-sm-1 text-left">

                                <a href="{{url('admin/dashboard')}}" class="btn btn-secondary"> Vazgeç </a>
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

