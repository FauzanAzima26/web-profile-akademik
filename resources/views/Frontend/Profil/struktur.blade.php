@extends('Frontend.layouts.main')

@section('title', 'Struktur Organisasi')

@section('content')
    <!-- Struktur Organisasi Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row features-showcase">
                <div class="col-12">
                    <div class="features-header text-center" data-aos="fade-up" data-aos-delay="100">
                        <h3>Struktur Organisasi</h3>
                        <p>Discover the amenities and services that make your stay unforgettable</p>
                    </div>
                </div>
            </div>

            <div class="organization-structure">

                <!-- Pimpinan Utama -->
                <div class="text-center mb-5" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" class="rounded-circle mb-3"
                        width="150">
                    <h4>KETUA</h4>
                    <p>Nama Ketua</p>
                </div>

                <!-- Wakil Ketua -->
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-4 col-md-6 text-center" data-aos="fade-up" data-aos-delay="250">
                        <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" class="rounded-circle mb-3"
                            width="130">
                        <h5>WAKIL KETUA</h5>
                        <p>Nama Wakil Ketua</p>
                    </div>
                </div>

                <!-- Kepala Bagian -->
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-3 col-md-5 text-center" data-aos="fade-up" data-aos-delay="300">
                        <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" class="rounded-circle mb-3"
                            width="120">
                        <h6>Kepala Bagian Akademik</h6>
                        <p>Nama</p>
                    </div>
                    <div class="col-lg-3 col-md-5 text-center" data-aos="fade-up" data-aos-delay="350">
                        <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" class="rounded-circle mb-3"
                            width="120">
                        <h6>Kepala Bagian Umum</h6>
                        <p>Nama</p>
                    </div>
                    <div class="col-lg-3 col-md-5 text-center" data-aos="fade-up" data-aos-delay="400">
                        <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" class="rounded-circle mb-3"
                            width="120">
                        <h6>Kepala Bagian Keuangan</h6>
                        <p>Nama</p>
                    </div>
                </div>

                <!-- Staf -->
                <div class="row justify-content-center">
                    <div class="col-lg-2 col-md-4 text-center" data-aos="fade-up" data-aos-delay="450">
                        <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" class="rounded-circle mb-3"
                            width="100">
                        <p>Staf 1</p>
                    </div>
                    <div class="col-lg-2 col-md-4 text-center" data-aos="fade-up" data-aos-delay="500">
                        <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" class="rounded-circle mb-3"
                            width="100">
                        <p>Staf 2</p>
                    </div>
                    <div class="col-lg-2 col-md-4 text-center" data-aos="fade-up" data-aos-delay="550">
                        <img src="{{ asset('assets/frontend/img/download (4).jpg') }}" class="rounded-circle mb-3"
                            width="100">
                        <p>Staf 3</p>
                    </div>
                </div>

            </div>


        </div>

    </section><!-- /Struktur Organisasi Section -->
@endsection
