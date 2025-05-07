<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\VikorCalculation; // Import the VikorCalculation model (no changes here)

class VikorCalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatifs = Alternatif::with('penilaian.kriteria')->get();
        $kriterias = Kriteria::all();
        $calculations = \App\Models\VikorCalculation::with('alternatif')
            ->orderBy('ranking')
            ->get();

        return view('perhitungan.index', [
            'title' => 'Perhitungan VIKOR',
            'active' => 'perhitungan',
            'alternatifs' => $alternatifs,
            'kriterias' => $kriterias,
            'calculations' => $calculations,
        ]);
    }

    public function calculate(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'v' => 'required|numeric|between:0,1',
        ]);

        // Ambil semua data yang diperlukan
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

        // 1. Normalisasi Matriks Keputusan
        $normalizedMatrix = $this->normalizeMatrix($penilaians, $kriterias);

        // 2. Hitung Nilai Utility (S) dan Regret (R)
        $sRValues = $this->calculateSR($normalizedMatrix, $kriterias);

        // 3. Hitung Nilai Q
        $qValues = $this->calculateQ($sRValues, $validated['v']);

        // 4. Ranking
        $rankings = $this->calculateRanking($qValues);

        // Simpan ke database
        $this->saveCalculations($rankings);

        return redirect('/perhitungan')->with('success', 'Perhitungan VIKOR berhasil dilakukan!');
    }

    private function normalizeMatrix($penilaians, $kriterias)
    {
        $matrix = [];
        $maxValues = [];
        $minValues = [];

        // Inisialisasi max dan min untuk setiap kriteria
        foreach ($kriterias as $kriteria) {
            $maxValues[$kriteria->id] = -INF;
            $minValues[$kriteria->id] = INF;
        }

        // Cari max dan min untuk normalisasi
        foreach ($penilaians as $penilaian) {
            $value = $penilaian->nilai;
            $kriteriaId = $penilaian->kriteria_id;

            if ($value > $maxValues[$kriteriaId]) {
                $maxValues[$kriteriaId] = $value;
            }
            if ($value < $minValues[$kriteriaId]) {
                $minValues[$kriteriaId] = $value;
            }
        }

        // Normalisasi
        foreach ($penilaians as $penilaian) {
            $kriteria = $kriterias->find($penilaian->kriteria_id);
            $value = $penilaian->nilai;

            if ($kriteria->jenis == 'benefit') {
                $normalized = ($value - $minValues[$kriteria->id]) /
                            ($maxValues[$kriteria->id] - $minValues[$kriteria->id]);
            } else {
                $normalized = ($maxValues[$kriteria->id] - $value) /
                            ($maxValues[$kriteria->id] - $minValues[$kriteria->id]);
            }

            $matrix[$penilaian->alternatif_id][$penilaian->kriteria_id] = $normalized;
        }

        return $matrix;
    }

    private function calculateSR($normalizedMatrix, $kriterias)
    {
        $results = [];

        foreach ($normalizedMatrix as $alternatifId => $kriteriaValues) {
            $s = 0;
            $r = 0;

            foreach ($kriteriaValues as $kriteriaId => $value) {
                $kriteria = $kriterias->find($kriteriaId);
                $weightedValue = $value * $kriteria->bobot;

                $s += $weightedValue;

                if ($weightedValue > $r) {
                    $r = $weightedValue;
                }
            }

            $results[$alternatifId] = [
                's' => $s,
                'r' => $r
            ];
        }

        return $results;
    }

    private function calculateQ($sRValues, $v)
    {
        // Cari S+ S- R+ R-
        $sValues = array_column($sRValues, 's');
        $rValues = array_column($sRValues, 'r');

        $sPlus = max($sValues);
        $sMinus = min($sValues);
        $rPlus = max($rValues);
        $rMinus = min($rValues);

        // Hitung Q untuk setiap alternatif
        $qValues = [];
        foreach ($sRValues as $alternatifId => $values) {
            $q = $v * (($values['s'] - $sMinus) / ($sPlus - $sMinus)) + (1 - $v) * (($values['r'] - $rMinus) / ($rPlus - $rMinus));

            $qValues[$alternatifId] = $q;
        }

        return $qValues;
    }

    private function calculateRanking($qValues)
    {
        // Urutkan Q dari kecil ke besar
        asort($qValues);

        // Beri ranking
        $rankings = [];
        $rank = 1;
        foreach ($qValues as $alternatifId => $q) {
            $rankings[$alternatifId] = [
                'q' => $q,
                'rank' => $rank++
            ];
        }

        return $rankings;
    }

    private function saveCalculations($rankings)
    {
        // Hapus perhitungan lama
        VikorCalculation::truncate();

        // Simpan yang baru
        foreach ($rankings as $alternatifId => $data) {
            VikorCalculation::create([
                'alternatif_id' => $alternatifId,
                'nilai_s' => $data['s'] ?? 0,
                'nilai_r' => $data['r'] ?? 0,
                'nilai_q' => $data['q'],
                'ranking' => $data['rank']
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
