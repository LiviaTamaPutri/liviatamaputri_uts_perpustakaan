<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Sanksi</title>
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
            <div class="navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rak.index') }}">Rak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('penulis.index') }}">Penulis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('buku.index') }}">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('anggota.index') }}">Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('peminjaman.index') }}">Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sanksi.index') }}">Sanksi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Sanksi</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('sanksi.update', $dataSanksi->id_sanksi) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="id_anggota" class="form-label">ID Anggota</label>
                                <select class="form-select @error('id_anggota') is-invalid @enderror" id="id_anggota" name="id_anggota" required>
                                    @foreach ($anggotaList as $anggota)
                                        <option value="{{ $anggota->id_anggota }}" {{ $dataSanksi->id_anggota == $anggota->id_anggota ? 'selected' : '' }}>
                                            {{ $anggota->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_anggota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="id_peminjaman" class="form-label">ID Peminjaman</label>
                                <select class="form-select @error('id_peminjaman') is-invalid @enderror" id="id_peminjaman" name="id_peminjaman" required>
                                    @foreach ($peminjamanList as $peminjaman)
                                        <option value="{{ $peminjaman->id_peminjaman }}" {{ $dataSanksi->id_peminjaman == $peminjaman->id_peminjaman ? 'selected' : '' }}>
                                            {{ $peminjaman->kode_peminjaman }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_peminjaman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jumlah_denda" class="form-label">Jumlah Denda</label>
                                <input type="number" class="form-control @error('jumlah_denda') is-invalid @enderror" id="jumlah_denda" name="jumlah_denda" value="{{ old('jumlah_denda', $dataSanksi->jumlah_denda) }}" required>
                                @error('jumlah_denda')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status', $dataSanksi->status) }}" required>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('sanksi.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
