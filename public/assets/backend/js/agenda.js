$(function () {
    let storeUrl = $("#formCreate").data("store");
    let updateUrl = "/management-konten/agenda";

    let agendaTable = $("#agendaTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#agendaTable").data("url"),
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
                data: "tanggal_mulai",
                name: "tanggal_mulai",
            },
            {
                data: "tanggal_selesai",
                name: "tanggal_selesai",
            },
            {
                data: "lokasi",
                name: "lokasi",
            },
            {
                data: "gambar",
                name: "gambar",
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

    // ===== OPEN MODAL ADD =====
    $("#btnAddAgenda").on("click", function () {
        $("#formCreate")[0].reset();
        $("#agendaId").val(""); // hapus id, supaya dianggap tambah
        $("#modalTitle").text("Tambah Agenda");
        $("#previewGambar").html(""); // hapus preview gambar
        $("#modalCreate").modal("show");
    });

    // ==== SIMPAN BERITA ====
    $("#formCreate").on("submit", function (e) {
        e.preventDefault();

        let id = $("#agendaId").val(); // ambil id, kosong = tambah
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
                    agendaTable.ajax.reload();
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
    $(document).on("click", ".editAgenda", function () {
        // RESET FORM & FILE INPUT
        $("#formCreate")[0].reset();
        $("#formCreate input[type=file]").val(null);
        $("#previewGambar").html("");

        let id = $(this).data("id");

        $.get("/management-konten/agenda/" + id, function (res) {
            let data = res.data;

            $("#agendaId").val(id);
            $("#judul").val(data.judul);
            $("#tanggal_mulai").val(data.tanggal_mulai);
            $("#tanggal_selesai").val(data.tanggal_selesai);
            $("#lokasi").val(data.lokasi);
            $("#deskripsi").val(data.deskripsi);

            if (data.gambar) {
                $("#previewGambar").html(
                    `<img src="${data.gambar}" class="img-fluid" style="max-height:200px;">`
                );
            } else {
                $("#previewGambar").html("Tidak ada gambar");
            }

            $("#modalTitle").text("Edit Agenda");
            $("#modalCreate").modal("show");
        });
    });

    // ==== DELETE BERITA ====
    $(document).on("click", ".deleteAgenda", function () {
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
                    url: "/management-konten/agenda/" + id,
                    type: "POST", // method spoofing
                    data: {
                        _method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (res) {
                        if (res.status) {
                            agendaTable.ajax.reload(null, false); // reload DataTables tanpa reset paging
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

    // DETAIL Agenda
    $(document).on("click", ".detailAgenda", function () {
        let id = $(this).data("id");

        $.ajax({
            url: "/management-konten/agenda/" + id, // sesuaikan route
            type: "GET",
            success: function (res) {
                if (res.status) {
                    const data = res.data;

                    $("#detailJudul").text(data.judul);
                    $("#detailTanggalMulai").text(data.tanggal_mulai);
                    $("#detailTanggalSelesai").text(data.tanggal_selesai);
                    $("#detailLokasi").text(data.lokasi);
                    $("#detailDeskripsi").text(data.deskripsi);

                    if (data.gambar) {
                        $("#detailGambar").html(
                            '<img src="' +
                                data.gambar +
                                '" class="img-fluid" style="max-height:200px;">'
                        );
                    } else {
                        $("#detailGambar").html("-");
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

    // ===== Baru saja dihapus =====

    // Saat tombol "Baru Saja Dihapus" diklik, buka modal & ambil data
    $("#btnSampahAgenda").on("click", function () {
        $("#modalSampahAgenda").modal("show");
        fetchSampahAgenda();
    });

    function fetchSampahAgenda() {
        $.ajax({
            url: "/management-konten/agenda/sampah",
            type: "GET",
            success: function (res) {
                let tbody = "";

                if (res.data && res.data.length > 0) {
                    res.data.forEach(function (item) {
                        let tanggalHapus = item.deleted_at
                            ? new Date(item.deleted_at).toLocaleString("id-ID")
                            : "-";

                        let userHapus = item.deleted_by
                            ? item.deleted_by.name
                            : "-";

                        tbody += `
                        <tr>
                            <td>${item.judul}</td>
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
                            Tidak ada Agenda sampah
                        </td>
                    </tr>
                `;
                }

                $("#tableSampahAgenda tbody").html(tbody);
            },
        });
    }

    // Restore
    $(document).on("click", ".restore-btn", function () {
        let id = $(this).data("id");

        $.ajax({
            url: `/management-konten/agenda/${id}/restore`,
            type: "POST",
            success: function (res) {
                alert(res.message);

                // refresh tabel sampah
                fetchSampahAgenda();

                // 🔥 refresh tabel barang utama
                agendaTable.ajax.reload(null, false);

                // optional: tutup modal
                $("#modalSampahAgenda").modal("hide");
            },
        });
    });

    // Force Delete
    $(document).on("click", ".delete-btn", function () {
        if (!confirm("Apakah yakin ingin menghapus permanen?")) return;

        let id = $(this).data("id");

        $.ajax({
            url: `/management-konten/agenda/${id}/force-delete`,
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
                fetchSampahAgenda();
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
