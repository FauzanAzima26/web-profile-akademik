<!-- Modal Tambah / Edit Dosen -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="formCreate" data-store="{{ route('pengabdian.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data Pengabdian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- ID (EDIT) --}}
                    <input type="hidden" name="id" id="pengabdian_id">

                    {{-- JUDUL --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Pengabdian</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>

                    {{-- TAHUN --}}
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" min="2000"
                            max="{{ date('Y') }}" required>
                    </div>

                    {{-- DOSEN --}}
                    <div class="mb-3">
                        <label class="form-label">Dosen Penanggung Jawab</label>
                        <select name="dosen_id" id="dosen_id" class="form-select" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach ($dosens as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama ?? 'Tidak ada dosen' }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- LOKASI --}}
                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control">
                    </div>

                    {{-- PESERTA --}}
                    <div class="mb-3">
                        <label class="form-label">Peserta</label>
                        <textarea name="peserta" id="peserta" class="form-control" rows="2"></textarea>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
                    </div>

                    {{-- FOTO --}}
                    <div class="mb-3">
                        <label class="form-label">Foto Kegiatan</label>
                        <input type="file" name="foto_url" id="foto_url" class="form-control" accept="image/*">
                    </div>

                    {{-- PREVIEW FOTO --}}
                    <div id="previewFoto" class="mb-3"></div>

                    {{-- STATUS --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="draft">Draft</option>
                            <option value="publish">Publish</option>
                        </select>
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
