    @extends('Frontend.layouts.main')

    @section('content')
        <!-- Hero Section -->
        <section id="hotel-hero" class="hotel-hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 align-items-center">

                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                        <div class="hero-content">
                            <h1>Membangun Generasi Digital yang Inovatif</h1>
                            <p class="lead">Program Studi Informatika Universitas Malikussaleh berkomitmen mencetak
                                lulusan
                                unggul
                                di bidang teknologi informasi melalui pendidikan berkualitas, penelitian inovatif, dan
                                pengabdian masyarakat berbasis teknologi digital.</p>
                            <div class="hero-features">
                                <div class="feature-item">
                                    <i class="bi bi-wifi"></i>
                                    <span>Smart Learning Environment</span>
                                </div>
                                <div class="feature-item">
                                    <i class="bi bi-car-front"></i>
                                    <span>Kolaborasi Industri</span>
                                </div>
                                <div class="feature-item">
                                    <i class="bi bi-cup-hot"></i>
                                    <span>Komunitas Akademik Aktif</span>
                                </div>
                            </div>
                            <div class="hero-buttons">
                                <a href="booking.html" class="btn btn-primary">Profil Program Studi</a>
                                <a href="rooms.html" class="btn btn-outline">Dosen & Kurikulum</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="hero-images">
                            <div class="main-image">
                                <img src="{{ asset('assets/frontend') }}/img/download.webp" alt="Unimal"
                                    class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            </div>

        </section><!-- /Hero Section -->

        <!-- Berita Cards Section -->
        <section id="amenities-cards" class="amenities-cards section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Berita Terkini</span>
                <h2>Berita Terkini</h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-5">

                    @foreach ($berita as $b)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="facility-card">
                                <div class="facility-image">
                                    <img src="{{ Storage::url($b->gambar) }}" alt="Wireless Internet" class="img-fluid">
                                </div>
                                <div class="facility-info">
                                    <h4>{{ $b->judul }}</h4>
                                    <p>{{ Str::limit(strip_tags($b->konten), 150) }}</p>
                                    <div class="facility-features">
                                        <span><i class="bi bi-tag"></i> {{ $b->kategori->nama }}</span>
                                        <span><i class="bi bi-person-circle"></i> {{ $b->penulis }}</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Facility Card -->
                    @endforeach

                </div>

            </div>

        </section><!-- /Berita Cards Section -->

        <!-- Agenda Kegiatan Cards Section -->
        <section id="amenities-cards" class="amenities-cards section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span class="description-title">Agenda Kegiatan</span>
                <h2>Agenda Kegiatan</h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-5">
                    @foreach ($agenda as $a)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
                            <div class="facility-card">
                                <div class="facility-image">
                                    <img src="{{ Storage::url('agenda/' . $a->gambar) }}" alt="Fitness Center"
                                        class="img-fluid">
                                </div>
                                <div class="facility-info">
                                    <h4>{{ $a->judul }}</h4>
                                    <p>{{ Str::limit(strip_tags($a->deskripsi), 150) }}</p>
                                    <div class="facility-features">
                                        <span><i class="bi bi-check-circle"></i>{{ $a->gambar }}
                                        </span>
                                        <span><i class="bi bi-check-circle"></i> Personal Training</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Facility Card -->
                    @endforeach
                </div>

            </div>

        </section><!-- /Agenda Kegiatan Cards Section -->
    @endsection
