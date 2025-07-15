<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::all();
        return view('alternatif.index', compact('alternatif'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_alternatif' => 'required|unique:alternatifs',
            'nama_alternatif' => 'required',
            'description' => 'nullable|string'
        ]);

        Alternatif::create($request->all());
        return redirect()->back()->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'kode_alternatif' => 'required|unique:alternatifs,kode_alternatif,' . $alternatif->id,
            'nama_alternatif' => 'required',
            'description' => 'nullable|string'
        ]);

        $alternatif->update($request->all());
        return redirect()->back()->with('success', 'Alternatif berhasil diperbarui.');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();
        return redirect()->back()->with('success', 'Alternatif berhasil dihapus.');
    }

    public function destroyAll()
    {
        // Hapus semua data penilaian yang terkait dengan alternatif
        \App\Models\Penilaian::query()->delete();
        
        // Hapus semua data perhitungan VIKOR yang terkait dengan alternatif
        \App\Models\VikorCalculation::query()->delete();
        
        // Hapus semua data alternatif
        Alternatif::query()->delete();

        return redirect()->route('alternatif.index')->with('success', 'Semua data alternatif berhasil dihapus.');
    }
}
