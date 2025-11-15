@extends('Frontend.layouts.main')

@section('content')
    <!-- Hero Section -->
    <section id="hotel-hero" class="hotel-hero section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 align-items-center">

                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="hero-content">
                        <h1>Sejarah</h1>
                        <p class="lead">Experience unparalleled comfort and sophistication at our premium hotel. From
                            elegant suites to world-class amenities, every moment of your stay is crafted to perfection.</p>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                    <div class="hero-images">
                        <div class="main-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/showcase-3.webp" alt="Luxury Hotel"
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

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="facility-card">
                        <div class="facility-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/amenities-1.webp" alt="Wireless Internet"
                                class="img-fluid">
                            <div class="facility-overlay">
                                <i class="bi bi-wifi"></i>
                            </div>
                        </div>
                        <div class="facility-info">
                            <h4>High-Speed Internet</h4>
                            <p>Complimentary wireless internet access throughout the hotel premises with enterprise-grade
                                security and unlimited bandwidth for all your connectivity needs.</p>
                            <div class="facility-features">
                                <span><i class="bi bi-check-circle"></i> 24/7 Available</span>
                                <span><i class="bi bi-check-circle"></i> High Speed</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Facility Card -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150">
                    <div class="facility-card">
                        <div class="facility-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/amenities-3.webp" alt="Swimming Pool"
                                class="img-fluid">
                            <div class="facility-overlay">
                                <i class="bi bi-droplet"></i>
                            </div>
                        </div>
                        <div class="facility-info">
                            <h4>Rooftop Pool</h4>
                            <p>Luxurious rooftop swimming pool with breathtaking city skyline views. Features heated water,
                                poolside service, and premium lounging areas for ultimate relaxation.</p>
                            <div class="facility-features">
                                <span><i class="bi bi-check-circle"></i> Heated Pool</span>
                                <span><i class="bi bi-check-circle"></i> City Views</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Facility Card -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="facility-card">
                        <div class="facility-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/amenities-5.webp" alt="Valet Parking"
                                class="img-fluid">
                            <div class="facility-overlay">
                                <i class="bi bi-car-front"></i>
                            </div>
                        </div>
                        <div class="facility-info">
                            <h4>Valet Parking</h4>
                            <p>Premium valet parking service with secure underground facility. Professional attendants
                                ensure your vehicle is safely parked and readily available upon request.</p>
                            <div class="facility-features">
                                <span><i class="bi bi-check-circle"></i> Secure</span>
                                <span><i class="bi bi-check-circle"></i> Valet Service</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Facility Card -->

            </div>

        </div>

    </section><!-- /Berita Cards Section -->

    <!-- Pengumuman Cards Section -->
    <section id="amenities-cards" class="amenities-cards section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">Pengumuman</span>
            <h2>Pengumuman</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-5">


                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="facility-card">
                        <div class="facility-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/amenities-2.webp" alt="Fitness Center"
                                class="img-fluid">
                            <div class="facility-overlay">
                                <i class="bi bi-heart-pulse"></i>
                            </div>
                        </div>
                        <div class="facility-info">
                            <h4>Modern Fitness Center</h4>
                            <p>Cutting-edge fitness facility featuring premium equipment, personal training services, and
                                wellness programs designed to maintain your health routine while traveling.</p>
                            <div class="facility-features">
                                <span><i class="bi bi-check-circle"></i> 24/7 Access</span>
                                <span><i class="bi bi-check-circle"></i> Personal Training</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Facility Card -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="facility-card">
                        <div class="facility-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/dining-2.webp" alt="Fine Dining"
                                class="img-fluid">
                            <div class="facility-overlay">
                                <i class="bi bi-cup-hot"></i>
                            </div>
                        </div>
                        <div class="facility-info">
                            <h4>Signature Restaurant</h4>
                            <p>Award-winning culinary experience featuring international cuisine crafted by renowned chefs.
                                Elegant atmosphere with extensive wine selection and impeccable service.</p>
                            <div class="facility-features">
                                <span><i class="bi bi-check-circle"></i> Fine Dining</span>
                                <span><i class="bi bi-check-circle"></i> Wine Selection</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Facility Card -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
                    <div class="facility-card">
                        <div class="facility-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/amenities-4.webp" alt="Spa Services"
                                class="img-fluid">
                            <div class="facility-overlay">
                                <i class="bi bi-flower1"></i>
                            </div>
                        </div>
                        <div class="facility-info">
                            <h4>Luxury Spa</h4>
                            <p>Tranquil sanctuary offering therapeutic treatments, rejuvenating massages, and holistic
                                wellness experiences. Escape the everyday stress in our serene environment.</p>
                            <div class="facility-features">
                                <span><i class="bi bi-check-circle"></i> Full Service</span>
                                <span><i class="bi bi-check-circle"></i> Wellness Programs</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Facility Card -->

            </div>

        </div>

    </section><!-- /Pengumuman Cards Section -->

    <!-- Agenda Kegiatan Cards Section -->
    <section id="amenities-cards" class="amenities-cards section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span class="description-title">Agenda Kegiatan</span>
            <h2>Agenda Kegiatan</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-5">


                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="facility-card">
                        <div class="facility-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/amenities-2.webp" alt="Fitness Center"
                                class="img-fluid">
                            <div class="facility-overlay">
                                <i class="bi bi-heart-pulse"></i>
                            </div>
                        </div>
                        <div class="facility-info">
                            <h4>Modern Fitness Center</h4>
                            <p>Cutting-edge fitness facility featuring premium equipment, personal training services, and
                                wellness programs designed to maintain your health routine while traveling.</p>
                            <div class="facility-features">
                                <span><i class="bi bi-check-circle"></i> 24/7 Access</span>
                                <span><i class="bi bi-check-circle"></i> Personal Training</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Facility Card -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="facility-card">
                        <div class="facility-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/dining-2.webp" alt="Fine Dining"
                                class="img-fluid">
                            <div class="facility-overlay">
                                <i class="bi bi-cup-hot"></i>
                            </div>
                        </div>
                        <div class="facility-info">
                            <h4>Signature Restaurant</h4>
                            <p>Award-winning culinary experience featuring international cuisine crafted by renowned chefs.
                                Elegant atmosphere with extensive wine selection and impeccable service.</p>
                            <div class="facility-features">
                                <span><i class="bi bi-check-circle"></i> Fine Dining</span>
                                <span><i class="bi bi-check-circle"></i> Wine Selection</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Facility Card -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
                    <div class="facility-card">
                        <div class="facility-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/amenities-4.webp" alt="Spa Services"
                                class="img-fluid">
                            <div class="facility-overlay">
                                <i class="bi bi-flower1"></i>
                            </div>
                        </div>
                        <div class="facility-info">
                            <h4>Luxury Spa</h4>
                            <p>Tranquil sanctuary offering therapeutic treatments, rejuvenating massages, and holistic
                                wellness experiences. Escape the everyday stress in our serene environment.</p>
                            <div class="facility-features">
                                <span><i class="bi bi-check-circle"></i> Full Service</span>
                                <span><i class="bi bi-check-circle"></i> Wellness Programs</span>
                            </div>
                        </div>
                    </div>
                </div><!-- End Facility Card -->

            </div>

        </div>

    </section><!-- /Agenda Kegiatan Cards Section -->
@endsection
