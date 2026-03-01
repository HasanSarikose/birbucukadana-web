@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
    // Eğer kulüp yöneticisiyse kulüp adını almak için:
    $club = $user->club;
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('assets/back/')}}/dist/img/AdminLTELogo.png" alt="Kulüp Paneli"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Kulüp Paneli</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/back/')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $user->name }}</a>
            </div>
        </div>

        @if($club)
            <div class="user-panel mt-1 pb-2 mb-3 text-center">
                <span class="text-info fw-bold" style="font-size: 1.1rem;">{{ $club->name }}</span>
            </div>
        @endif

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

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Genel Anasayfa</p>
                    </a>
                </li>

                @if($user->role === 'club_admin')
                    <li class="nav-header">KULÜP İŞLEMLERİ</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.clubs.my_club') }}" class="nav-link {{ request()->routeIs('admin.clubs.my_club') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>Kulüp Bilgilerim</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.club_members.index') }}" class="nav-link {{ request()->routeIs('admin.club_members.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Yönetim Kurulu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.club_events.index') }}" class="nav-link {{ request()->routeIs('admin.club_events.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Etkinlikler ve Duyurular</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.club_gallery.index') }}" class="nav-link {{ request()->routeIs('admin.club_gallery.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-images"></i>
                            <p>Fotoğraf Galerisi</p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">SİSTEM</li>
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
    </div>
</aside>
