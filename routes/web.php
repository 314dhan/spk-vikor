<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\VikorCalculationController;

/*
|--------------------------------------------------------------------------
| Public Routes (Tidak Memerlukan Authentikasi)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Memerlukan Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Kriteria Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('kriteria')->controller(KriteriaController::class)->group(function () {
        Route::get('/', 'index')->name('kriteria.index');
        Route::get('/create', 'create')->name('kriteria.create');
        Route::post('/', 'store')->name('kriteria.store');
        Route::get('/{kriterium}/edit', 'edit')->name('kriteria.edit');
        Route::put('/{kriterium}', 'update')->name('kriteria.update');
        Route::delete('/{kriterium}', 'destroy')->name('kriteria.destroy');
        Route::delete('/', 'destroyAll')->name('kriteria.destroyAll');
    });

    /*
    |--------------------------------------------------------------------------
    | Alternatif Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('alternatif')->controller(AlternatifController::class)->group(function () {
        Route::get('/', 'index')->name('alternatif.index');
        Route::post('/', 'store')->name('alternatif.store');
        Route::put('/{alternatif}', 'update')->name('alternatif.update');
        Route::delete('/{alternatif}', 'destroy')->name('alternatif.destroy');
        Route::delete('/', 'destroyAll')->name('alternatif.destroyAll');
    });

    /*
    |--------------------------------------------------------------------------
    | Penilaian Routes
    |--------------------------------------------------------------------------
    */
    Route::controller(PenilaianController::class)->group(function () {
        Route::get('/penilaian', 'index')->name('penilaian.index');
        Route::post('/penilaian', 'store')->name('penilaian.store');
    });

    /*
    |--------------------------------------------------------------------------
    | Perhitungan VIKOR Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('perhitungan')->controller(VikorCalculationController::class)->group(function () {
        Route::get('/', 'index')->name('perhitungan.index');
        Route::post('/calculate', 'calculate')->name('perhitungan.calculate');
        Route::get('/result', 'result')->name('perhitungan.result');
        Route::get('/export', 'exportPDF')->name('perhitungan.export');
    });
});
