<!-- Modal Tambah / Edit Struktur Organisasi -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="formCreate"
              data-store="{{ route('struktur.organisasi.store') }}"
              enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Struktur Organisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="strukturId" name="id">

                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text"
                               name="jabatan"
                               id="jabatan"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text"
                               name="nama"
                               id="nama"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number"
                               name="urutan"
                               id="urutan"
                               class="form-control"
                               min="1">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file"
                               name="foto"
                               id="foto"
                               class="form-control"
                               accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Saat Ini</label>
                        <div id="previewFoto">
                            {{-- diisi lewat JS saat edit --}}
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit"
                            class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
