<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\VikorCalculation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek jika model ada sebelum menggunakannya
        $jumlahKriteria = class_exists('App\Models\Kriteria') ? Kriteria::count() : 0;
        $jumlahAlternatif = class_exists('App\Models\Alternatif') ? Alternatif::count() : 0;

        $lastProcess = null;
        if (class_exists('App\Models\VikorCalculation')) {
            $lastProcess = VikorCalculation::latest()->first();
        }

        return view('dashboard', [
            'jumlahKriteria' => $jumlahKriteria,
            'jumlahAlternatif' => $jumlahAlternatif,
            'lastProcess' => $lastProcess ? $lastProcess->created_at->format('d M Y H:i') : 'Belum ada perhitungan',
        ]);
    }
}
