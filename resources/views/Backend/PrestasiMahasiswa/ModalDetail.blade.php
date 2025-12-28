<!-- Modal Detail Dosen -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail Dosen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="row">
                    <!-- Foto -->
                    <div class="col-md-4 text-center">
                        <img id="detailFoto" src="" class="img-fluid rounded mb-3"
                            style="max-height: 220px; object-fit: cover;" alt="Foto Dosen">

                        <span id="detailStatus" class="badge"></span>
                    </div>

                    <!-- Data -->
                    <div class="col-md-8">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th width="35%">NIDN</th>
                                <td id="detailNidn">-</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td id="detailNama">-</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td id="detailJabatan">-</td>
                            </tr>
                            <tr>
                                <th>Bidang Keahlian</th>
                                <td id="detailBidang">-</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td id="detailEmail">-</td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td id="detailTelepon">-</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td id="detailStatusText">-</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>
