<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();

        // Ambil semua penilaian yang sudah ada
        $penilaians = Penilaian::all()->keyBy(function ($item) {
            return $item->alternatif_id . '-' . $item->kriteria_id;
        });

        return view('penilaian.index', compact('alternatifs', 'kriterias', 'penilaians'));
    }

    public function store(Request $request)
    {
        foreach ($request->nilai as $alternatif_id => $kriteria_nilai) {
            foreach ($kriteria_nilai as $kriteria_id => $nilai) {
                Penilaian::updateOrCreate(
                    ['alternatif_id' => $alternatif_id, 'kriteria_id' => $kriteria_id],
                    ['nilai' => $nilai]
                );
            }
        }

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan.');
    }
}
