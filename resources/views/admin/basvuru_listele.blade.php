@extends('admin/tema.tapp')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Başvuru Listesi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Başvurular</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Bekleyen Başvurular</h3>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th style="width: 1%">#</th>
                                <th style="width: 10%">Fotoğraf</th>
                                <th style="width: 20%">Ad Soyad / Email</th>
                                <th style="width: 15%">Takım</th>
                                <th style="width: 15%">Bölüm / Yıl</th>
                                <th style="width: 15%">Talep Edilen Görev</th>
                                <th style="width: 10%">LinkedIn</th>
                                <th style="width: 15%" class="text-right">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($basvurular as $basvuru)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                @if($basvuru->foto)
                                                    <img alt="Avatar" class="table-avatar" src="{{ asset($basvuru->foto) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                                @else
                                                    <img alt="Avatar" class="table-avatar" src="{{ asset('assets/back/dist/img/avatar.png') }}">
                                                @endif
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <a>{{ $basvuru->ad_soyad }}</a>
                                        <br/>
                                        <small>{{ $basvuru->email }}</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $basvuru->team->name ?? 'Takım ID: '.$basvuru->team_id }}</span>
                                    </td>
                                    <td>
                                        <small>Yıl: {{ $basvuru->year }}</small>
                                    </td>
                                    <td>{{ $basvuru->task }}</td>
                                    <td>
                                        @if($basvuru->linkedin)
                                            <a href="{{ $basvuru->linkedin }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fab fa-linkedin"></i> Profil
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="project-actions text-right">
                                        <div class="d-flex justify-content-end">

                                            <form action="{{ route('admin.basvuru.approve', $basvuru->id) }}" method="POST" class="mr-2">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('{{ $basvuru->ad_soyad }} adlı öğrenciyi takıma eklemek istiyor musunuz?')">
                                                    <i class="fas fa-check"></i> Onayla
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.basvuru.delete', $basvuru->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bu başvuruyu silmek istediğinize emin misiniz?')">
                                                    <i class="fas fa-trash"></i> Sil
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <p class="text-muted mb-0">Şu anda bekleyen başvuru bulunmamaktadır.</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
