@extends('Frontend.layouts.main')

@section('content')
    <!-- Sejarah Section -->
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

    </section><!-- /Sejarah Section -->
@endsection
