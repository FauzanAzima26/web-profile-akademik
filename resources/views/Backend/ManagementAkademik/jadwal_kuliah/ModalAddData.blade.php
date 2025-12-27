<!-- Modal Tambah / Edit Dosen -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="formCreate" data-store="{{ route('jadwal.kuliah.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Jadwal Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- ID untuk Edit -->
                    <input type="hidden" id="jadwal_id" name="id">

                    {{-- Mata Kuliah --}}
                    <div class="mb-3">
                        <label class="form-label">Mata Kuliah</label>
                        <select name="mata_kuliah_id" id="mata_kuliah_id" class="form-select" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach ($mata_kuliah as $mk)
                                <option value="{{ $mk->id }}">{{ $mk->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dosen --}}
                    <div class="mb-3">
                        <label class="form-label">Dosen</label>
                        <select name="dosen_id" id="dosen_id" class="form-select" required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach ($dosen as $d)
                                <option value="{{ $d->id }}">{{ $d->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        {{-- Hari --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Hari</label>
                            <select name="hari" id="hari" class="form-select" required>
                                <option value="">-- Pilih Hari --</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>

                        {{-- Jam Mulai --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jam Mulai</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
                        </div>

                        {{-- Jam Selesai --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
                        </div>
                    </div>

                    {{-- Ruangan --}}
                    <div class="mb-3">
                        <label class="form-label">Ruangan</label>
                        <input type="text" name="ruangan" id="ruangan" class="form-control"
                            placeholder="Contoh: Lab Komputer 1" required>
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
