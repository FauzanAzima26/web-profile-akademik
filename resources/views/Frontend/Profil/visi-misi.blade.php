@extends('Frontend.layouts.main')

@section('content')
    <!-- About Home Section -->
    <section id="about-home" class="about-home section light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 align-items-center">

                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="about-content">
                        <h2>Visi dan Misi</h2>
                        <p class="lead">Where luxury meets tranquility in the heart of nature's paradise.</p>
                        <p>Nestled among rolling hills and pristine landscapes, Grandview Resort has been offering
                            exceptional hospitality for over three decades. Our commitment to excellence and attention to
                            detail creates an unforgettable experience for discerning travelers seeking both comfort and
                            adventure.</p>
                        <p>From our elegantly appointed suites to our world-class amenities, every aspect of your stay is
                            designed to exceed expectations. Discover breathtaking views, exquisite dining, and personalized
                            service that makes every moment special.</p>
                    </div>
                </div><!-- End About Content -->

                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                    <div class="about-images">
                        <div class="main-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/showcase-8.webp"
                                alt="Grandview Resort Main View" class="img-fluid">
                        </div>
                        <div class="secondary-image">
                            <img src="{{ asset('assets/frontend') }}/img/hotel/room-12.webp" alt="Luxury Suite Interior"
                                class="img-fluid">
                        </div>
                    </div>
                </div><!-- End About Images -->

            </div>

        </div>

    </section><!-- /About Home Section -->
@endsection
