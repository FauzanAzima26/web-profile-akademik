<!-- Modal Tambah / Edit Dosen -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="formCreate" data-store="{{ route('galeri.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    {{-- ID Hidden untuk mode edit --}}
                    <input type="hidden" id="galeriId" name="id">

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Gambar</label>
                        <input type="text" name="judul" id="judul" class="form-control" maxlength="150"
                            placeholder="Masukkan judul foto" required>
                    </div>

                    {{-- Kategori (Enum) --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select" required>
                            <option value="lainnya">-- Pilih Kategori --</option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="fasilitas">Fasilitas</option>
                            <option value="akademik">Akademik</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>

                    {{-- Status (Boolean) --}}
                    <div class="mb-3">
                        <label class="form-label">Status Publikasi</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="1">Aktif / Tampilkan</option>
                            <option value="0">Tidak Aktif / Sembunyikan</option>
                        </select>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"
                            placeholder="Keterangan singkat mengenai foto..."></textarea>
                    </div>

                    {{-- Gambar (Sesuai kolom 'gambar') --}}
                    <div class="mb-3">
                        <label class="form-label">File Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, WEBP. Maks: 2MB</small>
                    </div>

                    {{-- Preview Foto --}}
                    <div class="mb-3">
                        <label class="form-label">Preview Gambar Saat Ini</label>
                        <div id="previewFoto">
                            <!-- Preview akan muncul di sini saat edit -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Galeri</button>
                </div>
            </div>
        </form>
    </div>
</div>
