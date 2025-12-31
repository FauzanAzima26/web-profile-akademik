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

        <!-- Tabs Navigation -->
        <div class="mb-5">
            <ul class="nav nav-tabs" id="akademikTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="mata-kuliah-tab" data-bs-toggle="tab" data-bs-target="#mata-kuliah"
                        type="button">
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
                    <button class="nav-link" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal" type="button">
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
                                    <h5 class="fw-bold mb-3">Daftar Mata Kuliah</h5>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mataKuliah as $mk)
                                            <tr>
                                                <td>{{ $mk->kode }}</td>
                                                <td>{{ $mk->nama }}</td>
                                                <td>{{ $mk->sks }}</td>
                                                <td>{{ $mk->semester }}</td>
                                            </tr>
                                        @endforeach
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

                            <h5 class="fw-bold mb-4">
                                Struktur Kurikulum {{ $kurikulum->nama }}
                            </h5>

                            <div class="row">

                                <!-- Informasi Kurikulum -->
                                <div class="col-md-6 mb-4">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3">Informasi Umum</h6>

                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                                    <i class="bi bi-book text-primary"></i>
                                                </div>
                                                <div>
                                                    <h4 class="fw-bold mb-0">
                                                        {{ $kurikulum->total_sks }} SKS
                                                    </h4>
                                                    <small class="text-muted">Total SKS Kurikulum</small>
                                                </div>
                                            </div>

                                            <p class="mb-1">
                                                <strong>Tahun Berlaku:</strong> {{ $kurikulum->tahun }}
                                            </p>

                                            @if ($kurikulum->deskripsi)
                                                <p class="text-muted mt-3">
                                                    {{ $kurikulum->deskripsi }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Dokumen Kurikulum -->
                                <div class="col-md-6 mb-4">
                                    <div class="card border-0 bg-light h-100">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3">Dokumen Kurikulum</h6>

                                            <div class="d-flex align-items-center">
                                                <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                                    <i class="bi bi-file-earmark-pdf text-success"></i>
                                                </div>
                                                <div>
                                                    @if ($kurikulum->file_pdf)
                                                        <a href="{{ Storage::url('kurikulum/' . $kurikulum->file_pdf) }}"
                                                            target="_blank"
                                                            class="fw-bold text-success text-decoration-none">
                                                            Unduh Dokumen Kurikulum
                                                        </a>
                                                        <br>
                                                        <small class="text-muted">Format PDF</small>
                                                    @else
                                                        <span class="text-muted">Dokumen belum tersedia</span>
                                                    @endif
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

                            <!-- Header -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-3">Jadwal Perkuliahan</h5>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" id="semesterSelect">
                                        <option value="">Semua Semester</option>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}">Semester {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-hover" id="jadwalTable">
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
                                        @forelse ($jadwal as $j)
                                            <tr data-semester="{{ $j->mataKuliah->semester ?? '' }}">
                                                <td>{{ $j->hari }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                                                </td>
                                                <td>{{ $j->mataKuliah->nama ?? '-' }}</td>
                                                <td>{{ $j->ruangan }}</td>
                                                <td>{{ $j->dosen->nama ?? '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">
                                                    Jadwal perkuliahan belum tersedia
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="text-center text-muted mt-3 d-none" id="emptySemester">
                                    Tidak ada mata kuliah pada semester ini
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('semesterSelect').addEventListener('change', function() {
            const semester = this.value;
            const rows = document.querySelectorAll('#jadwalTable tbody tr');
            const emptyMsg = document.getElementById('emptySemester');

            let visibleCount = 0;

            rows.forEach(row => {
                const rowSemester = row.dataset.semester;

                if (!semester || rowSemester === semester) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Tampilkan pesan jika tidak ada data
            if (visibleCount === 0) {
                emptyMsg.classList.remove('d-none');
            } else {
                emptyMsg.classList.add('d-none');
            }
        });
    </script>


@endsection
