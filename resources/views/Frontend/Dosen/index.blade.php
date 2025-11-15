@extends('layouts.main')

@section('title', 'Dosen')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Dosen Pengajar</h2>
    <p class="text-muted mb-4">Daftar dosen pengajar Program Studi Teknik Informatika.</p>

    @if($dosens->count() > 0)
        <div class="row">
            @foreach($dosens as $dosen)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            @if ($dosen->foto)
                                <img src="{{ Storage::url($dosen->foto) }}" alt="Foto {{ $dosen->nama }}" class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover;">
                            @else
                                <i class="bi bi-person-circle text-muted mb-3" style="font-size: 5rem;"></i>
                            @endif
                            <h5 class="card-title">{{ $dosen->nama }}</h5>
                            <p class="card-text text-muted">{{ $dosen->jabatan ?? 'Dosen' }}</p>
                            @if($dosen->bidang_keahlian)
                                <p class="card-text"><small class="text-muted">{{ $dosen->bidang_keahlian }}</small></p>
                            @endif
                            @if($dosen->email)
                                <p class="card-text"><i class="bi bi-envelope"></i> {{ $dosen->email }}</p>
                            @endif
                            @if($dosen->telepon)
                                <p class="card-text"><i class="bi bi-telephone"></i> {{ $dosen->telepon }}</p>
                            @endif
                        </div>
                        <div class="card-footer text-muted">
                            <small>Dibuat: {{ $dosen->created_at->format('d/m/Y') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-info-circle text-muted" style="font-size: 3rem;"></i>
            <h5 class="text-muted mt-3">Belum ada data dosen</h5>
            <p class="text-muted">Data dosen akan segera ditambahkan.</p>
        </div>
    @endif
</div>
@endsection
