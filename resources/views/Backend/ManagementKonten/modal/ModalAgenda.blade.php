<!-- Modal Tambah / Edit Agenda -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="formCreate" enctype="multipart/form-data" data-store="{{ route('backend.agenda.store') }}">
            @csrf
            <input type="hidden" id="agendaId" name="id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Agenda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Judul -->
                    <div class="mb-3">
                        <label class="form-label">Judul Agenda</label>
                        <input type="text" name="judul" id="judul" class="form-control">
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control">
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
                        <small class="text-muted">Kosongkan jika hanya satu hari</small>
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"></textarea>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <!-- Preview Gambar -->
                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label>
                        <div id="previewGambar"></div>
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
