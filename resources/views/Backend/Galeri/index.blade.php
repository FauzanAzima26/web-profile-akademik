@extends('Backend.layouts.main')

@section('content')
    <div class="container-fluid">
        <h4 class="fw-bold mt-5 mb-3">Manajemen Data Prestasi Mahasiswa</h4>

        <div class="d-flex flex-wrap gap-2 mb-3">
            <button type="button" class="btn btn-success btn-sm d-flex align-items-center" id="btnAdd">
                <i class="ti ti-plus me-1"></i> Tambah Data
            </button>

            <button type="button" class="btn btn-danger btn-sm d-flex align-items-center" id="btnSampah">
                <i class="ti ti-trash me-1"></i> Baru Saja Dihapus
            </button>
        </div>

        <table class="table table-bordered table-striped" id="galeriTable" data-url="{{ route('galeri.data') }}">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    {{-- Modal Tambah / Edit Dosen --}}
    @include('Backend.Galeri.ModalAddData')

    @include('Backend.Galeri.BaruDihapus')

    @push('scripts')
        <script src="{{ asset('assets/backend/js/galeri.js') }}"></script>
    @endpush
@endsection
