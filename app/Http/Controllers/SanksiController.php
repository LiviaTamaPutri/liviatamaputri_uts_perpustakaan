<?php

namespace App\Http\Controllers;

use App\Models\Sanksi;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SanksiController extends Controller
{
    public function index(): View
    {
        $dataSanksi = Sanksi::all();
        return view('sanksi.index', compact('dataSanksi'));
    }

    public function create(): View
    {
        $anggotaList = Anggota::all(); // Assuming you have Anggota model
        $peminjamanList = Peminjaman::all(); // Assuming you have Peminjaman model
        return view('sanksi.create', compact('anggotaList', 'peminjamanList'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_anggota' => 'required|integer',
            'id_peminjaman' => 'required|integer',
            'jumlah_denda' => 'required|integer',
            'status' => 'required|in:Tunggakan,Lunas',
        ]);

        Sanksi::create($request->all());

        return redirect()->route('sanksi.index')->with('success', 'Sanksi berhasil ditambahkan.');
    }

    public function edit(string $id_sanksi): View
    {
        $dataSanksi = Sanksi::find($id_sanksi);
        $anggotaList = Anggota::all(); // Assuming you have Anggota model
        $peminjamanList = Peminjaman::all(); // Assuming you have Peminjaman model
        return view('sanksi.edit', compact('dataSanksi', 'anggotaList', 'peminjamanList'));
    }

    public function update(Request $request, $id_sanksi): RedirectResponse
    {
        $validated = $request->validate([
            'id_anggota' => 'required|integer',
            'id_peminjaman' => 'required|integer',
            'jumlah_denda' => 'required|integer',
            'status' => 'required|in:Tunggakan,Lunas',
        ]);

        $dataSanksi = Sanksi::find($id_sanksi);
        $dataSanksi->update($validated);

        return redirect()->route('sanksi.index')->with('success', 'Sanksi berhasil diperbarui.');
    }

    public function destroy($id_sanksi): RedirectResponse
    {
        $sanksi = Sanksi::findOrFail($id_sanksi);
        $sanksi->delete();

        return redirect()->route('sanksi.index')->with('success', 'Sanksi berhasil dihapus.');
    }
}
