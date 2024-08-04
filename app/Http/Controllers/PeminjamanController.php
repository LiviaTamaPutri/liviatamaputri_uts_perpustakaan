<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    public function index(): View
    {
        $dataPeminjaman = Peminjaman::all();
        return view('peminjaman.index', compact('dataPeminjaman'));
    }

    public function create(): View
    {
        $buku = Buku::all();
        $anggota = Anggota::all();
        return view('peminjaman.create', compact('buku', 'anggota'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'no_buku' => 'required|integer',
            'id_anggota' => 'required|integer',
            'tgl_peminjaman' => 'required|date',
            'tgl_pengembalian' => 'nullable|date',
            'status' => 'required|in:Kembali,Belum',
        ]);

        Peminjaman::create($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function edit(string $id_peminjaman): View
    {
        $dataPeminjaman = Peminjaman::find($id_peminjaman);
        $buku = Buku::all();
        $anggota = Anggota::all();
        return view('peminjaman.edit', compact('dataPeminjaman', 'buku', 'anggota'));
    }

    public function update(Request $request, $id_peminjaman): RedirectResponse
    {
        $validated = $request->validate([
            'no_buku' => 'required|integer',
            'id_anggota' => 'required|integer',
            'tgl_peminjaman' => 'required|date',
            'tgl_pengembalian' => 'nullable|date',
            'status' => 'required|in:Kembali,Belum',
        ]);

        $dataPeminjaman = Peminjaman::find($id_peminjaman);
        $dataPeminjaman->update($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy($id_peminjaman): RedirectResponse
    {
        try {
            $peminjaman = Peminjaman::findOrFail($id_peminjaman);
            $peminjaman->delete();

            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $ex) {
            Log::error('Error deleting peminjaman: ' . $ex->getMessage());
            return redirect()->route('peminjaman.index')->with('error', 'Peminjaman tidak dapat dihapus karena ada data yang masih menggunakan.');
        }
    }
}
