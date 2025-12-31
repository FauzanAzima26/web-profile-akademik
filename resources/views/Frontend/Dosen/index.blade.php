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
                @foreach ($dosen as $item)
                    <div class="col-lg-3 col-md-5">
                        <div class="feature-card" data-aos="flip-up" data-aos-delay="200">
                            <div class="feature-visual text-center p-3">
                                <img src="{{ Storage::url('dosen/' . $item->foto) }}" alt="Foto Dosen"
                                    class="img-fluid rounded-circle" width="120">
                            </div>
                            <div class="feature-details text-center">
                                <h4>{{ trim($item->gelar_depan . ' ' . $item->nama . ' ' . $item->gelar_belakang) }}</h4>
                                <p><strong>NIP/NIDN:</strong> {{ $item->nidn }}</p>
                                <p><strong>Bidang Keahlian:</strong> {{ $item->bidangKeahlian->nama ?? '-'}}</p>
                                <p><strong>Jabatan Akademik:</strong> {{ $item->jabatan }}</p>
                                <p><strong>Kontak:</strong> {{ $item->email }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>

    </section><!-- /Struktur Organisasi Section -->
@endsection
