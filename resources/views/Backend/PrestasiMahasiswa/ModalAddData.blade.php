<!-- Modal Tambah / Edit Dosen -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="formCreate" data-store="{{ route('prestasi.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data Prestasi Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    {{-- ID Hidden (untuk mode edit jika diperlukan) --}}
                    <input type="hidden" id="prestasiId" name="id">

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label class="form-label">Judul Prestasi</label>
                        <input type="text" name="judul" id="judul" class="form-control"
                            placeholder="Contoh: Juara 1 Lomba Karya Tulis" required>
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control"
                            placeholder="Contoh: Akademik / Non-Akademik" required>
                    </div>

                    {{-- Tingkat --}}
                    <div class="mb-3">
                        <label class="form-label">Tingkat</label>
                        <select name="tingkat" id="tingkat" class="form-select" required>
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="Internasional">Internasional</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Kabupaten/Kota">Kabupaten/Kota</option>
                            <option value="Universitas">Universitas</option>
                        </select>
                    </div>

                    {{-- Tahun --}}
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" min="2000"
                            max="2099" required>
                    </div>

                    {{-- Mahasiswa (Nama/Daftar Mahasiswa) --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Mahasiswa</label>
                        <input type="text" name="mahasiswa" id="mahasiswa" class="form-control"
                            placeholder="Masukkan nama mahasiswa" required>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Jelaskan detail prestasi..."></textarea>
                    </div>

                    {{-- Foto --}}
                    <div class="mb-3">
                        <label class="form-label">Foto / Sertifikat</label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, JPEG. Maks: 2MB</small>
                    </div>

                    {{-- Preview Foto --}}
                    <div class="mb-3">
                        <label class="form-label">Preview Foto</label>
                        <div id="previewFoto">
                            <!-- Area untuk menampilkan gambar saat edit -->
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan Data
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
