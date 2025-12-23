<!-- Modal Tambah / Edit Profil Prodi -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="formCreate" data-store="{{ route('backend.profil.prodi.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Profil Prodi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="profilId" name="id">

                    <div class="mb-3">
                        <label class="form-label">Nama Program Studi</label>
                        <input type="text" name="nama_prodi" id="nama_prodi" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Akreditasi</label>
                        <input type="text" name="akreditasi" id="akreditasi" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tahun Berdiri</label>
                        <input type="number" name="tahun_berdiri" id="tahun_berdiri"
                            class="form-control" min="1900" max="{{ date('Y') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Visi</label>
                        <textarea name="visi" id="visi" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Misi</label>
                        <textarea name="misi" id="misi" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tujuan</label>
                        <textarea name="tujuan" id="tujuan" class="form-control" rows="3"></textarea>
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
