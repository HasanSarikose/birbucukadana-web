<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3" style="font-size: 1.05rem;">
    <div class="container position-relative">

        <!-- Sol köşede logo (takım sayfalarında sade, genel sayfada oval zeminli) -->
        <a class="navbar-brand d-flex align-items-center position-absolute start-0"
           style="left: 0;"
           href="{{ route('Tanasayfa', ['team_slug' => $team->slug]) }}">
            @if($team->logo)
                <img src="{{ asset($team->logo) }}"
                     alt="{{ $team->name }} Logo"
                     style="height: 70px; width: auto;">
            @endif
        </a>

        <!-- Menü (ortalanmış) -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarCentered">
            <ul class="navbar-nav text-center gap-3">
                <li class="nav-item"><a class="nav-link " href="{{ route('home') }}">Anasayfa</a></li>
                <li class="nav-item"><a class="nav-link " href="{{ route('Tanasayfa', ['team_slug' => $team->slug]) }}">Takım Anasayfa</a></li>
                <li class="nav-item"><a class="nav-link " href="{{ route('Thakkimizda', ['team_slug' => $team->slug]) }}">Hakkımızda</a></li>
                <li class="nav-item"><a class="nav-link " href="{{ route('takim.uyeler', ['team_slug' => $team->slug]) }}">Üyeler</a></li>
                <li class="nav-item"><a class="nav-link " href="{{ route('basarilar', ['team_slug' => $team->slug]) }}">Başarılar</a></li>
                <li class="nav-item"><a class="nav-link " href="{{ route('portfolio', ['team_slug' => $team->slug]) }}">Ürünler</a></li>
                <li class="nav-item"><a class="nav-link " href="{{ route('Sponsorlar', ['team_slug' => $team->slug]) }}">Sponsorlar</a></li>
                <li class="nav-item"><a class="nav-link " href="{{ route('araclar', ['team_slug' => $team->slug]) }}">Araçlar</a></li>
                <li class="nav-item"><a class="nav-link " href="{{ route('TGaleri', ['team_slug' => $team->slug]) }}">Galeri</a></li>
            </ul>
        </div>

        <!-- Mobil toggle -->
        <button class="navbar-toggler position-absolute end-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarCentered"
                aria-controls="navbarCentered" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</nav>
