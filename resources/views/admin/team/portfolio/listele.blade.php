@extends('admin/tema.tapp')

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
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Team İD</th>
                                    <th>İmage</th>
                                    <th>Başlık/İsim</th>
                                    <th>Özellik 1</th>
                                    <th>Özellik 2</th>
                                    <th>Özellik 3</th>
                                    <th>Özellik 4</th>
                                    <th>Özellik 5</th>
                                    <th>İşlem</th>

                                </tr>
                                </thead>
                                <tbody>
                                @forelse($urun as $item)
                                    <tr>
                                        <td>{{ $item->team_id }}</td>
                                        <td>
                                            @if($item->image)
                                                <img src="{{ asset($item->image) }}" width="50">
                                            @else
                                                <span class="text-muted">Resim Yok</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->feature1 }}</td>
                                        <td>{{ $item->feature2 }}</td>
                                        <td>{{ $item->feature3 }}</td>
                                        <td>{{ $item->feature4 }}</td>
                                        <td>{{ $item->feature5 }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('portfolioEdit', $item->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('portfolioSil', ['id' => $item->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Silmek istediğinize emin misiniz?')">
                                                        Sil
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Kayıt bulunamadı</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Team İD</th>
                                    <th>İmage</th>
                                    <th>Başlık/İsim</th>
                                    <th>Özellik 1</th>
                                    <th>Özellik 2</th>
                                    <th>Özellik 3</th>
                                    <th>Özellik 4</th>
                                    <th>Özellik 5</th>
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



