@php
    use App\Models\Team;
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();

    if ($user->role === 'super_admin') {
        $teams = Team::all(); // Süper admin tüm takımları görür
    } else {
        $teams = $user->team ? [$user->team] : []; // Diğer kullanıcı sadece kendi takımını
    }
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('assets/back/')}}/dist/img/AdminLTELogo.png" alt="Cyberova"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Panel ADMİN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/back/')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Arama" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Anasayfa
                        </p>
                    </a>
                </li>
                @foreach($teams as $team)
                    <li>
                        <p class="text-center text-white">{{ $team->name . ' - Takım ID: ' . $team->id }}</p>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Ana Sayfa İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('anasayfa_ekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ana Sayfa Ekleme</p>
                                </a>
                            </li>

                            <li class="nav-item">

                                <a href="{{ route('TanasayfaEdit', ['team_slug' => $team->slug, 'id' => $tanasayfa->id ?? 1]) }}"
                                   class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ana Sayfa Düzenleme</p>
                                </a>

                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Hakkımızda İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('Thakkimizdaekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hakkımızda Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('ThakkimizdaEdit', ['team_slug' => $team->slug, 'id' => $thakkimizda->id ?? 1])}}"
                                   class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hakkımızda Düzenleme</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">

                        @php
                            // O anki döngüdeki takıma ait, henüz onaylanmamış başvuruları sayıyoruz
                            // Model yolun farklıysa (örn: App\Models\Basvuru) burayı düzelt
                            $bekleyenSayisi = \App\Models\Basvuru::where('team_id', $team->id)
                                                                 ->where('onaylandi_mi', 0)
                                                                 ->count();
                        @endphp

                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-clock"></i>
                            <p>
                                Başvuru İşlemleri
                                <i class="right fas fa-angle-left"></i>

                                @if($bekleyenSayisi > 0)
                                    <span class="badge badge-warning right">{{ $bekleyenSayisi }}</span>
                                @endif
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('basvurulistele', ['team_id' => $team->id]) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Başvuruları Listele

                                        @if($bekleyenSayisi > 0)
                                            <span class="badge badge-info right">{{ $bekleyenSayisi }}</span>
                                        @endif
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Üye İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('TUyelerekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Üye Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('TUyelerListele')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Üye Listeleme</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Sponsor İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('Sponsorekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sponsor Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('SponsorListele', ['team_slug' => $team->slug])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sponsor Listeleme</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Sponsor Paket İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('SponsorPaketEkle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sponsor Paket Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('SponsorPaketListele', ['team_slug' => $team->slug])}}"
                                   class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sponsor Paket Listeleme</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Başarı İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('basarilarekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Başarı Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('basariListele')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Başarı Listeleme</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Araç İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('aracekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Araç Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('aracListele', ['team_slug' => $team->slug])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Araç Listeleme</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Ürün İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('portfolioekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ürün Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('portfolioListele', ['team_slug' => $team->slug])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ürün Listeleme</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Galeri İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('TGaleriekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Galeri Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('TGaleriListele', ['team_slug' => $team->slug])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Galeri Listeleme</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                @endforeach

                <li class="nav-header">Sabit Linkler</li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link" style="background: none; border: none; padding: 0;">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p class="text">Çıkış Yap</p>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
