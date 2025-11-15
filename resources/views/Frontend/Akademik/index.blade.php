@extends('layouts.main')

@section('title', 'Akademik & Kurikulum')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Akademik & Kurikulum</h2>
    <p class="text-muted mb-4">Daftar mata kuliah, struktur kurikulum, jadwal, dan informasi akademik lainnya.</p>

    @if($akademiks->count() > 0)
        <div class="row">
            @foreach($akademiks as $akademik)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $akademik->judul }}</h5>
                            <p class="card-text">{{ Str::limit($akademik->konten, 150) }}</p>
                            @if($akademik->file)
                                <a href="{{ Storage::url($akademik->file) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-file-earmark"></i> Lihat File
                                </a>
                            @endif
                        </div>
                        <div class="card-footer text-muted">
                            <small>Dibuat: {{ $akademik->created_at->format('d/m/Y') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-info-circle text-muted" style="font-size: 3rem;"></i>
            <h5 class="text-muted mt-3">Belum ada informasi akademik</h5>
            <p class="text-muted">Informasi akademik akan segera ditambahkan.</p>
        </div>
    @endif
</div>
@endsection
