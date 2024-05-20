<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://laravel.com/assets/img/welcome/background.svg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('buku.index') }}">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rak.index') }}">Rak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('penulis.index') }}">Penulis</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Buku</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('buku.store') }}">
                            @csrf
    
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                            </div>
    
                            <div class="mb-3">
                                <label for="edisi" class="form-label">Edisi</label>
                                <input type="text" class="form-control" id="edisi" name="edisi" value="{{ old('edisi') }}" required>
                            </div>
    
                            <div class="mb-3">
                                <label for="no_rak" class="form-label">Rak</label>
                                <select class="form-select" id="no_rak" name="no_rak" required>
                                    <option value="">---</option>
                                    @foreach($dataRak as $rak)
                                        <option value="{{ $rak->kd_rak }}" {{ old('no_rak') == $rak->kd_rak ? 'selected' : '' }}>
                                            {{ $rak->lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="date" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ old('tahun') }}" required>
                                @error('tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" required>
                            </div>
    
                            <div class="mb-3">
                                <label for="kd_penulis" class="form-label">Nama Penulis</label>
                                <select class="form-select" id="kd_penulis" name="kd_penulis" required>
                                    <option value="">---</option>
                                    @foreach($dataPenulis as $penulis)
                                        <option value="{{ $penulis->kd_penulis }}" {{ old('kd_penulis') == $penulis->kd_penulis ? 'selected' : '' }}>
                                            {{ $penulis->nama_penulis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <button button type="submit" class="btn btn-primary">Tambah</button>
                                <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>



