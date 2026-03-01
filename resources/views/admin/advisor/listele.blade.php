@php
    use App\Models\Advisor;
    $data = Advisor::all();
@endphp
@extends('admin/tema.app')

@section('customCSS')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection


@section('content')

    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    {{--}<h3 class="card-title">{{$title}}</h3>--}}

                    <div class="card-tools">

                    </div>
                </div>
                <div class="card-body">
                    {{--
                    <form action="{{route('pasttonowarama')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Geçmişten Günümüze Adı</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>



                        </div>


                        <hr>


                        <div class="row">
                            <div class="col-sm-1 text-left">
                                <a class="btn btn-warning" href="{{route('dashboard')}}">Geri</a>
                            </div>
                            <div class="col-sm-10 text-center"></div>
                            <div class="col-sm-1 text-right">
                                <button type="submit" class="btn btn-primary">Listele</button>
                            </div>
                        </div>

                    </form>
--}}
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Ad-Soyad</th>
                                    <th>Mail</th>
                                    <th>Linkedin</th>
                                    <th>Görev</th>
                                    <th>Fotoğraf</th>
                                    <th>İşlem</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->mail}}</td>
                                        <td>{{$item->linkedin}}</td>
                                        <td>{{$item->task}}</td>
                                        <td>{{$item->image}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning">İşlemler</button>
                                                <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item" href="{{route('advisoredit',['id'=>$item->id])}}">Güncelle</a>
                                                    {{--<a class="dropdown-item" href="{{route('sponsor_not',['id'=>$item->id])}}">Not İşlemleri</a>--}}
                                                    <a class="dropdown-item" href="#">Sil</a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Ad-Soyad</th>
                                    <th>Mail</th>
                                    <th>Linkedin</th>
                                    <th>Görev</th>
                                    <th>Fotoğraf</th>
                                    <th>İşlem</th>
                                </tr>
                                </tfoot>
                            </table>


                        </div>
                    </div>
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
    <script src="{{asset('back/')}}/plugins/moment/moment.min.js"></script>
    <script src="{{asset('back/')}}/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- Select2 -->
    <script src="{{asset('back/')}}/plugins/select2/js/select2.full.min.js"></script>


    <!-- DataTables  & Plugins -->
    <script src="{{asset('back/')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('back/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('back/')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('back/')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('back/')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('back/')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('back/')}}/plugins/jszip/jszip.min.js"></script>
    <script src="{{asset('back/')}}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{asset('back/')}}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{asset('back/')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('back/')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('back/')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

        });
    </script>


@endsection



