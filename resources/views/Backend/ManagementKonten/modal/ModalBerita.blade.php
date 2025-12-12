<!-- Modal Tambah Berita -->
<div class="modal fade" id="modalCreate" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="formCreate" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="beritaId" name="id">
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori_id" id="kategori" class="form-control">
                            <option value="" selected disabled>Pilih Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Penulis</label>
                        <input type="text" id="penulis" name="penulis" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Isi Berita</label>
                        <textarea name="konten" id="konten" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                    <label>Gambar Saat Ini</label>
                    <div id="previewGambar">
                        <!-- akan diisi JS -->
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
