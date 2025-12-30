$(function () {
    let storeUrl = $("#formCreate").data("store");
    let updateUrl = "/user";

    let Table = $("#userTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#userTable").data("url"),
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "avatar",
                name: "avatar",
                orderable: false,
                searchable: false,
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "email",
                name: "email",
            },
            {
                data: "role",
                name: "roles.name",
            },
            {
                data: "status",
                name: "status",
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

    $("#btnAdd").on("click", function () {
        // reset form
        $("#formCreate")[0].reset();

        // hapus id (penting!)
        $("#userId").val("");

        // hapus preview foto
        $("#previewFoto").html("");

        // reset file input
        $("#foto").val(null);

        // reset title
        $("#modalTitle").text("Tambah Data");

        $("#modalCreate").modal("show");
    });

    $("#formCreate").on("submit", function (e) {
        e.preventDefault();

        let id = $("#userId").val(); // ambil id, kosong = tambah
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

        $.get("/user/" + id, function (res) {
            let data = res.data;

            $("#userId").val(id);
            $("#name").val(data.name);
            $("#email").val(data.email);
            $("#role_id").val(data.role_id);
            $("#is_active").val(data.is_active);

            if (data.avatar) {
                $("#previewFoto").html(
                    `<img src="${data.avatar}" class="img-fluid" style="max-height:200px;">`
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
                    url: "/user/" + id,
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
            url: "/user/sampah",
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

                        let gambar = item.avatar
                            ? `<img src="${item.avatar}" class="img-thumbnail" style="max-height:80px;">`
                            : `<span class="text-muted">Tidak ada gambar</span>`;

                        tbody += `
                        <tr>
                            <td>${item.name}</td>

                            <td>${item.email}</td>
                            <td>${gambar}</td>
                            <td>${item.role_id}</td>
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
            url: `/user/${id}/restore`,
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
            url: `/user/${id}/force-delete`,
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
