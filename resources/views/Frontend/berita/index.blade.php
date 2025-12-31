@extends('Frontend.layouts.main')

@section('title', 'Berita & Agenda')

@section('content')
    <div class="container py-5">
        <!-- Header -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="text-center mb-4">
                    <h1 class="fw-bold display-5 mb-3">Berita & Agenda</h1>
                    <p class="lead text-muted">
                        Informasi terkini kegiatan dan pengumuman kampus
                    </p>
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <div class="row mb-4">
            <div class="col-12">
                <form method="GET" action="{{ url()->current() }}" class="row g-2 align-items-end">
                    {{-- Kategori --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua</option>
                            <option value="berita" {{ request('kategori') == 'berita' ? 'selected' : '' }}>
                                Berita
                            </option>
                            <option value="agenda" {{ request('kategori') == 'agenda' ? 'selected' : '' }}>
                                Agenda
                            </option>
                        </select>
                    </div>

                    {{-- Tahun --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Tahun</label>
                        <select name="tahun" class="form-select">
                            <option value="">Semua Tahun</option>
                            @for ($y = now()->year; $y >= 2018; $y--)
                                <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    {{-- Button --}}
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>

                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary w-100">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4">
            @forelse ($items as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        {{-- Gambar --}}
                        <img src="{{ $item->gambar
                            ? ($item instanceof \App\Models\Berita
                                ? asset('storage/' . $item->gambar)
                                : asset('storage/agenda/' . $item->gambar))
                            : asset('assets/frontend/img/default-news.png') }}"
                            class="card-img-top" style="height:200px;object-fit:cover;width:100%" alt="{{ $item->judul }}">

                        <div class="card-body">
                            {{-- Badge --}}
                            <span
                                class="badge {{ $item instanceof \App\Models\Berita ? 'bg-primary' : 'bg-warning' }} mb-2">
                                {{ $item instanceof \App\Models\Berita ? 'Berita' : 'Agenda' }}
                            </span>

                            <h5 class="fw-bold">{{ $item->judul }}</h5>

                            {{-- Meta --}}
                            <div class="text-muted small mb-3">
                                @if ($item instanceof \App\Models\Berita)
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($item->published_at)->format('d M Y') }}
                                    <span class="ms-2">
                                        <i class="fas fa-eye me-1"></i>{{ $item->views ?? 0 }}
                                    </span>
                                @else
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                                    @if ($item->tanggal_selesai && $item->tanggal_selesai != $item->tanggal_mulai)
                                        - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                    @endif
                                @endif
                            </div>

                            {{-- Konten --}}
                            <p class="small text-muted">
                                {{ Str::limit(strip_tags($item instanceof \App\Models\Berita ? $item->konten : $item->deskripsi), 120) }}
                            </p>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <p>Belum ada data tersedia.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if ($items->hasPages())
            <div class="row mt-4">
                <div class="col-12">
                    {{ $items->links() }}
                </div>
            </div>
        @endif
    @endsection
