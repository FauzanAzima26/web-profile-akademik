@extends('Backend.layouts.main')

@section('content')
    <div class="container-fluid">
        <h4 class="fw-bold mt-5 mb-3">Manajemen Profil Prodi</h4>

        <div class="d-flex flex-wrap gap-2 mb-3">
            <button type="button"
                class="btn btn-success btn-sm d-flex align-items-center"
                id="btnAdd">
                <i class="ti ti-plus me-1"></i> Tambah Profil
            </button>

            <button type="button"
                class="btn btn-danger btn-sm d-flex align-items-center"
                id="btnSampah">
                <i class="ti ti-trash me-1"></i> Baru Saja Dihapus
            </button>
        </div>

        <table class="table table-bordered table-striped"
            id="profilTable"
            data-url="{{ route('backend.profil.prodi.data') }}">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama Prodi</th>
                    <th>Akreditasi</th>
                    <th>Tahun Berdiri</th>
                    <th>Visi</th>
                    <th>Misi</th>
                    <th>Tujuan</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    {{-- Modal Tambah/Edit Profil --}}
    @include('Backend.ManagementKonten.profil-prodi.ModalProfil')

    {{-- Modal Sampah / Restore --}}
    @include('Backend.ManagementKonten.profil-prodi.BaruDihapus')

    @push('scripts')
        <script src="{{ asset('assets/backend/js/profil-prodi.js') }}"></script>
    @endpush
@endsection
