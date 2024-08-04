<?php

namespace App\Http\Controllers;

use App\Models\RakBuku;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class RakBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $dataRak = RakBuku::all();
        return view('rak.index', compact('dataRak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('rak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'lokasi' => 'required|string|max:150',
        ]);

        RakBuku::create([
            'lokasi' => $request->lokasi,
        ]);

        return redirect()->route('rak.index')->with('success', 'Rak buku berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kd_rak): View
    {
        $dataRak = RakBuku::find($kd_rak);
        return view('rak.edit', compact('dataRak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kd_rak): RedirectResponse
    {
        $validated = $request->validate([
            'lokasi' => 'required|string|max:150',
        ]);

        $dataRak = RakBuku::find($kd_rak);
        $dataRak->update($validated);

        return redirect()->route('rak.index')->with('success', 'Rak buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kd_rak): RedirectResponse
    {
        try {
            $kode_rak = RakBuku::findOrFail($kd_rak);
            $kode_rak->delete();

            return redirect()->route('rak.index')->with('success', 'Rak buku berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $ex) {
            // Handle the exception or log it
            Log::error('Error deleting rak buku: ' . $ex->getMessage());

            return redirect()->route('rak.index')->with('error', 'Rak buku tidak dapat dihapus karena ada data yang masih menggunakan.');
        }
    }
}
