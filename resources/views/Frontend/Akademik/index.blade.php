@extends('Frontend.layouts.main')

@section('title', 'Akademik & Kurikulum')

@section('content')
    <div class="container py-5">
        <!-- Header -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="text-center mb-4">
                    <h1 class="fw-bold display-5 mb-3">Akademik & Kurikulum</h1>
                    <p class="lead text-muted">
                        Informasi mata kuliah, struktur kurikulum, dan jadwal program studi
                    </p>
                </div>
            </div>
        </div>

        <!-- Program Studi Selection -->
        <div class="card shadow border-0 mb-5">
            <div class="card-body">
                <form method="GET" action="{{ url('/akademik') }}">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <select name="prodi" class="form-select" onchange="this.form.submit()">
                                <option value="">Pilih Program Studi</option>
                                <option value="informatika" {{ request('prodi') == 'informatika' ? 'selected' : '' }}>
                                    Teknik Informatika
                                </option>
                                <option value="sistem-informasi"
                                    {{ request('prodi') == 'sistem-informasi' ? 'selected' : '' }}>
                                    Sistem Informasi
                                </option>
                                <option value="elektro" {{ request('prodi') == 'elektro' ? 'selected' : '' }}>
                                    Teknik Elektro
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <a href="{{ url('/akademik') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-redo"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (request('prodi'))
            <!-- Tabs Navigation -->
            <div class="mb-5">
                <ul class="nav nav-tabs" id="akademikTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="mata-kuliah-tab" data-bs-toggle="tab"
                            data-bs-target="#mata-kuliah" type="button">
                            <i class="fas fa-book me-2"></i>Mata Kuliah
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="kurikulum-tab" data-bs-toggle="tab" data-bs-target="#kurikulum"
                            type="button">
                            <i class="fas fa-sitemap me-2"></i>Struktur Kurikulum
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal"
                            type="button">
                            <i class="fas fa-calendar-alt me-2"></i>Jadwal
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="akademikTabContent">
                    <!-- Tab 1: Mata Kuliah -->
                    <div class="tab-pane fade show active" id="mata-kuliah" role="tabpanel">
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-3">Daftar Mata Kuliah Teknik Informatika</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari mata kuliah...">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Kode</th>
                                                <th>Mata Kuliah</th>
                                                <th>SKS</th>
                                                <th>Semester</th>
                                                <th>Kategori</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>IF101</td>
                                                <td>Pemrograman Dasar</td>
                                                <td>3</td>
                                                <td>1</td>
                                                <td><span class="badge bg-primary">Wajib</span></td>
                                            </tr>
                                            <tr>
                                                <td>IF102</td>
                                                <td>Algoritma dan Struktur Data</td>
                                                <td>3</td>
                                                <td>2</td>
                                                <td><span class="badge bg-primary">Wajib</span></td>
                                            </tr>
                                            <tr>
                                                <td>IF201</td>
                                                <td>Basis Data</td>
                                                <td>3</td>
                                                <td>3</td>
                                                <td><span class="badge bg-primary">Wajib</span></td>
                                            </tr>
                                            <tr>
                                                <td>IF202</td>
                                                <td>Pemrograman Web</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td><span class="badge bg-primary">Wajib</span></td>
                                            </tr>
                                            <tr>
                                                <td>IF301</td>
                                                <td>Machine Learning</td>
                                                <td>3</td>
                                                <td>5</td>
                                                <td><span class="badge bg-success">Pilihan</span></td>
                                            </tr>
                                            <tr>
                                                <td>IF302</td>
                                                <td>Keamanan Jaringan</td>
                                                <td>3</td>
                                                <td>6</td>
                                                <td><span class="badge bg-success">Pilihan</span></td>
                                            </tr>
                                            <tr>
                                                <td>IF401</td>
                                                <td>Skripsi</td>
                                                <td>6</td>
                                                <td>7</td>
                                                <td><span class="badge bg-warning">Tugas Akhir</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Struktur Kurikulum -->
                    <div class="tab-pane fade" id="kurikulum" role="tabpanel">
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-body">
                                <h5 class="fw-bold mb-4">Struktur Kurikulum Teknik Informatika</h5>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="card border-0 bg-light h-100">
                                            <div class="card-body">
                                                <h6 class="fw-bold mb-3">Mata Kuliah Wajib</h6>
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                                        <i class="fas fa-book text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h4 class="fw-bold mb-0">120 SKS</h4>
                                                        <small class="text-muted">Total SKS wajib</small>
                                                    </div>
                                                </div>
                                                <ul class="mt-3">
                                                    <li>Pemrograman Dasar (3 SKS)</li>
                                                    <li>Algoritma dan Struktur Data (3 SKS)</li>
                                                    <li>Basis Data (3 SKS)</li>
                                                    <li>Pemrograman Web (3 SKS)</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <div class="card border-0 bg-light h-100">
                                            <div class="card-body">
                                                <h6 class="fw-bold mb-3">Mata Kuliah Pilihan</h6>
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                                        <i class="fas fa-book-open text-success"></i>
                                                    </div>
                                                    <div>
                                                        <h4 class="fw-bold mb-0">24 SKS</h4>
                                                        <small class="text-muted">Total SKS pilihan</small>
                                                    </div>
                                                </div>
                                                <ul class="mt-3">
                                                    <li>Machine Learning (3 SKS)</li>
                                                    <li>Keamanan Jaringan (3 SKS)</li>
                                                    <li>IoT dan Embedded System (3 SKS)</li>
                                                    <li>Mobile Programming (3 SKS)</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card border-0 bg-primary text-white">
                                            <div class="card-body">
                                                <h6 class="fw-bold mb-3">Total SKS Kurikulum</h6>
                                                <div class="row text-center">
                                                    <div class="col-md-3 mb-3">
                                                        <h2 class="fw-bold mb-1">144</h2>
                                                        <small>Total SKS</small>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <h2 class="fw-bold mb-1">8</h2>
                                                        <small>Semester</small>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <h2 class="fw-bold mb-1">48</h2>
                                                        <small>Mata Kuliah</small>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <h2 class="fw-bold mb-1">4</h2>
                                                        <small>Tahun</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: Jadwal -->
                    <div class="tab-pane fade" id="jadwal" role="tabpanel">
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <h5 class="fw-bold mb-3">Jadwal Perkuliahan</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select" id="semesterSelect">
                                            <option value="">Semua Semester</option>
                                            <option value="1">Semester 1</option>
                                            <option value="2">Semester 2</option>
                                            <option value="3">Semester 3</option>
                                            <option value="4">Semester 4</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Mata Kuliah</th>
                                                <th>Ruangan</th>
                                                <th>Dosen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Senin</td>
                                                <td>08:00 - 10:30</td>
                                                <td>Pemrograman Dasar</td>
                                                <td>Lab. Komputer 1</td>
                                                <td>Dr. Ahmad Wijaya, M.Kom.</td>
                                            </tr>
                                            <tr>
                                                <td>Senin</td>
                                                <td>13:00 - 15:30</td>
                                                <td>Algoritma dan Struktur Data</td>
                                                <td>R. 301</td>
                                                <td>Prof. Dr. Siti Aminah, M.Si.</td>
                                            </tr>
                                            <tr>
                                                <td>Selasa</td>
                                                <td>08:00 - 10:30</td>
                                                <td>Basis Data</td>
                                                <td>Lab. Komputer 2</td>
                                                <td>Dr. Bambang Sutrisno, M.Sc.</td>
                                            </tr>
                                            <tr>
                                                <td>Rabu</td>
                                                <td>10:30 - 13:00</td>
                                                <td>Pemrograman Web</td>
                                                <td>Lab. Komputer 3</td>
                                                <td>Drs. Muhammad Ali, M.T.</td>
                                            </tr>
                                            <tr>
                                                <td>Kamis</td>
                                                <td>13:00 - 15:30</td>
                                                <td>Machine Learning</td>
                                                <td>R. 302</td>
                                                <td>Dr. Rina Wijayanti, M.Kom.</td>
                                            </tr>
                                            <tr>
                                                <td>Jumat</td>
                                                <td>08:00 - 10:30</td>
                                                <td>Keamanan Jaringan</td>
                                                <td>Lab. Komputer 4</td>
                                                <td>Ir. Budi Santoso, M.Sc.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Download Section -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-download text-primary me-2"></i>Dokumen Kurikulum
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-pdf text-danger fa-3x mb-3"></i>
                                    <h6 class="fw-bold">Kurikulum 2024</h6>
                                    <small class="text-muted">PDF, 2.5 MB</small>
                                    <div class="mt-3">
                                        <a href="#" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-download me-2"></i>Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-excel text-success fa-3x mb-3"></i>
                                    <h6 class="fw-bold">Struktur Kurikulum</h6>
                                    <small class="text-muted">Excel, 1.2 MB</small>
                                    <div class="mt-3">
                                        <a href="#" class="btn btn-outline-success btn-sm">
                                            <i class="fas fa-download me-2"></i>Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border">
                                <div class="card-body text-center">
                                    <i class="fas fa-calendar-alt text-primary fa-3x mb-3"></i>
                                    <h6 class="fw-bold">Jadwal Akademik</h6>
                                    <small class="text-muted">PDF, 1.8 MB</small>
                                    <div class="mt-3">
                                        <a href="#" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-download me-2"></i>Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-graduation-cap fa-4x text-muted"></i>
                </div>
                <h4 class="fw-bold text-muted mb-3">Pilih Program Studi</h4>
                <p class="text-muted mb-4">Silakan pilih program studi untuk melihat informasi akademik dan kurikulum</p>
            </div>
        @endif
    </div>
@endsection
