@extends('Frontend.layouts.main')

@section('title', 'Kurikulum & Jadwal')

@push('styles')
    <style>
        /* Warna tab normal */
        .nav-pills .nav-link {
            color: #436e62;
            border: 1px solid #436e62;
        }

        /* Warna saat tab aktif */
        .nav-pills .nav-link.active {
            background-color: #436e62;
            color: white;
        }

        /* Hover efek (opsional) */
        .nav-pills .nav-link:hover {
            background-color: #436e62;
            color: white;
        }
    </style>
@endpush

@section('content')
    <section id="kurikulum" class="section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h3>Kurikulum & Jadwal #2f5d50</h3>
                    <p class="text-muted">Struktur kurikulum, daftar mata kuliah, dan jadwal perkuliahan — semua pada satu
                        halaman</p>
                </div>
            </div>

            <!-- Nav Tabs -->
            <div class="row mb-3">
                <div class="col-12">
                    <ul class="nav nav-pills nav-justified mb-3" id="ktab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-kurikulum" data-bs-toggle="pill"
                                data-bs-target="#pane-kurikulum" type="button" role="tab">Struktur Kurikulum</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-mk" data-bs-toggle="pill" data-bs-target="#pane-mk"
                                type="button" role="tab">Daftar Mata Kuliah</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-jadwal" data-bs-toggle="pill" data-bs-target="#pane-jadwal"
                                type="button" role="tab">Jadwal</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content">
                <!-- Struktur Kurikulum -->
                <div class="tab-pane fade show active" id="pane-kurikulum" role="tabpanel" aria-labelledby="tab-kurikulum">
                    <div class="card shadow-sm mb-4" data-aos="fade-up" data-aos-delay="150">
                        <div class="card-body">
                            <h5 class="card-title">Struktur Kurikulum</h5>
                            <p class="text-muted">Visual sederhana alur mata kuliah per semester. Gunakan data `$curriculum`
                                (array grouped by semester).</p>

                            <!-- Gunakan accordion per semester -->
                            <div class="accordion" id="kurAccordion">
                                @php
                                    // contoh struktur kalau controller tidak memberikan data
                                    $defaultCurriculum = [
                                        1 => [
                                            ['kode' => 'IF101', 'nama' => 'Pengantar Informatika', 'sks' => 2],
                                            ['kode' => 'IF102', 'nama' => 'Algoritma dan Pemrograman', 'sks' => 3],
                                            ['kode' => 'IF103', 'nama' => 'Matematika Diskrit', 'sks' => 3],
                                            ['kode' => 'IF104', 'nama' => 'Logika Informatika', 'sks' => 2],
                                        ],
                                        2 => [
                                            ['kode' => 'IF201', 'nama' => 'Struktur Data', 'sks' => 3],
                                            [
                                                'kode' => 'IF202',
                                                'nama' => 'Organisasi & Arsitektur Komputer',
                                                'sks' => 3,
                                            ],
                                            ['kode' => 'IF203', 'nama' => 'Sistem Operasi', 'sks' => 3],
                                            ['kode' => 'IF204', 'nama' => 'Basis Data', 'sks' => 3],
                                        ],
                                        3 => [
                                            ['kode' => 'IF301', 'nama' => 'Pemrograman Berorientasi Objek', 'sks' => 3],
                                            ['kode' => 'IF302', 'nama' => 'Jaringan Komputer', 'sks' => 3],
                                            ['kode' => 'IF303', 'nama' => 'Analisis & Perancangan Sistem', 'sks' => 3],
                                            ['kode' => 'IF304', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 3],
                                        ],
                                        4 => [
                                            ['kode' => 'IF401', 'nama' => 'Pengembangan Aplikasi Web', 'sks' => 3],
                                            ['kode' => 'IF402', 'nama' => 'Kecerdasan Buatan', 'sks' => 3],
                                            ['kode' => 'IF403', 'nama' => 'Interaksi Manusia & Komputer', 'sks' => 3],
                                            ['kode' => 'IF404', 'nama' => 'Keamanan Informasi', 'sks' => 3],
                                        ],
                                        5 => [
                                            ['kode' => 'IF501', 'nama' => 'Data Mining', 'sks' => 3],
                                            ['kode' => 'IF502', 'nama' => 'Machine Learning', 'sks' => 3],
                                            ['kode' => 'IF503', 'nama' => 'Pemrograman Mobile', 'sks' => 3],
                                            ['kode' => 'IF504', 'nama' => 'Manajemen Proyek TI', 'sks' => 3],
                                        ],
                                        6 => [
                                            ['kode' => 'IF601', 'nama' => 'Deep Learning', 'sks' => 3],
                                            ['kode' => 'IF602', 'nama' => 'Cloud Computing', 'sks' => 3],
                                            ['kode' => 'IF603', 'nama' => 'Sistem Terdistribusi', 'sks' => 3],
                                            ['kode' => 'IF604', 'nama' => 'Entrepreneurship Teknologi', 'sks' => 2],
                                        ],
                                        7 => [
                                            ['kode' => 'IF701', 'nama' => 'KKN / Magang', 'sks' => 3],
                                            ['kode' => 'IF702', 'nama' => 'Metodologi Penelitian', 'sks' => 2],
                                            ['kode' => 'IF703', 'nama' => 'Teknologi Blockchain', 'sks' => 3],
                                        ],
                                        8 => [
                                            ['kode' => 'IF801', 'nama' => 'Skripsi', 'sks' => 6],
                                            ['kode' => 'IF802', 'nama' => 'Seminar Proposal', 'sks' => 2],
                                        ],
                                    ];
                                    $curr = $curriculum ?? $defaultCurriculum;
                                @endphp

                                @foreach ($curr as $sem => $mks)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-{{ $sem }}">
                                            <button class="accordion-button {{ $sem > 1 ? 'collapsed' : '' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse-{{ $sem }}"
                                                aria-expanded="{{ $sem == 1 ? 'true' : 'false' }}">
                                                Semester {{ $sem }} — ({{ collect($mks)->sum('sks') }} SKS)
                                            </button>
                                        </h2>
                                        <div id="collapse-{{ $sem }}"
                                            class="accordion-collapse collapse {{ $sem == 1 ? 'show' : '' }}"
                                            data-bs-parent="#kurAccordion">
                                            <div class="accordion-body">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-striped align-middle">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Kode</th>
                                                                <th>Nama Mata Kuliah</th>
                                                                <th class="text-center">SKS</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($mks as $mk)
                                                                <tr>
                                                                    <td>{{ $mk['kode'] ?? '-' }}</td>
                                                                    <td>{{ $mk['nama'] ?? '-' }}</td>
                                                                    <td class="text-center">{{ $mk['sks'] ?? '-' }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div> <!-- end accordion -->

                            <div class="mt-3">
                                <a href="#" class="btn btn-outline-primary btn-sm">Unduh PDF Kurikulum</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Mata Kuliah -->
                <div class="tab-pane fade" id="pane-mk" role="tabpanel" aria-labelledby="tab-mk">
                    <div class="card shadow-sm mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="card-title">Daftar Mata Kuliah</h5>
                                <div class="d-flex gap-2">
                                    <input id="search-mk" class="form-control form-control-sm" type="search"
                                        placeholder="Cari kode / nama / dosen" style="min-width:250px">
                                    <a class="btn btn-sm btn-outline-secondary" href="#"
                                        onclick="resetSearch()">Reset</a>
                                </div>
                            </div>

                            @php
                                // contoh data courses jika tidak tersedia
                                $defaultCourses = [
                                    (object) [
                                        'kode' => 'IF101',
                                        'nama' => 'Pengantar Informatika',
                                        'sks' => 2,
                                        'semester' => 1,
                                        'bidang' => 'Dasar Informatika',
                                        'dosen' => 'Dr. Andi',
                                    ],
                                    (object) [
                                        'kode' => 'IF102',
                                        'nama' => 'Algoritma dan Pemrograman',
                                        'sks' => 3,
                                        'semester' => 1,
                                        'bidang' => 'Pemrograman',
                                        'dosen' => 'Dr. Budi',
                                    ],
                                    (object) [
                                        'kode' => 'IF103',
                                        'nama' => 'Matematika Diskrit',
                                        'sks' => 3,
                                        'semester' => 1,
                                        'bidang' => 'Matematika',
                                        'dosen' => 'Dr. Rani',
                                    ],
                                    (object) [
                                        'kode' => 'IF201',
                                        'nama' => 'Struktur Data',
                                        'sks' => 3,
                                        'semester' => 2,
                                        'bidang' => 'Pemrograman',
                                        'dosen' => 'Dr. Sinta',
                                    ],
                                    (object) [
                                        'kode' => 'IF204',
                                        'nama' => 'Basis Data',
                                        'sks' => 3,
                                        'semester' => 2,
                                        'bidang' => 'Basis Data',
                                        'dosen' => 'Dr. Ahmad',
                                    ],
                                    (object) [
                                        'kode' => 'IF301',
                                        'nama' => 'OOP (Pemrograman Berorientasi Objek)',
                                        'sks' => 3,
                                        'semester' => 3,
                                        'bidang' => 'Pemrograman',
                                        'dosen' => 'Dr. Wulan',
                                    ],
                                    (object) [
                                        'kode' => 'IF302',
                                        'nama' => 'Jaringan Komputer',
                                        'sks' => 3,
                                        'semester' => 3,
                                        'bidang' => 'Jaringan',
                                        'dosen' => 'Dr. Yoga',
                                    ],
                                    (object) [
                                        'kode' => 'IF401',
                                        'nama' => 'Web Development',
                                        'sks' => 3,
                                        'semester' => 4,
                                        'bidang' => 'Web',
                                        'dosen' => 'Mr. Rizal',
                                    ],
                                    (object) [
                                        'kode' => 'IF402',
                                        'nama' => 'Kecerdasan Buatan',
                                        'sks' => 3,
                                        'semester' => 4,
                                        'bidang' => 'AI',
                                        'dosen' => 'Dr. Tono',
                                    ],
                                    (object) [
                                        'kode' => 'IF502',
                                        'nama' => 'Machine Learning',
                                        'sks' => 3,
                                        'semester' => 5,
                                        'bidang' => 'AI',
                                        'dosen' => 'Dr. Siska',
                                    ],
                                    (object) [
                                        'kode' => 'IF503',
                                        'nama' => 'Pemrograman Mobile',
                                        'sks' => 3,
                                        'semester' => 5,
                                        'bidang' => 'Mobile',
                                        'dosen' => 'Mr. Arif',
                                    ],
                                ];
                                $coursesData = $courses ?? $defaultCourses;
                            @endphp

                            <div class="table-responsive">
                                <table id="table-mk" class="table table-hover table-bordered align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Kode</th>
                                            <th>Nama Mata Kuliah</th>
                                            <th class="text-center">SKS</th>
                                            <th class="text-center">Sem</th>
                                            <th>Bidang Keahlian</th>
                                            <th>Dosen Pengampu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coursesData as $i => $c)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td>{{ $c->kode ?? ($c['kode'] ?? '-') }}</td>
                                                <td>{{ $c->nama ?? ($c['nama'] ?? '-') }}</td>
                                                <td class="text-center">{{ $c->sks ?? '-' }}</td>
                                                <td class="text-center">{{ $c->semester ?? ($c['semester'] ?? '-') }}</td>
                                                <td>{{ $c->bidang ?? ($c['bidang'] ?? '-') }}</td>
                                                <td>{{ $c->dosen ?? ($c['dosen'] ?? '-') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Jadwal -->
                <div class="tab-pane fade" id="pane-jadwal" role="tabpanel" aria-labelledby="tab-jadwal">
                    <div class="card shadow-sm mb-4" data-aos="fade-up" data-aos-delay="250">
                        <div class="card-body">
                            <h5 class="card-title">Jadwal Perkuliahan</h5>
                            <p class="text-muted">Jadwal ter-update (hari, waktu, kelas, ruang, dosen).</p>

                            @php
                                // contoh data jadwal
                                $defaultSchedules = [
                                    (object) [
                                        'hari' => 'Senin',
                                        'waktu' => '08:00 - 10:00',
                                        'mk' => 'Algoritma & Pemrograman',
                                        'kelas' => 'A',
                                        'ruang' => 'IF101',
                                        'dosen' => 'Dr. Budi',
                                    ],
                                    (object) [
                                        'hari' => 'Senin',
                                        'waktu' => '10:00 - 12:00',
                                        'mk' => 'Matematika Diskrit',
                                        'kelas' => 'A',
                                        'ruang' => 'IF102',
                                        'dosen' => 'Dr. Rani',
                                    ],

                                    (object) [
                                        'hari' => 'Selasa',
                                        'waktu' => '08:00 - 10:00',
                                        'mk' => 'Struktur Data',
                                        'kelas' => 'B',
                                        'ruang' => 'IF201',
                                        'dosen' => 'Dr. Sinta',
                                    ],
                                    (object) [
                                        'hari' => 'Selasa',
                                        'waktu' => '13:00 - 15:00',
                                        'mk' => 'Basis Data',
                                        'kelas' => 'A',
                                        'ruang' => 'Lab Database',
                                        'dosen' => 'Dr. Ahmad',
                                    ],

                                    (object) [
                                        'hari' => 'Rabu',
                                        'waktu' => '10:00 - 12:00',
                                        'mk' => 'OOP',
                                        'kelas' => 'A',
                                        'ruang' => 'IF303',
                                        'dosen' => 'Dr. Wulan',
                                    ],

                                    (object) [
                                        'hari' => 'Kamis',
                                        'waktu' => '08:00 - 10:00',
                                        'mk' => 'Jaringan Komputer',
                                        'kelas' => 'A',
                                        'ruang' => 'IF402',
                                        'dosen' => 'Dr. Yoga',
                                    ],

                                    (object) [
                                        'hari' => 'Jumat',
                                        'waktu' => '13:00 - 15:00',
                                        'mk' => 'Web Development',
                                        'kelas' => 'A',
                                        'ruang' => 'Lab Web',
                                        'dosen' => 'Mr. Rizal',
                                    ],
                                ];
                                $schedulesData = $schedules ?? $defaultSchedules;
                            @endphp

                            <div class="table-responsive">
                                <table class="table table-striped table-sm align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Hari</th>
                                            <th>Waktu</th>
                                            <th>Mata Kuliah</th>
                                            <th>Kelas</th>
                                            <th>Ruang</th>
                                            <th>Dosen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedulesData as $idx => $s)
                                            <tr>
                                                <td class="text-center">{{ $idx + 1 }}</td>
                                                <td>{{ $s->hari ?? '-' }}</td>
                                                <td>{{ $s->waktu ?? '-' }}</td>
                                                <td>{{ $s->mk ?? ($s->mata_kuliah ?? '-') }}</td>
                                                <td>{{ $s->kelas ?? '-' }}</td>
                                                <td>{{ $s->ruang ?? '-' }}</td>
                                                <td>{{ $s->dosen ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3 d-flex gap-2">
                                <a href="#" class="btn btn-outline-primary btn-sm">Unduh Jadwal (PDF)</a>
                                <a href="#" class="btn btn-outline-secondary btn-sm">Cetak</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end tab-content -->

        </div>
    </section>

    {{-- Simple client-side search for daftar mata kuliah --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const input = document.getElementById('search-mk');
                const table = document.getElementById('table-mk').getElementsByTagName('tbody')[0];

                input?.addEventListener('input', function() {
                    const q = this.value.trim().toLowerCase();
                    Array.from(table.rows).forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.indexOf(q) === -1 ? 'none' : '';
                    });
                });
            });

            function resetSearch() {
                const input = document.getElementById('search-mk');
                input.value = '';
                input.dispatchEvent(new Event('input'));
            }
        </script>
    @endpush

@endsection
