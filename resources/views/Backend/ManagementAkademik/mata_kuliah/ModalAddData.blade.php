<!-- Modal Tambah / Edit Dosen -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="formCreate" data-store="{{ route('mata.kuliah.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- ID untuk keperluan Edit (Hidden) -->
                    <input type="hidden" id="Mk_id" name="id">

                    {{-- Kode Mata Kuliah --}}
                    <div class="mb-3">
                        <label class="form-label">Kode Mata Kuliah</label>
                        <input type="text" name="kode" id="kode" class="form-control"
                            placeholder="Contoh: MK001" required>
                    </div>

                    {{-- Nama Mata Kuliah --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Mata Kuliah</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                            placeholder="Contoh: Pemrograman Web" required>
                    </div>

                    <div class="row">
                        {{-- SKS --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKS</label>
                            <input type="number" name="sks" id="sks" class="form-control" min="1"
                                max="6" required>
                        </div>

                        {{-- Semester --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Semester</label>
                            <input type="number" name="semester" id="semester" class="form-control" min="1"
                                max="8" required>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                            placeholder="Masukkan deskripsi mata kuliah..."></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
