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

        <table class="table table-bordered table-striped" id="prestasiTable" data-url="{{ route('prestasi.data') }}">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tingkat</th>
                    <th>Tahun</th>
                    <th>Mahasiswa</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    {{-- Modal Tambah / Edit Dosen --}}
    @include('Backend.PrestasiMahasiswa.ModalAddData')

    {{-- @include('Backend.ManagementAkademik.dosen.ModalDetail') --}}

    {{-- Modal Sampah / Restore --}}
    @include('Backend.PrestasiMahasiswa.BaruDihapus')

    @push('scripts')
        <script src="{{ asset('assets/backend/js/prestasi.js') }}"></script>
    @endpush
@endsection
