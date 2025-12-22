$(function () {
    let url = $("#beritaTable").data("url");
    let storeUrl = $("#btnAdd").data("store");
    let updateUrl = "/management-konten/berita";

    // DATATABLE BERITA
    let beritaTable = $("#beritaTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "judul", name: "judul" },
            {
                data: "kategori",
                name: "kategori.nama",
                orderable: false,
                searchable: false,
            },
            {
                data: "gambar",
                name: "gambar",
                orderable: false,
                searchable: false,
            },
            { data: "penulis", name: "penulis" },
            { data: "views", name: "views" },
            {
                data: "status",
                name: "is_published",
                orderable: false,
                searchable: false,
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    // ===== OPEN MODAL ADD =====
    $("#btnAdd").on("click", function () {
        $("#formCreate")[0].reset();
        $("#beritaId").val("");
        $("#modalTitle").text("Tambah Berita");

        loadKategori(); // 🔥 PENTING

        $("#modalCreate").modal("show");
    });

    // ==== MODAL TAMBAH KATEGORI ====
    $("#btnAddKategori").on("click", function () {
        $("#modalKategori").modal("show");
    });

    $("#btnAddKategoriForm").on("click", function () {
        $("#formKategori")[0].reset();
        $("input[name='id']").val("");
    });

    // DATATABLE KATEGORI
    let kategoriTable = $("#kategoriTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#kategoriTable").data("url"),
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "nama", name: "nama" },
            {
                data: "warna",
                name: "warna",
                orderable: false,
                searchable: false,
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    // ==== SIMPAN KATEGORI ====
    $("#formKategori").on("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: $("#formKategori").data("store"),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (res) {
                if (res.status) {
                    // reload DataTables
                    kategoriTable.ajax.reload(null, false);
                    loadKategori();

                    // reset form manual
                    $("#formKategori")[0].reset(); // reset input biasa

                    // reset input warna (jika input type="color")
                    $("#formKategori input[type='color']").val("#000000"); // atur default warna

                    // reset input teks (jika ada yang tersisa)
                    $("#formKategori input[type='text']").val("");

                    // reset select (jika ada select)
                    $("#formKategori select").prop("selectedIndex", 0);

                    // notifikasi sukses
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: res.message,
                    });
                }
            },

            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: xhr.responseJSON.message ?? "Terjadi kesalahan",
                });
            },
        });
    });

    // DELETE KATEGORI
    $(document).on("click", ".deleteKategori", function () {
        let id = $(this).data("id");

        if (!confirm("Yakin ingin menghapus kategori ini?")) return;

        $.ajax({
            url: "/management-konten/kategori-berita/" + id, // URL sesuai resource destroy
            type: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                if (res.status) {
                    kategoriTable.ajax.reload(null, false);
                    beritaTable.ajax.reload(null, false);

                    // 🔥 INI YANG KAMU BUTUHKAN
                    reloadKategori();

                    Swal.fire("Berhasil", res.message, "success");
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                alert("Terjadi kesalahan saat menghapus data!");
            },
        });
    });

    // DETAIL BERITA
    $(document).on("click", ".detailBerita", function () {
        let id = $(this).data("id");

        $.ajax({
            url: "/management-konten/berita/" + id, // sesuaikan route
            type: "GET",
            success: function (res) {
                if (res.status) {
                    const data = res.data;

                    $("#detailJudul").text(data.judul);
                    $("#detailKategori").text(data.kategori);
                    $("#detailPenulis").text(data.penulis);
                    $("#detailIsi").text(data.konten);
                    $("#detailStatus").text(data.status);

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

    // --- OPEN MODAL EDIT ---
    $(document).on("click", ".editBerita", function (e) {
        e.preventDefault();

        let id = e.currentTarget.dataset.id; // 🔥 FIX

        console.log("EDIT ID =", id);

        $.get("/management-konten/berita/" + id, function (res) {
            let data = res.data;

            $("#beritaId").val(data.id);
            console.log("INPUT ID =", $("#beritaId").val());

            $("#judul").val(data.judul);
            $("#konten").val(data.konten);
            $("#penulis").val(data.penulis);

            loadKategori(data.kategori_id);

            $("#modalCreate").modal("show");
        });
    });

    // ==== SIMPAN / UPDATE BERITA (FINAL) ====
    $("#formCreate")
        .off("submit")
        .on("submit", function (e) {
            e.preventDefault();

            let id = $("#beritaId").val();
            let formData = new FormData(this);

            let ajaxUrl = id
                ? "/management-konten/berita/" + id
                : $("#btnAdd").data("store");

            if (id) {
                formData.append("_method", "PUT");
            }

            $.ajax({
                url: ajaxUrl,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    $("#modalCreate").modal("hide");
                    $("#beritaId").val(""); // reset ID
                    beritaTable.ajax.reload(null, false);
                    Swal.fire("Berhasil", res.message, "success");
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let msg = "";
                        $.each(xhr.responseJSON.errors, function (k, v) {
                            msg += v + "\n";
                        });
                        Swal.fire("Error", msg, "error");
                    } else {
                        Swal.fire("Error", "Terjadi kesalahan", "error");
                    }
                },
            });
        });

    // ==== DELETE BERITA ====
    $(document).on("click", ".deleteBerita", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "Yakin ingin menghapus berita ini?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/management-konten/berita/" + id,
                    type: "POST", // method spoofing
                    data: {
                        _method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (res) {
                        if (res.status) {
                            beritaTable.ajax.reload(null, false); // reload DataTables tanpa reset paging
                            Swal.fire("Terhapus!", res.message, "success");
                        }
                    },
                    error: function (xhr) {
                        Swal.fire("Error", "Gagal menghapus berita!", "error");
                    },
                });
            }
        });
    });

    function loadKategori(selected = null) {
        $.ajax({
            url: "/management-konten/kategori-berita/list",
            type: "GET",
            success: function (res) {
                let option = '<option value="">Pilih Kategori</option>';

                res.data.forEach((item) => {
                    option += `
                    <option value="${item.id}"
                        ${selected == item.id ? "selected" : ""}>
                        ${item.nama}
                    </option>
                `;
                });

                $("#kategori").html(option);
            },
        });
    }

    // ===== Baru saja dihapus =====

    // Saat tombol "Baru Saja Dihapus" diklik, buka modal & ambil data
    $("#btnSampahBerita").on("click", function () {
        $("#modalSampahBerita").modal("show");
        fetchSampahBerita();
    });

    function fetchSampahBerita() {
        $.ajax({
            url: "/management-konten/berita/sampah",
            type: "GET",
            success: function (res) {
                let tbody = "";

                if (res.data && res.data.length > 0) {
                    res.data.forEach(function (item) {
                        let tanggalHapus = item.deleted_at
                            ? new Date(item.deleted_at).toLocaleString("id-ID")
                            : "-";

                        let kategori = item.kategori?.nama ?? "-";

                        tbody += `
                        <tr>
                            <td>${item.judul}</td>
                            <td>${kategori}</td>
                            <td>${item.penulis}</td>
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
                            Tidak ada berita dihapus
                        </td>
                    </tr>
                `;
                }

                $("#tableSampahBerita tbody").html(tbody);
            },
        });
    }

    // Restore
    $(document).on("click", ".restore-btn", function () {
        let id = $(this).data("id");

        $.ajax({
            url: `/management-konten/berita/${id}/restore`,
            type: "POST",
            success: function (res) {
                alert(res.message);

                // refresh tabel sampah
                fetchSampahBerita();

                // 🔥 refresh tabel barang utama
                beritaTable.ajax.reload(null, false);

                // optional: tutup modal
                $("#modalSampahBerita").modal("hide");
            },
        });
    });

    // Force Delete
    $(document).on("click", ".delete-btn", function () {
        if (!confirm("Apakah yakin ingin menghapus permanen?")) return;

        let id = $(this).data("id");

        $.ajax({
            url: `/management-konten/berita/${id}/force-delete`,
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
                fetchSampahBerita();
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
