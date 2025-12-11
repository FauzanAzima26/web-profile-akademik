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

        <!-- Filter Section -->
        <div class="card shadow border-0 mb-5">
            <div class="card-body">
                <form method="GET" action="{{ url('/berita-agenda') }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <select name="kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                <option value="berita">Berita</option>
                                <option value="agenda">Agenda</option>
                                <option value="pengumuman">Pengumuman</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select name="tahun" class="form-select">
                                <option value="">Semua Tahun</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                                <a href="{{ url('/berita-agenda') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- News List -->
        <div class="row g-4">
            <!-- News 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ asset('assets/images/sejarah-ti.png') }}" class="card-img-top" alt="Wisuda"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">Berita</span>
                        <h5 class="card-title fw-bold">Wisuda Periode Mei 2024</h5>
                        <div class="d-flex text-muted small mb-3">
                            <span class="me-3"><i class="fas fa-calendar me-1"></i>15 Mei 2024</span>
                            <span><i class="fas fa-eye me-1"></i>245 views</span>
                        </div>
                        <p class="card-text text-muted">
                            Universitas menyelenggarakan wisuda periode Mei 2024 dengan 500 mahasiswa.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-primary w-100">
                            <i class="fas fa-book-open me-2"></i>Baca Berita
                        </a>
                    </div>
                </div>
            </div>

            <!-- News 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Workshop" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-warning mb-2">Agenda</span>
                        <h5 class="card-title fw-bold">Workshop Artikel Ilmiah</h5>
                        <div class="d-flex text-muted small mb-3">
                            <span class="me-3"><i class="fas fa-calendar me-1"></i>25-27 Mei</span>
                            <span><i class="fas fa-map-marker-alt me-1"></i>R. Seminar</span>
                        </div>
                        <p class="card-text text-muted">
                            Workshop penulisan artikel ilmiah untuk meningkatkan publikasi dosen.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-warning w-100">
                            <i class="fas fa-info-circle me-2"></i>Detail Agenda
                        </a>
                    </div>
                </div>
            </div>

            <!-- News 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ asset('assets/frontend/img/beasiswa.jpg') }}" class="card-img-top" alt="Beasiswa"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">Pengumuman</span>
                        <h5 class="card-title fw-bold">Beasiswa Prestasi 2024</h5>
                        <div class="d-flex text-muted small mb-3">
                            <span class="me-3"><i class="fas fa-calendar me-1"></i>1-30 Juni</span>
                            <span><i class="fas fa-clock me-1"></i>Batas: 30 Juni</span>
                        </div>
                        <p class="card-text text-muted">
                            Pendaftaran beasiswa prestasi untuk mahasiswa aktif dengan IPK minimal 3.5.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-success w-100">
                            <i class="fas fa-download me-2"></i>Download Form
                        </a>
                    </div>
                </div>
            </div>

            <!-- News 4 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Kompetisi" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-info mb-2">Event</span>
                        <h5 class="card-title fw-bold">Kompetisi Programming Nasional</h5>
                        <div class="d-flex text-muted small mb-3">
                            <span class="me-3"><i class="fas fa-calendar me-1"></i>15 Juli 2024</span>
                            <span><i class="fas fa-users me-1"></i>Tim 3 orang</span>
                        </div>
                        <p class="card-text text-muted">
                            Kompetisi programming nasional dengan total hadiah 50 juta rupiah.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-info w-100">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <!-- News 5 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Kerjasama" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">Berita</span>
                        <h5 class="card-title fw-bold">Penandatanganan MoU</h5>
                        <div class="d-flex text-muted small mb-3">
                            <span class="me-3"><i class="fas fa-calendar me-1"></i>10 Mei 2024</span>
                            <span><i class="fas fa-handshake me-1"></i>Kerjasama</span>
                        </div>
                        <p class="card-text text-muted">
                            Universitas menjalin kerjasama dengan perusahaan teknologi terkemuka.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-primary w-100">
                            <i class="fas fa-book-open me-2"></i>Baca Berita
                        </a>
                    </div>
                </div>
            </div>

            <!-- News 6 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Perpustakaan" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-warning mb-2">Agenda</span>
                        <h5 class="card-title fw-bold">Pemeliharaan Perpustakaan Online</h5>
                        <div class="d-flex text-muted small mb-3">
                            <span class="me-3"><i class="fas fa-calendar me-1"></i>28 Mei 2024</span>
                            <span><i class="fas fa-clock me-1"></i>08:00-12:00</span>
                        </div>
                        <p class="card-text text-muted">
                            Sistem perpustakaan online akan dilakukan pemeliharaan rutin.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-warning w-100">
                            <i class="fas fa-info-circle me-2"></i>Detail Agenda
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
