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
        $this->saveCalculations($rankings, $sRValues);

        return redirect('/perhitungan')->with('success', 'Perhitungan VIKOR berhasil dilakukan!');
    }

    private function normalizeMatrix($penilaians)
    {
        $matrix = [];
        $maxValues = [];
        $minValues = [];

        // Hitung max dan min untuk setiap kriteria
        foreach ($penilaians as $penilaian) {
            $kriteriaId = $penilaian->kriteria_id;
            $value = $penilaian->nilai;

            if (!isset($maxValues[$kriteriaId])) {
                $maxValues[$kriteriaId] = $value;
                $minValues[$kriteriaId] = $value;
            } else {
                $maxValues[$kriteriaId] = max($maxValues[$kriteriaId], $value);
                $minValues[$kriteriaId] = min($minValues[$kriteriaId], $value);
            }
        }

        // Normalisasi matriks dengan penanganan division by zero
        foreach ($penilaians as $penilaian) {
            $kriteria = $penilaian->kriteria;
            $value = $penilaian->nilai;

            $range = $maxValues[$kriteria->id] - $minValues[$kriteria->id];

            // Handle division by zero
            if ($range == 0) {
                $normalized = 1; // atau 0, tergantung kebutuhan
            } else {
                if ($kriteria->jenis == 'benefit') {
                    $normalized = ($value - $minValues[$kriteria->id]) / $range;
                } else {
                    $normalized = ($maxValues[$kriteria->id] - $value) / $range;
                }
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

                // Pastikan kriteria ditemukan
                if (!$kriteria) {
                    continue;
                }

                $weightedValue = $value * $kriteria->bobot;
                $s += $weightedValue;
                $r = max($r, $weightedValue);
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
        $sValues = array_column($sRValues, 's');
        $rValues = array_column($sRValues, 'r');

        $sPlus = max($sValues);
        $sMinus = min($sValues);
        $rPlus = max($rValues);
        $rMinus = min($rValues);

        // Handle division by zero
        $sRange = ($sPlus - $sMinus) ?: 1;
        $rRange = ($rPlus - $rMinus) ?: 1;

        $qValues = [];
        foreach ($sRValues as $alternatifId => $values) {
            $q = $v * (($values['s'] - $sMinus) / $sRange) + (1 - $v) * (($values['r'] - $rMinus) / $rRange);

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

    private function saveCalculations($rankings, $sRValues)
    {
        // Hapus perhitungan lama
        VikorCalculation::truncate();

        // Simpan yang baru
        foreach ($rankings as $alternatifId => $data) {
            VikorCalculation::create([
                'alternatif_id' => $alternatifId,
                'nilai_s' => $sRValues[$alternatifId]['s'] ?? 0,
                'nilai_r' => $sRValues[$alternatifId]['r'] ?? 0,
                'nilai_q' => $data['q'],
                'ranking' => $data['rank']
            ]);
        }
    }
}
