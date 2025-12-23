@extends('Backend.layouts.main')

@section('content')
    <div class="container-fluid">
        <h4 class="fw-bold mt-5 mb-3">Manajemen Struktur Organisasi</h4>

        <div class="d-flex flex-wrap gap-2 mb-3">
            <button type="button"
                class="btn btn-success btn-sm d-flex align-items-center"
                id="btnAdd">
                <i class="ti ti-plus me-1"></i> Tambah Data
            </button>

            <button type="button"
                class="btn btn-danger btn-sm d-flex align-items-center"
                id="btnSampah">
                <i class="ti ti-trash me-1"></i> Baru Saja Dihapus
            </button>
        </div>

        <table class="table table-bordered table-striped"
            id="strukturTable"
            data-url="{{ route('struktur.organisasi.data') }}">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Jabatan</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Urutan</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    {{-- Modal Tambah / Edit Struktur --}}
    @include('Backend.ManagementKonten.struktur-organisasi.ModalAddData')

    {{-- Modal Sampah / Restore --}}
    @include('Backend.ManagementKonten.struktur-organisasi.BaruDihapus')

    @push('scripts')
        <script src="{{ asset('assets/backend/js/struktur-organisasi.js') }}"></script>
    @endpush
@endsection
