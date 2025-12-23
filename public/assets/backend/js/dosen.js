$(function () {
    let storeUrl = $("#formCreate").data("store");
    let updateUrl = "/management-akademik/dosen";

    let Table = $("#dosenTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#dosenTable").data("url"),
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "nidn",
                name: "nidn",
            },
            {
                data: "nama",
                name: "nama",
                render: function (data, type, row) {
                    let namaLengkap = "";

                    if (row.gelar_depan) {
                        namaLengkap += row.gelar_depan + " ";
                    }

                    namaLengkap += data ?? "-";

                    if (row.gelar_belakang) {
                        namaLengkap += ", " + row.gelar_belakang;
                    }

                    return namaLengkap;
                },
            },
            {
                data: "jabatan",
                name: "jabatan",
            },
            {
                data: "bidang_keahlian",
                name: "bidang_keahlian",
            },
            {
                data: "email",
                name: "email",
            },
            {
                data: "telepon",
                name: "telepon",
            },
            {
                data: "status",
                name: "status",
            },
            {
                data: "foto",
                name: "foto",
                orderable: false,
                searchable: false,
            },
            {
                data: "aksi",
                name: "aksi",
                orderable: false,
                searchable: false,
            },
        ],
    });

    //     // ===== OPEN MODAL ADD =====
    $("#btnAdd").on("click", function () {
        // reset form
        $("#formCreate")[0].reset();

        // hapus id (penting!)
        $("#dosenId").val("");

        // hapus preview foto
        $("#previewFoto").html("");

        // reset file input
        $("#foto").val(null);

        // reset title
        $("#modalTitle").text("Tambah Data");

        $("#modalCreate").modal("show");
    });

    //     // ==== SIMPAN BERITA ====
    $("#formCreate").on("submit", function (e) {
        e.preventDefault();

        let id = $("#dosenId").val(); // ambil id, kosong = tambah
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

    // --- OPEN MODAL EDIT ---
    $(document).on("click", ".editBtn", function () {
        // RESET FORM & FILE INPUT
        $("#formCreate")[0].reset();
        $("#formCreate input[type=file]").val(null);
        $("#previewFoto").html("");

        let id = $(this).data("id");

        $.get("/management-akademik/dosen/" + id, function (res) {
            let data = res.data;

            $("#dosenId").val(id);
            $("#nidn").val(data.nidn);
            $("#nama").val(data.nama);
            $("#gelar_depan").val(data.gelar_depan);
            $("#gelar_belakang").val(data.gelar_belakang);
            $("#jabatan").val(data.jabatan);
            $("#bidang_keahlian").val(data.bidang_keahlian);
            $("#email").val(data.email);
            $("#telepon").val(data.telepon);
            $("#status").val(data.status);

            if (data.foto) {
                $("#previewFoto").html(
                    `<img src="${data.foto}" class="img-fluid" style="max-height:200px;">`
                );
            } else {
                $("#previewFoto").html("Tidak ada Gambar");
            }

            $("#modalTitle").text("Edit Data");
            $("#modalCreate").modal("show");
        });
    });

    //     // ==== DELETE BERITA ====
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
                    url: "/management-akademik/dosen/" + id,
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

    // DETAIL BERITA
    $(document).on("click", ".detailBtn", function () {
        let id = $(this).data("id");

        $.ajax({
            url: "/management-akademik/dosen/" + id, // sesuaikan route
            type: "GET",
            success: function (res) {
                if (res.status) {
                    const data = res.data;

                    $("#detailFoto").attr(
                        "src",
                        data.foto ?? "/assets/img/no-image.png"
                    );

                    $("#detailNidn").text(data.nidn ?? "-");
                    const namaLengkap =
                        (data.gelar_depan ? data.gelar_depan + " " : "") +
                        (data.nama ?? "-") +
                        (data.gelar_belakang ? ", " + data.gelar_belakang : "");

                    $("#detailNama").text(namaLengkap);

                    $("#detailJabatan").text(data.jabatan ?? "-");
                    $("#detailBidang").text(data.bidang_keahlian ?? "-");
                    $("#detailEmail").text(data.email ?? "-");
                    $("#detailTelepon").text(data.telepon ?? "-");

                    $("#detailStatusText").text(data.status ?? "-");

                    // badge status
                    if (data.status === "aktif") {
                        $("#detailStatus")
                            .removeClass()
                            .addClass("badge bg-success")
                            .text("Aktif");
                    } else {
                        $("#detailStatus")
                            .removeClass()
                            .addClass("badge bg-secondary")
                            .text("Nonaktif");
                    }

                    $("#modalDetail").modal("show");
                }
            },
            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Gagal mengambil data detail!",
                });
            },
        });
    });

    //     // ===== Baru saja dihapus =====

    // Saat tombol "Baru Saja Dihapus" diklik, buka modal & ambil data
    $("#btnSampah").on("click", function () {
        $("#modalSampah").modal("show");
        fetchSampah();
    });

    function fetchSampah() {
        $.ajax({
            url: "/management-akademik/dosen/sampah",
            type: "GET",
            success: function (res) {
                let tbody = "";

                if (res.data && res.data.length > 0) {
                    res.data.forEach(function (item) {
                        let tanggalHapus = item.deleted_at
                            ? new Date(item.deleted_at).toLocaleString("id-ID")
                            : "-";

                        let foto = item.foto
                            ? `<img src="${item.foto}" class="img-thumbnail" style="max-height:80px;">`
                            : `<span class="text-muted">Tidak ada foto</span>`;

                        tbody += `
                        <tr>
                            <td>${item.nidn}</td>

                            <!-- ✅ NAMA + GELAR -->
                            <td>
                                ${
                                    item.gelar_depan
                                        ? item.gelar_depan + " "
                                        : ""
                                }
                                ${item.nama ?? "-"}
                                ${
                                    item.gelar_belakang
                                        ? ", " + item.gelar_belakang
                                        : ""
                                }
                            </td>

                            <td>${item.jabatan}</td>
                            <td>${item.bidang_keahlian}</td>
                            <td>${item.status}</td>
                            <td class="text-center">${foto}</td>
                            <td>${tanggalHapus}</td>
                            <td class="text-center">
                                <button class="btn btn-success btn-sm restore-btn" data-id="${
                                    item.id
                                }">
                                    Restore
                                </button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${
                                    item.id
                                }">
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

    //     // Restore
    $(document).on("click", ".restore-btn", function () {
        let id = $(this).data("id");

        $.ajax({
            url: `/management-akademik/dosen/${id}/restore`,
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

    //     // Force Delete
    $(document).on("click", ".delete-btn", function () {
        if (!confirm("Apakah yakin ingin menghapus permanen?")) return;

        let id = $(this).data("id");

        $.ajax({
            url: `/management-akademik/dosen/${id}/force-delete`,
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
