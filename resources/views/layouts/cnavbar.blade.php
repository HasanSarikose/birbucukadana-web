<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ isset($club) ? route('kulup.detay', $club->slug) : '#' }}">
            <div style="
                background-color: white;
                border-radius: 50px;
                padding: 6px 18px;
                display: flex;
                align-items: center;
            ">
                @if(isset($club) && $club->logo)
                    <img src="{{ asset($club->logo) }}" alt="{{ $club->name }} Logo" style="height: 40px; width: auto;" />
                @else
                    <img src="{{ asset('uploads/1.5adanalogo.png') }}" alt="1.5 Adana Logo" style="height: 40px; width: auto;" />
                @endif
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#cnavbarNavDropdown"
                aria-controls="cnavbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="cnavbarNavDropdown">
            <ul class="navbar-nav gap-2 align-items-center">
                <div class="d-flex flex-column flex-lg-row align-items-center m-auto gap-3">
                    <li class="nav-item list-unstyled">
                        <a class="nav-link {{ request()->routeIs('kulup.detay') ? 'active text-info font-weight-bold' : '' }}"
                           href="{{ isset($club) ? route('kulup.detay', $club->slug) : '#' }}">
                            Hakkımızda
                        </a>
                    </li>
                    <li class="nav-item list-unstyled">
                        <a class="nav-link {{ request()->routeIs('kulup.yonetim_kurulu') ? 'active text-info font-weight-bold' : '' }}"
                           href="{{ isset($club) ? route('kulup.yonetim_kurulu', $club->slug) : '#' }}">
                            Yönetim Kurulu
                        </a>
                    </li>
                    <li class="nav-item list-unstyled">
                        <a class="nav-link {{ request()->routeIs('kulup.etkinlikler') || request()->routeIs('kulup.etkinlik_detay') ? 'active text-info font-weight-bold' : '' }}"
                           href="{{ isset($club) ? route('kulup.etkinlikler', $club->slug) : '#' }}">
                            Etkinlikler
                        </a>
                    </li>
                    <li class="nav-item list-unstyled">
                        <a class="nav-link {{ request()->routeIs('kulup.galeri') ? 'active text-info font-weight-bold' : '' }}"
                           href="{{ route('kulup.galeri', $club->slug) }}">
                            Galeri
                        </a>
                    </li>
                    <li class="nav-item list-unstyled">
                        <a class="nav-link {{ request()->routeIs('kulup.iletisim') ? 'active text-info font-weight-bold' : '' }}"
                           href="{{ isset($club) ? route('kulup.iletisim', $club->slug) : '#' }}">
                            İletişim
                        </a>
                    </li>
                </div>
                <li class="nav-item ms-lg-4 mt-2 mt-lg-0">
                    <a class="nav-link btn btn-outline-light btn-sm px-4 rounded-pill" href="{{ route('home') }}" style="border-color: rgba(255,255,255,0.5);">
                        <i class="fas fa-home"></i> 1.5 Adana'ya Dön
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
