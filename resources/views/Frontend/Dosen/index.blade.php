@extends('Frontend.layouts.main')

@section('title', 'Struktur Organisasi')

@section('content')
    <!-- Struktur Organisasi Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row features-showcase">
                <div class="col-12">
                    <div class="features-header text-center" data-aos="fade-up" data-aos-delay="100">
                        <h3>Tenaga Kependidikan</h3>
                        <p>Discover the amenities and services that make your stay unforgettable</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Contoh 1 -->
                <div class="col-lg-3 col-md-5">
                    <div class="feature-card" data-aos="flip-up" data-aos-delay="200">
                        <div class="feature-visual text-center p-3">
                            <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" alt="Foto Dosen"
                                class="img-fluid rounded-circle" width="120">
                        </div>
                        <div class="feature-details text-center">
                            <h4>Nama Dosen</h4>
                            <p><strong>Bidang Keahlian:</strong> Teknik Sipil, Manajemen Konstruksi</p>
                            <p><strong>Jabatan Akademik:</strong> Lektor Kepala</p>
                            <p><strong>Kontak:</strong> email@example.com</p>
                        </div>
                    </div>
                </div>

                <!-- Contoh 2 -->
                <div class="col-lg-3 col-md-5">
                    <div class="feature-card" data-aos="flip-up" data-aos-delay="250">
                        <div class="feature-visual text-center p-3">
                            <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" alt="Foto Dosen"
                                class="img-fluid rounded-circle" width="120">
                        </div>
                        <div class="feature-details text-center">
                            <h4>Nama Dosen</h4>
                            <p><strong>Bidang Keahlian:</strong> Teknik Mesin, Material</p>
                            <p><strong>Jabatan Akademik:</strong> Asisten Ahli</p>
                            <p><strong>Kontak:</strong> dosen@example.com</p>
                        </div>
                    </div>
                </div>

                <!-- Contoh 3 -->
                <div class="col-lg-3 col-md-5">
                    <div class="feature-card" data-aos="flip-up" data-aos-delay="300">
                        <div class="feature-visual text-center p-3">
                            <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" alt="Foto Dosen"
                                class="img-fluid rounded-circle" width="120">
                        </div>
                        <div class="feature-details text-center">
                            <h4>Nama Dosen</h4>
                            <p><strong>Bidang Keahlian:</strong> Industri, Supply Chain</p>
                            <p><strong>Jabatan Akademik:</strong> Lektor</p>
                            <p><strong>Kontak:</strong> nama@example.com</p>
                        </div>
                    </div>
                </div>

                <!-- Contoh 4 -->
                <div class="col-lg-3 col-md-5">
                    <div class="feature-card" data-aos="flip-up" data-aos-delay="350">
                        <div class="feature-visual text-center p-3">
                            <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" alt="Foto Dosen"
                                class="img-fluid rounded-circle" width="120">
                        </div>
                        <div class="feature-details text-center">
                            <h4>Nama Dosen</h4>
                            <p><strong>Bidang Keahlian:</strong> Kimia, Proses Industri</p>
                            <p><strong>Jabatan Akademik:</strong> Guru Besar</p>
                            <p><strong>Kontak:</strong> contact@example.com</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </section><!-- /Struktur Organisasi Section -->
@endsection
