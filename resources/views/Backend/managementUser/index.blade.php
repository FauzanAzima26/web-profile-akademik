@extends('Backend.layouts.main')

@section('content')
    <div class="container-fluid">
        <h4 class="fw-bold mt-5 mb-3">Manajemen Data Pengguna</h4>

        <div class="d-flex flex-wrap gap-2 mb-3">
            <button type="button" class="btn btn-success btn-sm d-flex align-items-center" id="btnAdd">
                <i class="ti ti-plus me-1"></i> Tambah Pengguna
            </button>

            <button type="button" class="btn btn-danger btn-sm d-flex align-items-center" id="btnSampah">
                <i class="ti ti-trash me-1"></i> Pengguna Dihapus
            </button>
        </div>

        <table class="table table-bordered table-striped" id="userTable" data-url="{{ route('user.data') }}">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    @include('Backend.managementUser.ModalAddData')

    @include('Backend.managementUser.BaruDihapus')

    @push('scripts')
        <script src="{{ asset('assets/backend/js/users.js') }}"></script>
    @endpush
@endsection
