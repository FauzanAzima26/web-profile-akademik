@extends('Frontend.layouts.main')

@section('title', 'Penelitian & Pengabdian Dosen')

@section('content')
    <div class="container py-5">
        <!-- Header -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="text-center mb-4">
                    <h1 class="fw-bold display-5 mb-3">Penelitian & Pengabdian Dosen</h1>
                    <p class="lead text-muted">
                        Karya ilmiah dan kontribusi dosen dalam pengembangan ilmu pengetahuan dan masyarakat
                    </p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card shadow border-0 mb-5">
            <div class="card-body p-4">
                <h4 class="card-title fw-bold mb-4">
                    <i class="fas fa-filter text-primary me-2"></i>Filter Data
                </h4>
                <form method="GET" action="{{ url('/penelitian') }}">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label fw-semibold">Jenis Kegiatan</label>
                            <select name="jenis" class="form-select border-primary">
                                <option value="">Semua Jenis</option>
                                <option value="penelitian" {{ request('jenis') == 'penelitian' ? 'selected' : '' }}>
                                    Penelitian
                                </option>
                                <option value="pengabdian" {{ request('jenis') == 'pengabdian' ? 'selected' : '' }}>
                                    Pengabdian
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label class="form-label fw-semibold">Tahun</label>
                            <select name="tahun" class="form-select border-primary">
                                <option value="">Semua Tahun</option>
                                @foreach ([2024, 2023, 2022, 2021] as $th)
                                    <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>
                                        {{ $th }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label class="form-label fw-semibold">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Content Cards -->
        <div class="row g-4">
            <!-- Card 1 -->
            @if ($jenis == '' || $jenis == 'penelitian')
                @foreach ($penelitian as $p)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm">

                            <div class="card-header bg-transparent border-0 pt-4">
                                <div class="d-flex justify-content-between">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-microscope me-1"></i> Penelitian
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        {{ $p->tahun }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="fw-bold mb-3">{{ $p->judul }}</h5>

                                {{-- Ketua --}}
                                @php
                                    $ketua = $p->dosen->first(function ($d) {
                                        return strtolower($d->pivot->peran) === 'ketua';
                                    });
                                @endphp

                                <p class="mb-1">
                                    <strong>Ketua:</strong>
                                    {{ $ketua->nama ?? '-' }}
                                </p>

                                <p class="mb-2">
                                    <strong>Anggota:</strong>
                                    {{ $p->dosen->count() - ($ketua ? 1 : 0) }} orang
                                </p>

                                <p class="text-muted">
                                    {{ Str::limit(strip_tags($p->abstrak), 120) }}
                                </p>
                            </div>

                            <div class="card-footer bg-transparent">
                                @if ($p->file_url)
                                    <a href="{{ Storage::url('penelitian/' . $p->file_url) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-file-pdf me-1"></i> PDF
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            @endif

            @if ($jenis == '' || $jenis == 'pengabdian')
                @foreach ($pengabdian as $pg)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm">

                            <div class="card-header bg-transparent border-0 pt-4">
                                <div class="d-flex justify-content-between">
                                    <span class="badge bg-success">
                                        <i class="fas fa-hands-helping me-1"></i> Pengabdian
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        {{ $pg->tahun }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body">
                                <h5 class="fw-bold mb-3">{{ $pg->judul }}</h5>

                                <p class="mb-1">
                                    <strong>Pelaksana:</strong>
                                    {{ $pg->dosen->nama ?? '-' }}
                                </p>

                                <p class="mb-1">
                                    <strong>Lokasi:</strong>
                                    {{ $pg->lokasi ?? '-' }}
                                </p>

                                <p class="text-muted">
                                    {{ Str::limit(strip_tags($pg->deskripsi), 120) }}
                                </p>
                            </div>

                            <div class="card-footer bg-transparent text-end">
                                @if ($pg->foto_url)
                                    <a href="{{ Storage::url('pengabdian/' . $pg->foto_url) }}" target="_blank"
                                        class="badge bg-light text-dark text-decoration-none">
                                        <i class="fas fa-image text-info"></i> Lihat Dokumentasi
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            @if (($jenis == 'penelitian' && $penelitian->isEmpty()) || ($jenis == 'pengabdian' && $pengabdian->isEmpty()))
                <div class="col-12 text-center text-muted">
                    Data belum tersedia
                </div>
            @endif

        </div>
    </div>
@endsection
