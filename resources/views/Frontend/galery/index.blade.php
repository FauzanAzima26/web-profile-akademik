    @extends('Frontend.layouts.main')

    @section('title', 'Galeri Program Studi')

    @section('content')
        <div class="container py-5">
            <!-- Header -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="text-center mb-4">
                        <h1 class="fw-bold display-5 mb-3">Galeri Program Studi</h1>
                        <p class="lead text-muted">
                            Dokumentasi foto dan video kegiatan program studi
                        </p>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="card shadow border-0 mb-5">
                <div class="card-body">
                    <form method="GET" action="{{ url('/galery') }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <select name="kategori" class="form-select">
                                    <option value="">Semua Kategori</option>
                                    @foreach (['kegiatan', 'fasilitas', 'akademik', 'lainnya'] as $k)
                                        <option value="{{ $k }}" {{ request('kategori') == $k ? 'selected' : '' }}>
                                            {{ ucwords($k) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
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

            <!-- Gallery Content -->
            <div class="row g-4">
                @forelse ($galeri as $g)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('storage/galeri/' . $g->gambar) }}" class="card-img-top"
                                alt="{{ $g->judul }}" style="height: 200px; object-fit: cover;">

                            <div class="card-body">
                                <span class="badge bg-primary mb-2 text-capitalize">
                                    {{ $g->kategori }}
                                </span>

                                <h5 class="card-title fw-bold">{{ $g->judul }}</h5>
                                <p class="card-text text-muted small">
                                    {{ Str::limit(strip_tags($g->deskripsi), 100) }}
                                </p>
                            </div>

                            <div class="card-footer bg-transparent border-top">
                                <a href="{{ asset('storage/galeri/' . $g->gambar) }}" class="btn btn-outline-primary w-100"
                                    target="_blank">
                                    <i class="fas fa-eye me-2"></i>Lihat Gambar
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">
                        <i class="fas fa-images fa-2x mb-3"></i>
                        <p class="mb-0">Galeri belum tersedia.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $galeri->links() }}
            </div>

        </div>
    @endsection
