<!-- resources/views/penilaian/index.blade.php -->
@extends('layouts.app')
@section('title', 'Penilaian Alternatif')
@section('content')
@include('layouts.navbar')

<div class="container mt-4">
    <div class="row">
        <h3 class="mb-4">Form Penilaian Alternatif Berdasarkan Kriteria</h3>

        <div class="col-md-3">
                @include('layouts.sidebar')
        </div>

        <div class="col-md-9">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('penilaian.store') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($kriterias as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}<br><small>({{ $kriteria->kode_kriteria }})</small></th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatifs as $alternatif)
                            <tr>
                                <td>{{ $alternatif->nama_alternatif }}</td>
                                @foreach ($kriterias as $kriteria)
                                    @php
                                        $key = $alternatif->id . '-' . $kriteria->id;
                                        $nilai = isset($penilaians[$key]) ? $penilaians[$key]->nilai : '';
                                    @endphp
                                    <td>
                                        <input type="number" step="0.01" name="nilai[{{ $alternatif->id }}][{{ $kriteria->id }}]"
                                            class="form-control" value="{{ $nilai }}" required>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
