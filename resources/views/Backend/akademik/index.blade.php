@extends('layouts.backend')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Data Akademik</h2>

    <a href="{{ route('backend.akademik.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>File</th>
                <th>Dibuat Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($akademiks as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>
                        @if($item->file)
                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank">Lihat File</a>
                        @else
                            <em>Tidak ada file</em>
                        @endif
                    </td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('backend.akademik.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('backend.akademik.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
