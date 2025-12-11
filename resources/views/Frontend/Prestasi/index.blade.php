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
            <div class="col-md-4 mb-2">
                <select id="filterKategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    <option value="akademik">Akademik</option>
                    <option value="non-akademik">Non Akademik</option>
                    <option value="kompetisi">Kompetisi</option>
                    <option value="organisasi">Organisasi</option>
                </select>
            </div>

            <div class="col-md-3 mb-2">
                <select id="filterTahun" class="form-select">
                    <option value="">Semua Tahun</option>
                    @for ($i = date('Y'); $i >= 2000; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-2 mb-2">
                <button class="btn btn-primary w-100" id="btnFilter">Filter</button>
            </div>
        </div>

        <!-- Card List -->
        <div class="row g-4">
            <!-- Card Example 1 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Prestasi">

                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-primary mb-2 text-capitalize">akademik</span>

                        <h5 class="fw-bold">Lorem ipsum dolor sit amet</h5>

                        <p class="text-muted small mb-1">Mahasiswa: Lorem Ipsum</p>
                        <p class="text-muted small mb-2">Tahun: 2023</p>

                        <p class="flex-grow-1">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Integer nec odio. Praesent libero.
                        </p>

                        <a href="#" class="btn btn-outline-primary mt-auto">Detail</a>
                    </div>
                </div>
            </div>

            <!-- Card Example 2 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Prestasi">

                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-success mb-2 text-capitalize">non-akademik</span>

                        <h5 class="fw-bold">Lorem ipsum dolor sit amet</h5>

                        <p class="text-muted small mb-1">Mahasiswa: Lorem Ipsum</p>
                        <p class="text-muted small mb-2">Tahun: 2022</p>

                        <p class="flex-grow-1">
                            Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet.
                        </p>

                        <a href="#" class="btn btn-outline-primary mt-auto">Detail</a>
                    </div>
                </div>
            </div>

            <!-- Card Example 3 -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Prestasi">

                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-warning mb-2 text-capitalize">kompetisi</span>

                        <h5 class="fw-bold">Lorem ipsum dolor sit amet</h5>

                        <p class="text-muted small mb-1">Mahasiswa: Lorem Ipsum</p>
                        <p class="text-muted small mb-2">Tahun: 2024</p>

                        <p class="flex-grow-1">
                            Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta.
                        </p>

                        <a href="#" class="btn btn-outline-primary mt-auto">Detail</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            <nav>
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link">Previous</a></li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">Next</a></li>
                </ul>
            </nav>
        </div>

    </div>
@endsection
