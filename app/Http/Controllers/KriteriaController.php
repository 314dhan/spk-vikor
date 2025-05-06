<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|unique:kriterias',
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric|min:0|max:1',
            'jenis' => 'required|in:cost,benefit',
            'description' => 'nullable|string'
        ]);

        Kriteria::create($request->all());
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit(Kriteria $kriterium)
    {
        return view('kriteria.edit', ['kriterium' => $kriterium]);
    }

    public function update(Request $request, Kriteria $kriterium)
    {
        $request->validate([
            'kode_kriteria' => 'required|unique:kriterias,kode_kriteria,' . $kriterium->id,
            'nama_kriteria' => 'required',
            'bobot' => 'required|numeric|min:0|max:1',
            'jenis' => 'required|in:cost,benefit',
            'description' => 'nullable|string'
        ]);

        $kriterium->update($request->all());
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriterium)
    {
        $kriterium->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
