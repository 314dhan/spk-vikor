<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\VikorCalculationController;

// HOME NANTI AKAN DIGANTI DENGAN DASHBOARD
Route::get('/', function () {
    return view('welcome');
});

// Pages Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/perhitungan/export', [VikorCalculationController::class, 'exportPDF'])->name('perhitungan.export');

// Protected Routes (harus login)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kriteria
    Route::resource('/kriteria', KriteriaController::class)->except(['show']);

    // Alternatif
    Route::resource('/alternatif', AlternatifController::class);

    // Penilaian
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');

    // Perhitungan VIKOR
    Route::prefix('/perhitungan')->group(function () {
        Route::get('/', [VikorCalculationController::class, 'index'])->name('perhitungan.index');
        Route::post('/calculate', [VikorCalculationController::class, 'calculate'])->name('perhitungan.calculate');
        Route::get('/result', [VikorCalculationController::class, 'result'])->name('perhitungan.result');
    });
});
