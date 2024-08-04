<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Peminjaman</title>
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
                    <div class="card-header">Edit Peminjaman</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('peminjaman.update', $dataPeminjaman->id_peminjaman) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="id_anggota" class="form-label">Anggota</label>
                                <select class="form-control @error('id_anggota') is-invalid @enderror" id="id_anggota" name="id_anggota" required>
                                    <option value="">Pilih Anggota</option>
                                    @foreach($anggota as $a)
                                        <option value="{{ $a->id_anggota }}" {{ $a->id_anggota == $dataPeminjaman->id_anggota ? 'selected' : '' }}>{{ $a->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_anggota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_buku" class="form-label">Buku</label>
                                <select class="form-control @error('no_buku') is-invalid @enderror" id="no_buku" name="no_buku" required>
                                    <option value="">Pilih Buku</option>
                                    @foreach($buku as $b)
                                        <option value="{{ $b->no_buku }}" {{ $b->no_buku == $dataPeminjaman->no_buku ? 'selected' : '' }}>{{ $b->judul }}</option>
                                    @endforeach
                                </select>
                                @error('no_buku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tgl_peminjaman" class="form-label">Tanggal Pinjam</label>
                                <input type="date" class="form-control @error('tgl_peminjaman') is-invalid @enderror" id="tgl_peminjaman" name="tgl_peminjaman" value="{{ old('tgl_peminjaman', $dataPeminjaman->tgl_peminjaman) }}" required>
                                @error('tgl_peminjaman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="tgl_pengembalian" class="form-label">Tanggal Kembali</label>
                                <input type="date" class="form-control @error('tgl_pengembalian') is-invalid @enderror" id="tgl_pengembalian" name="tgl_pengembalian" value="{{ old('tgl_pengembalian', $dataPeminjaman->tgl_pengembalian) }}">
                                @error('tgl_pengembalian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="Kembali" {{ $dataPeminjaman->status == 'Kembali' ? 'selected' : '' }}>Kembali</option>
                                    <option value="Belum" {{ $dataPeminjaman->status == 'Belum' ? 'selected' : '' }}>Belum</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
