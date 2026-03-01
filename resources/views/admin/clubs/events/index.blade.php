@extends('admin.tema.capp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Etkinlikler ve Duyurular</h1>
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
                    <h3 class="card-title">Tüm Etkinlikler</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.club_events.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Yeni Etkinlik Ekle
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap align-middle">
                        <thead>
                        <tr>
                            <th>Afiş</th>
                            <th>Etkinlik Başlığı</th>
                            <th>Tarih</th>
                            <th class="text-right">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($events as $event)
                            <tr>
                                <td>
                                    @if($event->image)
                                        <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="img-thumbnail" style="width: 80px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="badge badge-secondary">Görsel Yok</span>
                                    @endif
                                </td>
                                <td class="font-weight-bold">{{ $event->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d.m.Y') }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.club_events.edit', $event->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Düzenle</a>

                                    <form action="{{ route('admin.club_events.destroy', $event->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bu etkinliği silmek istediğinize emin misiniz?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Henüz bir etkinlik veya duyuru eklenmedi.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
