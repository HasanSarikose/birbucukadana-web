<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/admin/dashboard')}}" class="brand-link">
        <img src="{{asset('assets/back/')}}/dist/img/AdminLTELogo.png" alt="Cyberova" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Panel ADMİN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/back/')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- SÜPER ADMİN MENÜLERİ --}}
                @if(auth()->user()->isSuperAdmin())
                    <li class="nav-item">
                        <a href="{{url('/admin/dashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Anasayfa</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>Takım İşlemleri<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('takimekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Takım Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('takimlistele')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Takım Listele</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-university"></i>
                            <p>
                                Kulüp İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.clubs.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Yeni Kulüp Ekle</p>
                                </a>
                            </li>
                        </ul>
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
                                <a href="{{route('anasayfaekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ana Sayfa Ekleme</p>
                                </a>
                            </li>

                            <li class="nav-item">

                                <a href="{{route('anasayfaedit', $anasayfa->id ?? 1)}}" class="nav-link">
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
                                Duyurular
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('duyuruekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Duyuru Ekle</p>
                                </a>
                            </li>
                            {{--
                                                    <li class="nav-item">
                                                        <a href="{{route('duyuruedit', $duyuru->id)}}" class="nav-link">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>Duyuru Düzenle</p>
                                                        </a>
                                                    </li>
                            --}}
                            <li class="nav-item">
                                <a href="{{route('duyurulistele')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Duyuru Listele/Ara</p>
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
                                <a href="{{route('hakkimizdaekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hakkımızda Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('hakkimizdaedit', $hakkimizda->id ?? 1)}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hakkımızda Düzenleme</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Geçmiten Gününmüze İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('pasttonowekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Geçmiten Gününmüze Ekleme</p>
                                </a>
                            </li>
                            {{--
                            <li class="nav-item">
                                <a href="{{route('ekip_edit')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ekip Düzenleme</p>
                                </a>
                            </li>
    --}}
                            <li class="nav-item">
                                <a href="{{route('pasttonowlistele')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Geçmişten Günümüze Listeleme</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Danışman İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('advisorekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danışman Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('advisorlistele')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danışman Listeleme</p>
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
                                <a href="{{route('galeriekle')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Galeri Ekleme</p>
                                </a>
                            </li>
                            {{--
                            <li class="nav-item">
                                <a href="{{route('sponsor_edit', ['id' => $Sponsor->id])}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sponsor Düzenleme</p>
                                </a>
                            </li>
    --}}
                            <li class="nav-item">
                                <a href="{{route('galerilistele')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Galeri Listeleme</p>
                                </a>
                            </li>
                            {{--
                                                    <li class="nav-item">
                                                        <a href="{{route('sponsor_not', ['id'=>$Sponsor->id])}}" class="nav-link">
                                                            <i class="far fa-circle nav-icon"></i>
                                                            <p>Sponsor Not Ekleme</p>
                                                        </a>
                                                    </li>
                                                    --}}
                        </ul>
                    </li>

                    {{--<li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Sponsorluk İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sponsor Ekleme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sponsor Arama/Listeleme</p>
                                </a>
                            </li>

                        </ul>
                    </li>--}}





                    <li class="nav-item">
                        <a href="{{route('teamdashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>
                                Takım Yönetim İşlemleri
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>
                    <!-- Ana Sayfa, Duyurular, Hakkımızda vs. Menüleri -->
                    {{-- Diğer süper admin menülerini de buraya aynen ekle --}}

                @endif

                {{-- TAKIM ADMİNİ MENÜLERİ --}}
                @if(auth()->user()->isAdmin() && auth()->user()->team)
                    <li class="nav-item">
                        <a href="{{route('teamdashboard')}}" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>Takım Yönetim İşlemleri</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->role === 'club_admin')
                    <li class="nav-header">KULÜP YÖNETİMİ</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.clubs.my_club') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Kulüp Bilgilerim</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.club_members.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Yönetim Kurulu</p>
                        </a>
                    </li>
                @endif
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
