@php
    use App\Models\Team;
    use App\Models\Club; // Kulüp modelini dahil ettik

    $data = Team::all();
    $clubs = Club::all(); // Tüm kulüpleri veritabanından çektik
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <div style="
                background-color: white;
                border-radius: 50px;
                padding: 6px 18px;
                display: flex;
                align-items: center;
            ">
                <img src="{{ asset('uploads/1.5adanalogo.png') }}"
                     alt="Logo"
                     style="height: 55px; width: auto;" />
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav gap-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Anasayfa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('hakkimizda') }}">Hakkımızda</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="teamsDropdown" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Takımlarımız
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="teamsDropdown">
                        @foreach($data as $item)
                            <li>
                                <a class="dropdown-item"
                                   href="{{ $item->website ? $item->website : route('Tanasayfa', $item->slug) }}"
                                    {{ $item->website ? 'target=_blank' : '' }}>
                                    {{ $item->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="clubsDropdown" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Kulüplerimiz
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="clubsDropdown">
                        @foreach($clubs as $club)
                            <li>
                                <a class="dropdown-item" href="{{ route('kulup.detay', $club->slug) }}">
                                    {{ $club->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('advisor') }}">Danışmanlar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('galeri') }}">Fotoğraf Galerisi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">İletişim</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
