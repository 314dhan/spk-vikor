<!-- resources/views/alternatif/index.blade.php -->
@extends('layouts.app')
@section('title', 'Data Alternatif')
@section('content')
@include('layouts.navbar')

<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Data Alternatif</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAlternatifTambah">
                Tambah Alternatif
            </button>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alternatif as $alt)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $alt->kode_alternatif }}</td>
                            <td>{{ $alt->nama_alternatif }}</td>
                            <td>{{ $alt->description }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalAlternatifEdit{{ $alt->id }}">Edit</button>
                                <form action="{{ route('alternatif.destroy', $alt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalAlternatifEdit{{ $alt->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('alternatif.update', $alt->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Alternatif</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Kode</label>
                                                <input type="text" name="kode_alternatif" class="form-control" value="{{ $alt->kode_alternatif }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Nama</label>
                                                <input type="text" name="nama_alternatif" class="form-control" value="{{ $alt->nama_alternatif }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Deskripsi</label>
                                                <textarea name="description" class="form-control">{{ $alt->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Simpan Perubahan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalAlternatifTambah" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('alternatif.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Alternatif</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kode</label>
                        <input type="text" name="kode_alternatif" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama_alternatif" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
