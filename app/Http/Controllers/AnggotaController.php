<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class AnggotaController extends Controller
{
    public function index(): View
    {
        $dataAnggota = Anggota::all();
        return view('anggota.index', compact('dataAnggota'));
    }

    public function create(): View
    {
        return view('anggota.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:150',
            'no_hp' => 'required|string|max:16',
            'alamat' => 'required',
            'email' => 'required|string|max:200',
        ]);

        Anggota::create($request->all());

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(string $id_anggota): View
    {
        $dataAnggota = Anggota::find($id_anggota);
        return view('anggota.edit', compact('dataAnggota'));
    }

    public function update(Request $request, $id_anggota): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'no_hp' => 'required|string|max:16',
            'alamat' => 'required',
            'email' => 'required|string|max:200',
        ]);

        $dataAnggota = Anggota::find($id_anggota);
        $dataAnggota->update($validated);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy($id_anggota): RedirectResponse
    {
        try {
            $anggota = Anggota::findOrFail($id_anggota);
            $anggota->delete();

            return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $ex) {
            // Handle the exception or log it
            Log::error('Error deleting anggota: ' . $ex->getMessage());

            return redirect()->route('anggota.index')->with('error', 'Anggota tidak dapat dihapus karena ada data yang masih menggunakan.');
        }
    }
}
