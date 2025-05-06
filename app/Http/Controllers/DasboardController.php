<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\VikorCalculation;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKriteria = Kriteria::count();
        $jumlahAlternatif = Alternatif::count();
        $lastProcess = VikorCalculation::latest()->first();

        return view('dashboard', [
            'jumlahKriteria' => $jumlahKriteria,
            'jumlahAlternatif' => $jumlahAlternatif,
            'lastProcess' => $lastProcess ? $lastProcess->created_at->format('d M Y H:i') : null,
        ]);
    }
}
