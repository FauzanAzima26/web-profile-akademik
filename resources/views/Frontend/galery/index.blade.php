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
                <form method="GET" action="{{ url('/galeri') }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <select name="prodi" class="form-select">
                                <option value="">Semua Program Studi</option>
                                <option value="informatika">Teknik Informatika</option>
                                <option value="sistem-informasi">Sistem Informasi</option>
                                <option value="elektro">Teknik Elektro</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select name="jenis" class="form-select">
                                <option value="">Semua Jenis</option>
                                <option value="foto">Foto</option>
                                <option value="video">Video</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                                <a href="{{ url('/galeri') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Gallery Content -->
        <div class="row g-4">
            <!-- Album 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ asset('assets/frontend/img/wisuda.jpg') }}"
                        class="card-img-top" alt="Wisuda" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">Foto</span>
                        <h5 class="card-title fw-bold">Wisuda Periode Mei 2024</h5>
                        <p class="card-text text-muted small">
                            Dokumentasi wisuda mahasiswa Teknik Informatika
                        </p>
                        <div class="d-flex justify-content-between text-muted small">
                            <span><i class="fas fa-calendar me-1"></i>15 Mei 2024</span>
                            <span><i class="fas fa-images me-1"></i>24 Foto</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-primary w-100">
                            <i class="fas fa-eye me-2"></i>Lihat Album
                        </a>
                    </div>
                </div>
            </div>

            <!-- Album 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Kompetisi" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-danger mb-2">Video</span>
                        <h5 class="card-title fw-bold">Kompetisi Programming Nasional</h5>
                        <p class="card-text text-muted small">
                            Video kompetisi programming mahasiswa Sistem Informasi
                        </p>
                        <div class="d-flex justify-content-between text-muted small">
                            <span><i class="fas fa-calendar me-1"></i>10 Mei 2024</span>
                            <span><i class="fas fa-film me-1"></i>5 Video</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-danger w-100">
                            <i class="fas fa-play-circle me-2"></i>Putar Video
                        </a>
                    </div>
                </div>
            </div>

            <!-- Album 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Seminar" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">Foto</span>
                        <h5 class="card-title fw-bold">Seminar Teknologi Terkini</h5>
                        <p class="card-text text-muted small">
                            Dokumentasi seminar untuk mahasiswa Teknik Elektro
                        </p>
                        <div class="d-flex justify-content-between text-muted small">
                            <span><i class="fas fa-calendar me-1"></i>5 Mei 2024</span>
                            <span><i class="fas fa-images me-1"></i>18 Foto</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-primary w-100">
                            <i class="fas fa-eye me-2"></i>Lihat Album
                        </a>
                    </div>
                </div>
            </div>

            <!-- Album 4 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Workshop" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-danger mb-2">Video</span>
                        <h5 class="card-title fw-bold">Workshop Robotika</h5>
                        <p class="card-text text-muted small">
                            Video workshop pembuatan robot sederhana
                        </p>
                        <div class="d-flex justify-content-between text-muted small">
                            <span><i class="fas fa-calendar me-1"></i>28 Apr 2024</span>
                            <span><i class="fas fa-film me-1"></i>3 Video</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-danger w-100">
                            <i class="fas fa-play-circle me-2"></i>Putar Video
                        </a>
                    </div>
                </div>
            </div>

            <!-- Album 5 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Kerjasama" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">Foto</span>
                        <h5 class="card-title fw-bold">Penandatanganan MoU Industri</h5>
                        <p class="card-text text-muted small">
                            Dokumentasi kerjasama dengan perusahaan
                        </p>
                        <div class="d-flex justify-content-between text-muted small">
                            <span><i class="fas fa-calendar me-1"></i>20 Apr 2024</span>
                            <span><i class="fas fa-images me-1"></i>15 Foto</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-primary w-100">
                            <i class="fas fa-eye me-2"></i>Lihat Album
                        </a>
                    </div>
                </div>
            </div>

            <!-- Album 6 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                        class="card-img-top" alt="Laboratorium" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">Foto</span>
                        <h5 class="card-title fw-bold">Praktikum Laboratorium</h5>
                        <p class="card-text text-muted small">
                            Aktivitas praktikum mahasiswa Teknik Sipil
                        </p>
                        <div class="d-flex justify-content-between text-muted small">
                            <span><i class="fas fa-calendar me-1"></i>15 Apr 2024</span>
                            <span><i class="fas fa-images me-1"></i>22 Foto</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <a href="#" class="btn btn-outline-primary w-100">
                            <i class="fas fa-eye me-2"></i>Lihat Album
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
