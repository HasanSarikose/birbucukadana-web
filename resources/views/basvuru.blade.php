<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Takım Başvuru Formu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Takım Bilgi Formu</h4>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('basvuruPost') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Mevcut Takımınız</label>
                            <select name="team_id" class="form-select" required>
                                <option value="">Lütfen Bir Takım Seçiniz</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name ?? $team->anasayfa ?? 'Takım Adı Bulunamadı' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ad Soyad</label>
                            <input type="text" name="ad_soyad" class="form-control" placeholder="Örn: Hasan Sarıköse" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">E-Mail Adresi</label>
                            <input type="email" name="email" class="form-control" placeholder="ornek@gmail.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">LinkedIn Profili</label>
                            <input type="url" name="linkedin" class="form-control" placeholder="https://linkedin.com/in/..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Takımdaki Aldığınız Görev</label>
                            <input type="text" name="task" class="form-control" placeholder="Örn: Yazılım, Mekanik, Sosyal Medya..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dönem</label>
                            <input type="number" name="year" class="form-control" value="{{ date('Y') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fotoğrafınız</label>
                            <input type="file" name="foto" class="form-control" accept="image/*" required>
                            <div class="form-text">Lütfen vesikalık veya net bir fotoğraf yükleyiniz.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">Başvuruyu Tamamla</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
