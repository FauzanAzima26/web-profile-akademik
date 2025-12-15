@extends('Backend.layouts.main')

@section('content')
    <div class="container-fluid">
        <h4 class="fw-bold mt-5 mb-3">Manajemen Berita</h4>

        <button class="btn btn-primary mb-3" id="btnAdd" data-store="{{ route('backend.berita.store') }}">
            + Tambah Berita
        </button>
        <button class="btn btn-primary mb-3" id="btnAddKategori">
            + Tambah Kategori
        </button>

        <table class="table table-bordered table-striped" id="beritaTable" data-url="{{ route('backend.berita.data') }}">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Penulis</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th width="120px">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    @include('Backend.ManagementKonten.berita.ModalBerita')

    @include('Backend.ManagementKonten.berita.KategoriBerita')

    @include('Backend.ManagementKonten.berita.detailBerita')

    @push('scripts')
        <script src="{{ asset('assets/backend/js/berita.js') }}"></script>
    @endpush
@endsection
