<!-- resources/views/perhitungan/index.blade.php -->
@extends('layouts.app')

@section('title', 'Perhitungan VIKOR')
@section('content')
@include('layouts.navbar')

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Perhitungan Metode VIKOR</h5>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form untuk memulai perhitungan -->
                    <form action="{{ route('perhitungan.calculate') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="v">Nilai Strategi V (0-1):</label>
                                    <input type="number" step="0.01" min="0" max="1"
                                           class="form-control" id="v" name="v" value="0.5" required>
                                    <small class="text-muted">Nilai strategi mayoritas kriteria (biasanya 0.5)</small>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-calculator"></i> Hitung VIKOR
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabel Hasil Perhitungan -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Ranking</th>
                                    <th>Alternatif</th>
                                    <th>Nilai S (Utility)</th>
                                    <th>Nilai R (Regret)</th>
                                    <th>Nilai Q</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($calculations as $calc)
                                <tr>
                                    <td>{{ $calc->ranking }}</td>
                                    <td>{{ $calc->alternatif->nama_alternatif }}</td>
                                    <td>{{ number_format($calc->nilai_s, 4) }}</td>
                                    <td>{{ number_format($calc->nilai_r, 4) }}</td>
                                    <td>{{ number_format($calc->nilai_q, 4) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data perhitungan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Matriks Keputusan Awal -->
                    <div class="mt-5">
                        <h5>Matriks Keputusan Awal</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach($kriterias as $kriteria)
                                        <th>{{ $kriteria->nama_kriteria }} ({{ $kriteria->jenis }})</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alternatifs as $alt)
                                    <tr>
                                        <td>{{ $alt->nama_alternatif }}</td>
                                        @foreach($kriterias as $kriteria)
                                        <td>
                                            {{ $alt->penilaian->where('kriteria_id', $kriteria->id)->first()->nilai ?? '-' }}
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
