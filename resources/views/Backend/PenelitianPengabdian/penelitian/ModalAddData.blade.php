<!-- Modal Tambah / Edit Dosen -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="formCreate" data-store="{{ route('penelitian.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data Penelitian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- ID Penelitian (untuk edit) --}}
                    <input type="hidden" id="penelitian_id" name="id">

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Penelitian</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>

                    {{-- Jenis --}}
                    <div class="mb-3">
                        <label class="form-label">Jenis Penelitian</label>
                        <input type="text" name="jenis" id="jenis" class="form-control"
                            placeholder="Contoh: Penelitian Dasar / Terapan" required>
                    </div>

                    {{-- Tahun --}}
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" min="2000"
                            max="{{ date('Y') }}" required>
                    </div>

                    {{-- Abstrak --}}
                    <div class="mb-3">
                        <label class="form-label">Abstrak</label>
                        <textarea name="abstrak" id="abstrak" class="form-control" rows="3"></textarea>
                    </div>

                    {{-- File PDF --}}
                    <div class="mb-3">
                        <label class="form-label">File Penelitian (PDF)</label>
                        <input type="file" name="file_url" id="file_url" class="form-control"
                            accept="application/pdf">
                    </div>

                    <div id="previewPdf"></div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="draft">Draft</option>
                            <option value="publish">Publish</option>
                        </select>
                    </div>

                    <hr>

                    {{-- DOSEN TERLIBAT --}}
                    <hr>

                    {{-- DOSEN TERLIBAT --}}
                    <h6>Dosen Terlibat</h6>

                    <button type="button" id="addDosen" class="btn btn-sm btn-outline-primary mb-2">
                        + Tambah Dosen
                    </button>

                    <div id="dosenWrapper"></div>

                    <!-- TEMPLATE (HIDDEN) -->
                    <div id="dosenTemplate" class="d-none">
                        <div class="dosen-row mb-2 p-2 border rounded">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <select class="form-select dosen-select">
                                        <option value="">-- Pilih Dosen --</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control peran"
                                        placeholder="Peran (Ketua / Anggota)">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger removeDosen">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
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
