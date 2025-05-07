<!-- resources/views/kriteria/index.blade.php -->
@extends('layouts.app')
@section('title', 'Data Kriteria')
@section('content')
@include('layouts.navbar')

<div class="container mt-4">
    <h4>Data Kriteria</h4>
    {{-- <a href="{{ route('kriteria.create') }}" class="btn btn-primary mb-3">Tambah Kriteria</a> --}}

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalKriteriaTambah">
        Tambah Kriteria
    </button>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalKriteriaTambah" tabindex="-1" aria-labelledby="modalLabelTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{ route('kriteria.store') }}" method="POST">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="modalLabelTambah">Tambah Kriteria</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
            <!-- form input -->
            <div class="mb-3">
                <label>Kode Kriteria</label>
                <input type="text" name="kode_kriteria" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Nama Kriteria</label>
                <input type="text" name="nama_kriteria" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Bobot</label>
                <input type="number" name="bobot" class="form-control" step="0.01" max="1" required>
            </div>
            <div class="mb-3">
                <label>Jenis</label>
                <select name="jenis" class="form-select" required>
                    <option value="cost">Cost</option>
                    <option value="benefit">Benefit</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Bobot</th>
                    <th>Jenis</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kriteria as $item)
                    <tr>
                        <td>{{ $item->kode_kriteria }}</td>
                        <td>{{ $item->nama_kriteria }}</td>
                        <td>{{ $item->bobot }}</td>
                        <td>{{ ucfirst($item->jenis) }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <!-- Tombol Edit -->
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                            Edit
                            </button>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <form action="{{ route('kriteria.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                    <h5 class="modal-title">Edit Kriteria</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Kode Kriteria</label>
                                        <input type="text" name="kode_kriteria" value="{{ $item->kode_kriteria }}" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Kriteria</label>
                                        <input type="text" name="nama_kriteria" value="{{ $item->nama_kriteria }}" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Bobot</label>
                                        <input type="number" name="bobot" step="0.01" max="1" value="{{ $item->bobot }}" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Jenis</label>
                                        <select name="jenis" class="form-select">
                                        <option value="cost" {{ $item->jenis == 'cost' ? 'selected' : '' }}>Cost</option>
                                        <option value="benefit" {{ $item->jenis == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <textarea name="description" class="form-control">{{ $item->description }}</textarea>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>

                            <!-- Hapus -->
                            <form action="{{ route('kriteria.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

{{-- <script>
    $(document).ready(function () {
        $('#formTambahKriteria').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('kriteria.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    alert("Kriteria berhasil ditambahkan!");
                    $('#modalKriteriaTambah').modal('hide');
                    location.reload(); // Atau append data baru ke table tanpa reload
                },
                error: function (xhr) {
                    alert("Gagal menyimpan data. Cek validasi!");
                }
            });
        });
    });
</script> --}}
