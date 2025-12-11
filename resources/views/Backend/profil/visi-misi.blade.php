@extends('Backend.layouts.main')

@section('content')
    <div class="container-fluid">

        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Data Visi & Misi</h4>

                <a href="#" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Tambah Baru
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Visi</th>
                            <th>Misi</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                            <td>
                                <ul class="mb-0">
                                    <li>Lorem ipsum dolor sit amet.</li>
                                    <li>Integer nec odio.</li>
                                    <li>Praesent libero.</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i>
                                </a>

                                <button class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Sed cursus ante dapibus diam.</td>
                            <td>
                                <ul class="mb-0">
                                    <li>Sed nisi nulla, facilisis non.</li>
                                    <li>Faucibus id, placerat nec velit.</li>
                                </ul>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">
                                    <i class="bx bx-edit"></i>
                                </a>

                                <button class="btn btn-sm btn-danger">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
@endsection
