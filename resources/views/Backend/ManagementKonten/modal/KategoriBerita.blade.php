<div class="modal fade" id="modalKategori" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Manajemen Kategori Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- TABEL KATEGORI -->
                <div class="table-responsive">
                    <table id="kategoriTable" class="table table-bordered table-striped w-100"
                        style="width: 100% !important;" data-url="{{ route('backend.kategori-berita.data') }}">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th>Nama</th>
                                <th style="width: 120px;">Warna</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <hr>

                <h5 class="modal-title">Tambah Kategori</h5>
                <!-- FORM TAMBAH / EDIT -->
                <form id="formKategori" data-store="{{ route('backend.kategori-berita.store') }}">
                    @csrf
                    <input type="hidden" name="id">

                    <div class="mb-3 mt-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Warna</label>
                        <input type="color" name="warna" class="form-control form-control-color">
                    </div>

                    <div class="modal-footer p-0 pt-3 mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary">Simpan Kategori</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
