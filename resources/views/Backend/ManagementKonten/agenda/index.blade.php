@extends('Backend.layouts.main')

@section('content')
    <div class="container-fluid">
        <h4 class="fw-bold mt-5 mb-3">Manajemen Agenda</h4>

        <div class="d-flex flex-wrap gap-2 mb-3">
            <button type="button" class="btn btn-success btn-sm d-flex align-items-center" id="btnAddAgenda">
                <i class="ti ti-plus me-1"></i> Tambah Data
            </button>

            <button type="button" class="btn btn-danger btn-sm d-flex align-items-center" id="btnSampahAgenda">
                <i class="ti ti-trash me-1"></i> Baru Saja Dihapus
            </button>
        </div>

        <table class="table table-bordered table-striped" id="agendaTable" data-url="{{ route('backend.agenda.data') }}">
            <thead class="table-light">
                <tr>
                    <th width="50px">No</th>
                    <th>Judul</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Lokasi</th>
                    <th>Gambar</th>
                    <th width="120px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Data via AJAX --}}
            </tbody>
        </table>
    </div>

    {{-- Modal Tambah & Edit Agenda --}}
    @include('Backend.ManagementKonten.agenda.ModalAgenda')

    @include('Backend.ManagementKonten.agenda.detailAgenda')

    @include('Backend.ManagementKonten.agenda.AgendaBaruDihapus')
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/js/agenda.js') }}"></script>
@endpush
