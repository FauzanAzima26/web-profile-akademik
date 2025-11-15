@extends('layouts.backend')

@section('title', 'Kelola Dosen')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Kelola Dosen</h5>
            <a href="{{ route('backend.dosen.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Dosen
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($dosens->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Bidang Keahlian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosens as $dosen)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($dosen->foto)
                                            <img src="{{ Storage::url($dosen->foto) }}" alt="Foto" class="rounded" width="50" height="50">
                                        @else
                                            <i class="bi bi-person-circle text-muted" style="font-size: 2rem;"></i>
                                        @endif
                                    </td>
                                    <td>{{ $dosen->nama }}</td>
                                    <td>{{ $dosen->jabatan ?? '-' }}</td>
                                    <td>{{ $dosen->bidang_keahlian ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('backend.dosen.show', $dosen) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('backend.dosen.edit', $dosen) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('backend.dosen.destroy', $dosen) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-info-circle text-muted" style="font-size: 3rem;"></i>
                    <h5 class="text-muted mt-3">Belum ada data dosen</h5>
                    <p class="text-muted">Tambahkan data dosen pertama untuk memulai.</p>
                    <a href="{{ route('backend.dosen.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Dosen
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
