<!-- Modal Tambah / Edit Dosen -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="formCreate"
              data-store="{{ route('dosen.store') }}"
              enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Data Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="dosenId" name="id">

                    {{-- NIDN --}}
                    <div class="mb-3">
                        <label class="form-label">NIDN</label>
                        <input type="text"
                               name="nidn"
                               id="nidn"
                               class="form-control"
                               required>
                    </div>

                    {{-- Gelar Depan --}}
                    <div class="mb-3">
                        <label class="form-label">Gelar Depan</label>
                        <input type="text"
                               name="gelar_depan"
                               id="gelar_depan"
                               class="form-control">
                    </div>

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text"
                               name="nama"
                               id="nama"
                               class="form-control"
                               required>
                    </div>

                    {{-- Gelar Belakang --}}
                    <div class="mb-3">
                        <label class="form-label">Gelar Belakang</label>
                        <input type="text"
                               name="gelar_belakang"
                               id="gelar_belakang"
                               class="form-control">
                    </div>

                    {{-- Jabatan --}}
                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text"
                               name="jabatan"
                               id="jabatan"
                               class="form-control">
                    </div>

                    {{-- Bidang Keahlian --}}
                    <div class="mb-3">
                        <label class="form-label">Bidang Keahlian</label>
                        <input type="text"
                               name="bidang_keahlian"
                               id="bidang_keahlian"
                               class="form-control">
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control">
                    </div>

                    {{-- Telepon --}}
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text"
                               name="telepon"
                               id="telepon"
                               class="form-control">
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status"
                                id="status"
                                class="form-select">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>

                    {{-- Foto --}}
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file"
                               name="foto"
                               id="foto"
                               class="form-control"
                               accept="image/*">
                    </div>

                    {{-- Preview Foto --}}
                    <div class="mb-3">
                        <label class="form-label">Foto Saat Ini</label>
                        <div id="previewFoto"></div>
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
