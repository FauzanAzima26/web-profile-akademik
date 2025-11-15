@extends('layouts.backend')

@section('title', 'Detail Dosen')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Dosen</h5>
            <a href="{{ route('backend.dosen.edit', $dosen) }}" class="btn btn-light btn-sm">
                <i class="bi bi-pencil"></i> Edit
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if ($dosen->foto)
                        <img src="{{ Storage::url($dosen->foto) }}" alt="Foto {{ $dosen->nama }}" class="img-fluid rounded mb-3" style="max-width: 200px;">
                    @else
                        <i class="bi bi-person-circle text-muted" style="font-size: 8rem;"></i>
                    @endif
                </div>
                <div class="col-md-8">
                    <h4>{{ $dosen->nama }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>NIP:</strong> {{ $dosen->nip ?? '-' }}</p>
                            <p><strong>Jabatan:</strong> {{ $dosen->jabatan ?? '-' }}</p>
                            <p><strong>Bidang Keahlian:</strong> {{ $dosen->bidang_keahlian ?? '-' }}</p>
                            <p><strong>Pendidikan:</strong> {{ $dosen->pendidikan ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $dosen->email ?? '-' }}</p>
                            <p><strong>Telepon:</strong> {{ $dosen->telepon ?? '-' }}</p>
                            <p><strong>Dibuat:</strong> {{ $dosen->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Diupdate:</strong> {{ $dosen->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('backend.dosen.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
