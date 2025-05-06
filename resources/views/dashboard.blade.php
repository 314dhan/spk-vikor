<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
@include('layouts.navbar')

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h5>Menu SPK</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/kriteria" class="list-group-item list-group-item-action">Kriteria</a>
                    <a href="/alternatif" class="list-group-item list-group-item-action">Alternatif</a>
                    <a href="/penilaian" class="list-group-item list-group-item-action">Penilaian</a>
                    <a href="/perhitungan" class="list-group-item list-group-item-action">Perhitungan VIKOR</a>
                    <a href="/hasil" class="list-group-item list-group-item-action">Hasil Keputusan</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Dashboard SPK Metode VIKOR</h5>
                    <span class="badge bg-primary">v1.0</span>
                </div>
                <div class="card-body">
                    <!-- Statistik Cepat -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h6 class="card-title">Jumlah Kriteria</h6>
                                    <p class="card-text display-6">{{ $jumlahKriteria }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h6 class="card-title">Jumlah Alternatif</h6>
                                    <p class="card-text display-6">{{ $jumlahAlternatif }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-warning">
                                <div class="card-body">
                                    <h6 class="card-title">Proses Terakhir</h6>
                                    <p class="card-text">{{ $lastProcess ?? 'Belum ada perhitungan' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panduan Cepat -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6>Panduan Cepat Metode VIKOR</h6>
                        </div>
                        <div class="card-body">
                            <ol>
                                <li>Masukkan <strong>Kriteria</strong> beserta bobot dan sifat (Cost/Benefit)</li>
                                <li>Tambahkan <strong>Alternatif</strong> yang akan dinilai</li>
                                <li>Lakukan <strong>Penilaian</strong> alternatif berdasarkan kriteria</li>
                                <li>Proses <strong>Perhitungan VIKOR</strong> untuk mendapatkan ranking</li>
                                <li>Lihat <strong>Hasil Keputusan</strong> berdasarkan perhitungan</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Langkah Selanjutnya -->
                    <div class="alert alert-info">
                        <h6>Langkah Selanjutnya</h6>
                        <p class="mb-0">
                            @if($jumlahKriteria == 0)
                                <a href="/kriteria" class="alert-link">Mulai dengan menambahkan kriteria</a>
                            @elseif($jumlahAlternatif == 0)
                                <a href="/alternatif" class="alert-link">Tambahkan alternatif untuk dinilai</a>
                            @else
                                <a href="/penilaian" class="alert-link">Lakukan penilaian alternatif</a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
