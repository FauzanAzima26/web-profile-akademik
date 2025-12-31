@extends('Frontend.layouts.main')

@section('content')
    <!-- About Home Section -->
    <section id="about-home" class="about-home section light-background">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 align-items-center">

                @foreach ($profil as $p)
                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                        <div class="about-content">
                            <h2>Visi dan Misi</h2>
                            <p class="lead">Program Studi {{ $p->nama_prodi }}</p>
                            <h4>Visi</h4>
                            <p>{{ $p->visi }}</p>
                            <h4>Misi</h4>
                            <p>{{ $p->misi }}</p>
                        </div>
                    </div><!-- End About Content -->
                @endforeach

                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                    <div class="about-images">
                        <div class="main-image">
                            <img src="{{ asset('assets/frontend') }}/img/download (2).jpg" alt="Grandview Resort Main View"
                                class="img-fluid">
                        </div>
                        <div class="secondary-image">
                            <img src="{{ asset('assets/frontend') }}/img/download (3).jpg" alt="Luxury Suite Interior"
                                class="img-fluid">
                        </div>
                    </div>
                </div><!-- End About Images -->

            </div>

        </div>

    </section><!-- /About Home Section -->
@endsection
