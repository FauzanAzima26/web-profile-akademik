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
                @foreach ($struktur->where('urutan', 1) as $s)
                    <div class="text-center mb-5" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ Storage::url('Struktur-Organisasi/' . $s->foto) }}" class="rounded-circle mb-3"
                            width="150">
                        <h4>{{ $s->jabatan }}</h4>
                        <p>{{ $s->nama }}</p>
                    </div>
                @endforeach

                <!-- Wakil Ketua -->
                @foreach ($struktur->where('urutan', 2) as $s)
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-4 col-md-6 text-center" data-aos="fade-up" data-aos-delay="250">
                            <img src="{{ Storage::url('Struktur-Organisasi/' . $s->foto) }}" class="rounded-circle mb-3"
                                width="130">
                            <h5>{{ $s->jabatan }}</h5>
                            <p>{{ $s->nama }}</p>
                        </div>
                    </div>
                @endforeach

                <!-- Kepala Bagian -->
                <div class="row justify-content-center mb-5">
                    @foreach ($struktur->whereBetween('urutan', [3, 5]) as $s)
                        <div class="col-lg-3 col-md-5 text-center" data-aos="fade-up" data-aos-delay="300">
                            <img src="{{ Storage::url('Struktur-Organisasi/' . $s->foto) }}" class="rounded-circle mb-3"
                                width="120">
                            <h6>{{ $s->jabatan }}</h6>
                            <p>{{ $s->nama }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Staf -->
                <div class="row justify-content-center">
                    @foreach ($struktur->where('urutan', '>', '5') as $s)
                        <div class="col-lg-2 col-md-4 text-center" data-aos="fade-up" data-aos-delay="450">
                            <img src="{{ Storage::url('Struktur-Organisasi/' . $s->foto) }}" class="rounded-circle mb-3"
                                width="100">
                            <p>{{ $s->nama }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section><!-- /Struktur Organisasi Section -->
@endsection
