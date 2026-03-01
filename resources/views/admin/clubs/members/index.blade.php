@extends('admin/tema.capp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yönetim Kurulu</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Yönetim Kurulu Üyeleri</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.club_members.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Yeni Üye Ekle
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap align-middle">
                        <thead>
                        <tr>
                            <th>Fotoğraf</th>
                            <th>Ad Soyad</th>
                            <th>Unvan</th>
                            <th>Sosyal Medya</th>
                            <th class="text-right">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($members as $member)
                            <tr>
                                <td>
                                    @if($member->image)
                                        <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" class="img-circle elevation-2" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/back/dist/img/avatar.png') }}" class="img-circle elevation-2" style="width: 50px; height: 50px; object-fit: cover;">
                                    @endif
                                </td>
                                <td class="font-weight-bold">{{ $member->name }}</td>
                                <td>{{ $member->title }}</td>
                                <td>
                                    @if($member->instagram) <a href="{{ $member->instagram }}" target="_blank" class="text-danger mr-2"><i class="fab fa-instagram fa-lg"></i></a> @endif
                                    @if($member->linkedin) <a href="{{ $member->linkedin }}" target="_blank" class="text-primary"><i class="fab fa-linkedin fa-lg"></i></a> @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.club_members.edit', $member->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Düzenle</a>

                                    <form action="{{ route('admin.club_members.destroy', $member->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bu üyeyi silmek istediğinize emin misiniz?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Henüz bir yönetim kurulu üyesi eklenmedi.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
