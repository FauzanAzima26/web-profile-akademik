<!-- Modal Tambah / Edit Dosen -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="formCreate" data-store="{{ route('kurikulum.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data Kurikulum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- ID untuk keperluan Edit (Hidden) -->
                    <input type="hidden" id="kurikulum_id" name="id">

                    {{-- Nama Kurikulum --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Kurikulum</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                            placeholder="Contoh: Kurikulum Merdeka 2025" required>
                    </div>

                    <div class="row">
                        {{-- Tahun Kurikulum --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun" id="tahun" class="form-control" min="2000"
                                max="2099" value="2025" required>
                        </div>

                        {{-- Total SKS --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total SKS</label>
                            <input type="number" name="total_sks" id="total_sks" class="form-control" min="1"
                                placeholder="Contoh: 144" required>
                        </div>
                    </div>

                    {{-- File PDF --}}
                    <div class="mb-3">
                        <label class="form-label">Dokumen Kurikulum (PDF)</label>
                        <input type="file" name="file_pdf" id="file_pdf" class="form-control"
                            accept="application/pdf">
                        <div class="form-text">Maksimal file 2MB (Opsional)</div>
                    </div>

                    <div id="previewPdf"></div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                            placeholder="Masukkan rincian kurikulum..."></textarea>
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
