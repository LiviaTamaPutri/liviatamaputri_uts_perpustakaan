<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penulis;
use App\Models\RakBuku;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class BukuController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $dataBuku = Buku::all();
        return view('buku.index', compact('dataBuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $dataPenulis = Penulis::all();
        $dataRak = RakBuku::all();
        return view('buku.create', compact('dataPenulis', 'dataRak'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'edisi' => 'required|string|max:50',
            'no_rak' => 'required|integer',
            'tahun' => 'required|date',
            'penerbit' => 'required|string|max:100',
            'kd_penulis' => 'required|integer',
        ]);

        Buku::create($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        $dataPenulis = Penulis::all();
        $dataRak = RakBuku::all();
        return view('buku.edit', compact('buku', 'dataPenulis', 'dataRak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'edisi' => 'required|string|max:50',
            'no_rak' => 'required|integer',
            'tahun' => 'required|date',
            'penerbit' => 'required|string|max:100',
            'kd_penulis' => 'required|integer',
        ]);

        $buku->update($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_buku)
    {
        $buku = Buku::findOrFail($id_buku);
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}