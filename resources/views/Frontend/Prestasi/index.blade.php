@extends('Frontend.layouts.main')

@section('title', 'Prestasi Mahasiswa')

@section('content')
    <div class="container py-5">

        <!-- Header -->
        <div class="row mb-4">
            <div class="col text-center">
                <h2 class="fw-bold">Prestasi Mahasiswa</h2>
                <p class="text-muted">
                    Dokumentasi berbagai prestasi akademik maupun non-akademik mahasiswa.
                </p>
            </div>
        </div>

        <!-- Filter -->
        <div class="row mb-4 justify-content-center">
            <form method="GET" action="{{ url('/prestasi') }}">
                <div class="row mb-4 justify-content-center">

                    <div class="col-md-4 mb-2">
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach (['akademik', 'non-akademik'] as $k)
                                <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('-', ' ', $k)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <select name="tahun" class="form-select">
                            <option value="">Semua Tahun</option>
                            @for ($i = date('Y'); $i >= 2000; $i--)
                                <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-2 mb-2">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <!-- Card List -->
        <div class="row g-4">
            @forelse ($prestasi as $p)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">

                        {{-- FOTO --}}
                        @if ($p->foto)
                            <img src="{{ asset('storage/prestasi/' . $p->foto) }}" class="card-img-top"
                                alt="{{ $p->judul }}">
                        @else
                            <img src="https://via.placeholder.com/400x250?text=Prestasi" class="card-img-top"
                                alt="Prestasi">
                        @endif

                        <div class="card-body d-flex flex-column">

                            {{-- KATEGORI --}}
                            <span class="badge bg-primary mb-2 text-capitalize">
                                {{ $p->kategori }}
                            </span>

                            {{-- JUDUL --}}
                            <h5 class="fw-bold">{{ $p->judul }}</h5>

                            {{-- META --}}
                            <p class="text-muted small mb-1">
                                Mahasiswa: {{ $p->mahasiswa }}
                            </p>
                            <p class="text-muted small mb-1">
                                Tingkat: {{ $p->tingkat }}
                            </p>
                            <p class="text-muted small mb-2">
                                Tahun: {{ $p->tahun }}
                            </p>

                            {{-- DESKRIPSI --}}
                            <p class="flex-grow-1">
                                {{ Str::limit(strip_tags($p->deskripsi), 120) }}
                            </p>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="fas fa-trophy fa-2x mb-3"></i>
                    <p class="mb-0">Data prestasi tidak ditemukan</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $prestasi->links() }}
        </div>
    </div>
@endsection
