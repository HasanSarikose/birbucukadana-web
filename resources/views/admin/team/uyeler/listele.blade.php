@extends('admin/tema.tapp')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Üye Listesi - <b>{{ $selectedYear }}</b></h3>

                        <form action="{{ route('TUyelerListele') }}" method="GET" class="form-inline">
                            <label class="mr-2">Yıl Seçiniz:</label>
                            <select name="year" class="form-control" onchange="this.form.submit()">
                                @foreach($years as $year)
                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                                @if($years->isEmpty())
                                    <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option>
                                @endif
                            </select>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Yıl</th> <th>Ad Soyad</th>
                                <th>Fotoğraf</th> <th>Görev</th>
                                <th>Email</th>
                                <th>LinkedIn</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td><span class="badge badge-info">{{$item->year}}</span></td>
                                    <td>{{$item->name}}</td>

                                    <td>
                                        @if($item->image)
                                            <img src="{{ asset($item->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 50%">
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>

                                    <td>{{$item->task}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        @if($item->linkedin)
                                            <a href="{{$item->linkedin}}" target="_blank"><i class="fab fa-linkedin"></i> Git</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
                                                İşlemler
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('TUyelerEdit', ['id' => $item->id])}}">
                                                    <i class="fas fa-edit"></i> Güncelle
                                                </a>
                                                <a class="dropdown-item text-danger" href="#" onclick="return confirm('Silmek istediğinize emin misiniz?')">
                                                    <i class="fas fa-trash"></i> Sil
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customJS')
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
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
