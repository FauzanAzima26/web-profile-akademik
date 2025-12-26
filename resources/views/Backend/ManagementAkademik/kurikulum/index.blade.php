@extends('Backend.layouts.main')

@section('content')
    <div class="container-fluid">
        <h4 class="fw-bold mt-5 mb-3">Manajemen Data Mata Kuliah</h4>

        <div class="d-flex flex-wrap gap-2 mb-3">
            <button type="button" class="btn btn-success btn-sm d-flex align-items-center" id="btnAdd">
                <i class="ti ti-plus me-1"></i> Tambah Data
            </button>

            <button type="button" class="btn btn-danger btn-sm d-flex align-items-center" id="btnSampah">
                <i class="ti ti-trash me-1"></i> Baru Saja Dihapus
            </button>
        </div>

        <table class="table table-bordered table-striped" id="kurikulumTable" data-url="{{ route('kurikulum.data') }}">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Nama</th>
                    <th>Tahun</th>
                    <th>Total SKS</th>
                    <th>Deskripsi</th>
                    <th>File</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    {{-- Modal Tambah / Edit Dosen --}}
    @include('Backend.ManagementAkademik.kurikulum.ModalAddData')

    {{-- Modal Sampah / Restore --}}
    @include('Backend.ManagementAkademik.kurikulum.BaruDihapus')

    @push('scripts')
        <script src="{{ asset('assets/backend/js/kurikulum.js') }}"></script>
    @endpush
@endsection
