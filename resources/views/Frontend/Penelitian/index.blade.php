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
                                <option value="penelitian">Penelitian</option>
                                <option value="pengabdian">Pengabdian</option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label class="form-label fw-semibold">Tahun</label>
                            <select name="tahun" class="form-select border-primary">
                                <option value="">Semua Tahun</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label class="form-label fw-semibold">Program Studi</label>
                            <select name="prodi" class="form-select border-primary">
                                <option value="">Semua Prodi</option>
                                <option value="1">Teknik Informatika</option>
                                <option value="2">Sistem Informasi</option>
                                <option value="3">Teknik Elektro</option>
                            </select>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label class="form-label fw-semibold">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                                <a href="{{ url('/penelitian') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Content Cards -->
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary px-3 py-2">
                                <i class="fas fa-microscope me-1"></i>Penelitian
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-calendar me-1"></i>2024
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">
                            Pengembangan Sistem IoT untuk Smart Agriculture Berbasis Machine Learning
                        </h5>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-user-tie text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Ketua Peneliti</small>
                                    <span class="fw-semibold">Dr. Ahmad Wijaya, M.Kom.</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-users text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Anggota</small>
                                    <span>3 orang</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-university text-info"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Program Studi</small>
                                    <span>Teknik Informatika</span>
                                </div>
                            </div>
                        </div>

                        <p class="card-text text-muted">
                            Penelitian ini mengembangkan sistem Internet of Things untuk monitoring tanaman berbasis machine
                            learning dengan akurasi mencapai 95%.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>Detail
                            </a>
                            <div>
                                <span class="badge bg-light text-dark me-2">
                                    <i class="fas fa-file-pdf text-danger me-1"></i>PDF
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-link text-primary me-1"></i>Link
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-success px-3 py-2">
                                <i class="fas fa-hands-helping me-1"></i>Pengabdian
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-calendar me-1"></i>2023
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">
                            Pelatihan Digital Marketing untuk UMKM di Desa Sukamaju
                        </h5>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-user-tie text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Ketua Pelaksana</small>
                                    <span class="fw-semibold">Prof. Dr. Siti Aminah, M.Si.</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-users text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Peserta</small>
                                    <span>50 UMKM</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-university text-info"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Program Studi</small>
                                    <span>Sistem Informasi</span>
                                </div>
                            </div>
                        </div>

                        <p class="card-text text-muted">
                            Pengabdian masyarakat berupa pelatihan digital marketing untuk meningkatkan penjualan produk
                            UMKM lokal melalui platform online.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-outline-success">
                                <i class="fas fa-eye me-2"></i>Detail
                            </a>
                            <div>
                                <span class="badge bg-light text-dark me-2">
                                    <i class="fas fa-images text-info me-1"></i>Galeri
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-video text-danger me-1"></i>Video
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary px-3 py-2">
                                <i class="fas fa-microscope me-1"></i>Penelitian
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-calendar me-1"></i>2024
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">
                            Analisis Big Data untuk Prediksi Penyebaran Penyakit Menular
                        </h5>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-user-tie text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Ketua Peneliti</small>
                                    <span class="fw-semibold">Dr. Bambang Sutrisno, M.Sc.</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-users text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Anggota</small>
                                    <span>5 orang</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-university text-info"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Program Studi</small>
                                    <span>Teknik Elektro</span>
                                </div>
                            </div>
                        </div>

                        <p class="card-text text-muted">
                            Penelitian tentang implementasi algoritma machine learning untuk analisis big data dalam
                            memprediksi penyebaran penyakit menular di wilayah urban.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>Detail
                            </a>
                            <div>
                                <span class="badge bg-light text-dark me-2">
                                    <i class="fas fa-database text-warning me-1"></i>Dataset
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-code text-success me-1"></i>Source
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-success px-3 py-2">
                                <i class="fas fa-hands-helping me-1"></i>Pengabdian
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-calendar me-1"></i>2023
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">
                            Workshop Pembuatan Website untuk Sekolah Dasar
                        </h5>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-user-tie text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Ketua Pelaksana</small>
                                    <span class="fw-semibold">Drs. Muhammad Ali, M.T.</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-users text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Peserta</small>
                                    <span>15 Sekolah</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-university text-info"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Program Studi</small>
                                    <span>Teknik Informatika</span>
                                </div>
                            </div>
                        </div>

                        <p class="card-text text-muted">
                            Kegiatan pengabdian berupa workshop pembuatan website sederhana untuk sekolah dasar menggunakan
                            CMS WordPress.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-outline-success">
                                <i class="fas fa-eye me-2"></i>Detail
                            </a>
                            <div>
                                <span class="badge bg-light text-dark me-2">
                                    <i class="fas fa-link text-primary me-1"></i>Demo
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-file-pdf text-danger me-1"></i>Materi
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary px-3 py-2">
                                <i class="fas fa-microscope me-1"></i>Penelitian
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-calendar me-1"></i>2022
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">
                            Pengembangan Aplikasi Mobile untuk Deteksi Dini Autisme pada Anak
                        </h5>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-user-tie text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Ketua Peneliti</small>
                                    <span class="fw-semibold">Dr. Rina Wijayanti, M.Kom.</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-users text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Anggota</small>
                                    <span>4 orang</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-university text-info"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Program Studi</small>
                                    <span>Sistem Informasi</span>
                                </div>
                            </div>
                        </div>

                        <p class="card-text text-muted">
                            Penelitian kolaboratif dengan rumah sakit untuk mengembangkan aplikasi mobile yang dapat
                            membantu deteksi dini autisme pada anak usia dini.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>Detail
                            </a>
                            <div>
                                <span class="badge bg-light text-dark me-2">
                                    <i class="fas fa-mobile-alt text-info me-1"></i>App
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-award text-warning me-1"></i>HKI
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-success px-3 py-2">
                                <i class="fas fa-hands-helping me-1"></i>Pengabdian
                            </span>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-calendar me-1"></i>2022
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">
                            Sosialisasi Keamanan Siber untuk Instansi Pemerintah Daerah
                        </h5>

                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-user-tie text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Ketua Pelaksana</small>
                                    <span class="fw-semibold">Ir. Budi Santoso, M.Sc.</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-success bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-users text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Peserta</small>
                                    <span>100 Pegawai</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-2 rounded me-3">
                                    <i class="fas fa-university text-info"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Program Studi</small>
                                    <span>Teknik Elektro</span>
                                </div>
                            </div>
                        </div>

                        <p class="card-text text-muted">
                            Pengabdian masyarakat berupa sosialisasi dan pelatihan keamanan siber untuk meningkatkan
                            awareness pegawai pemerintahan terhadap ancaman cyber.
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-top pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-outline-success">
                                <i class="fas fa-eye me-2"></i>Detail
                            </a>
                            <div>
                                <span class="badge bg-light text-dark me-2">
                                    <i class="fas fa-shield-alt text-success me-1"></i>Security
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-certificate text-warning me-1"></i>Sertifikat
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Info Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 bg-light">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-9">
                                <h4 class="fw-bold mb-2">Ingin mengajukan penelitian atau pengabdian?</h4>
                                <p class="text-muted mb-0">
                                    Hubungi Lembaga Penelitian dan Pengabdian Masyarakat untuk informasi lebih lanjut.
                                </p>
                            </div>
                            <div class="col-md-3 text-md-end mt-3 mt-md-0">
                                <a href="{{ url('/kontak') }}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-envelope me-2"></i>Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
