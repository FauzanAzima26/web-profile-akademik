@extends('Backend.layouts.main')

@section('content')
    <div class="container-fluid">
        <h4 class="fw-bold mt-5 mb-3">Manajemen Berita</h4>

        <div class="d-flex flex-wrap gap-2 mb-3">
            <button type="button" class="btn btn-success btn-sm d-flex align-items-center" id="btnAdd" data-store="{{ route('backend.berita.store') }}>
                <i class="ti ti-plus me-1"></i> Tambah Data
            </button>

            <button type="button" class="btn btn-warning btn-sm d-flex align-items-center" id="btnAddKategori">
                <i class="ti ti-trash me-1"></i> Tambah Kategori
            </button>
            <button type="button" class="btn btn-danger btn-sm d-flex align-items-center" id="btnSampahProfilProdi">
                <i class="ti ti-trash me-1"></i> Baru Saja Dihapus
            </button>
        </div>

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
