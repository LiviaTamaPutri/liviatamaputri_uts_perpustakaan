<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $dataPenulis = Penulis::all();
        return view('penulis.index', compact('dataPenulis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('penulis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_penulis' => 'required|string|max:150',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'email' => 'required|email|max:150|unique:penulis,email',
        ]);

        Penulis::create($validated);

        return redirect()->route('penulis.index')->with('success', 'Penulis berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kd_penulis): View
    {
        $dataPenulis = Penulis::findOrFail($kd_penulis);
        return view('penulis.edit', compact('dataPenulis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kd_penulis): RedirectResponse
    {
        $validated = $request->validate([
            'nama_penulis' => 'required|string|max:150',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'email' => 'required|email|max:150',
        ]);

        $dataPenulis = Penulis::findOrFail($kd_penulis);
        $dataPenulis->update($validated);

        return redirect()->route('penulis.index')->with('success', 'Penulis berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kd_penulis): RedirectResponse
    {
        try {
            $kode_penulis = Penulis::findOrFail($kd_penulis);
            $kode_penulis->delete();
            return redirect()->route('penulis.index')->with('success', 'Penulis berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $ex) {
            // Handle the exception or log it
            Log::error('Error deleting penulis: ' . $ex->getMessage());
            return redirect()->route('penulis.index')->with('error', 'Penulis tidak dapat dihapus karena ada data yang masih menggunakan.');
        }
    }
}
