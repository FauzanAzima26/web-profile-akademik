$(function () {
    let storeUrl = $("#formCreate").data("store");
    let updateUrl = "/penelitian/pengabdian/pengabdian";

    let Table = $("#pengabdianTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#pengabdianTable").data("url"),
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "judul",
                name: "judul",
            },
            {
                data: "tahun",
                name: "tahun",
            },
            {
                data: "nama_dosen",
                name: "nama_dosen",
            },
            { data: "lokasi", name: "lokasi" },

            {
                data: "peserta",
                name: "peserta",
            },
            {
                data: "deskripsi",
                name: "deskripsi",
            },
            {
                data: "foto",
                name: "foto",
                orderable: false,
                searchable: false,
            },
            {
                data: "status",
                name: "status",
            },
            {
                data: "aksi",
                name: "aksi",
                orderable: false,
                searchable: false,
            },
        ],
    });

    $("#btnAdd").on("click", function () {
        // reset form
        $("#formCreate")[0].reset();

        // hapus id (penting!)
        $("#pengabdian_id").val("");

        // hapus preview foto
        $("#previewFoto").html("");

        // reset file input
        $("#foto_url").val(null);

        // reset title
        $("#modalTitle").text("Tambah Data");

        $("#modalCreate").modal("show");
    });

    $("#formCreate").on("submit", function (e) {
        e.preventDefault();

        let id = $("#pengabdian_id").val(); // ambil id, kosong = tambah
        let formData = new FormData(this);

        // Ambil URL update dari tombol edit jika ada
        let url = id
            ? $("#formCreate").data("update") || updateUrl + "/" + id
            : storeUrl;

        if (id) formData.append("_method", "PUT"); // method spoofing untuk update

        $.ajax({
            url: url,
            type: "POST", // selalu POST untuk AJAX + _method
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status) {
                    $("#modalCreate").modal("hide");
                    Table.ajax.reload();
                    Swal.fire("Berhasil", res.message, "success");
                }
            },
            error: function (xhr) {
                Swal.fire(
                    "Error",
                    xhr.responseJSON?.message ?? "Terjadi kesalahan",
                    "error"
                );
            },
        });
    });

    $(document).on("click", ".editBtn", function () {
        // RESET FORM & FILE INPUT
        $("#formCreate")[0].reset();
        $("#formCreate input[type=file]").val(null);
        $("#previewFoto").html("");

        let id = $(this).data("id");

        $.get("/penelitian/pengabdian/pengabdian/" + id, function (res) {
            let data = res.data;

            $("#pengabdian_id").val(id);
            $("#judul").val(data.judul);
            $("#dosen_id").val(data.dosen_id);
            $("#tahun").val(data.tahun);
            $("#lokasi").val(data.lokasi);
            $("#peserta").val(data.peserta);
            $("#deskripsi").val(data.deskripsi);
            $("#status").val(data.status ?? "draft");

            if (data.foto_url) {
                $("#previewFoto").html(
                    `<img src="${data.foto_url}" class="img-fluid" style="max-height:200px;">`
                );
            } else {
                $("#previewFoto").html("Tidak ada Gambar");
            }

            $("#modalTitle").text("Edit Data");
            $("#modalCreate").modal("show");
        });
    });

    $(document).on("click", ".deleteBtn", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "Yakin ingin menghapus Agenda ini?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/penelitian/pengabdian/pengabdian/" + id,
                    type: "POST", // method spoofing
                    data: {
                        _method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (res) {
                        if (res.status) {
                            Table.ajax.reload(null, false); // reload DataTables tanpa reset paging
                            Swal.fire("Terhapus!", res.message, "success");
                        }
                    },
                    error: function (xhr) {
                        Swal.fire("Error", "Gagal menghapus agenda!", "error");
                    },
                });
            }
        });
    });

    $("#btnSampah").on("click", function () {
        $("#modalSampah").modal("show");
        fetchSampah();
    });

    function fetchSampah() {
        $.ajax({
            url: "/penelitian/pengabdian/pengabdian/sampah",
            type: "GET",
            success: function (res) {
                let tbody = "";

                if (res.data && res.data.length > 0) {
                    res.data.forEach(function (item) {
                        let tanggalHapus = item.deleted_at
                            ? new Date(item.deleted_at).toLocaleString(
                                  "id-ID",
                                  {
                                      dateStyle: "medium",
                                      timeStyle: "short",
                                  }
                              )
                            : "-";

                        tbody += `
                        <tr>
                            <td>${item.judul}</td>

                            <td>${item.tahun}</td>
                            <td>${item.dosen_id}</td>
                            <td>${item.lokasi}</td>
                            <td>${tanggalHapus}</td>
                            <td class="text-center">
                                <button class="btn btn-success btn-sm restore-btn" data-id="${item.id}">
                                    Restore
                                </button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${item.id}">
                                    Hapus Permanen
                                </button>
                            </td>
                        </tr>
                    `;
                    });
                } else {
                    tbody = `
                    <tr>
                        <td colspan="4" class="text-center">
                            Tidak ada data sampah
                        </td>
                    </tr>
                `;
                }

                $("#tableSampah tbody").html(tbody);
            },
        });
    }

    $(document).on("click", ".restore-btn", function () {
        let id = $(this).data("id");

        $.ajax({
            url: `/penelitian/pengabdian/pengabdian/${id}/restore`,
            type: "POST",
            success: function (res) {
                alert(res.message);

                // refresh tabel sampah
                fetchSampah();

                // 🔥 refresh tabel barang utama
                Table.ajax.reload(null, false);

                // optional: tutup modal
                $("#modalSampah").modal("hide");
            },
        });
    });

    $(document).on("click", ".delete-btn", function () {
        if (!confirm("Apakah yakin ingin menghapus permanen?")) return;

        let id = $(this).data("id");

        $.ajax({
            url: `/penelitian/pengabdian/pengabdian/${id}/force-delete`,
            type: "POST",
            data: {
                _method: "DELETE",
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                if (res.success === false) {
                    alert(res.message);
                    return;
                }

                alert(res.message);
                fetchSampah();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    alert(xhr.responseJSON.message);
                } else {
                    alert("Terjadi kesalahan");
                }
            },
        });
    });
});
