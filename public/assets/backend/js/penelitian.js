$(document).ready(function () {
    let dosens = [];
    let storeUrl = $("#formCreate").data("store");
    let updateUrl = "/penelitian/pengabdian/penelitian";

    $.get("/penelitian/pengabdian/master/dosen", function (res) {
        dosens = res.data ?? res;
    });

    let Table = $("#penelitianTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: $("#penelitianTable").data("url"),
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "judul", name: "judul" },
            { data: "jenis", name: "jenis" },
            { data: "tahun", name: "tahun" },
            { data: "abstrak", name: "abstrak" },
            {
                data: "file_url",
                name: "file_url",
                orderable: false,
                searchable: false,
            },
            { data: "status", name: "status" },
            {
                data: "aksi",
                name: "aksi",
                orderable: false,
                searchable: false,
            },
        ],
    });

    function createDosenRow(selectedId = null, peran = "") {
        let template = $("#dosenTemplate .dosen-row").clone();
        let select = template.find(".dosen-select");

        select.attr("name", "dosen_id[]");

        dosens.forEach((d) => {
            select.append(`
            <option value="${d.id}" ${
                String(d.id) === String(selectedId) ? "selected" : ""
            }>
                ${d.nama}
            </option>
        `);
        });

        template.find(".peran").attr("name", "peran[]").val(peran);

        return template;
    }

    $("#addDosen").on("click", function () {
        $("#dosenWrapper").append(createDosenRow());
    });

    $(document).on("click", ".removeDosen", function () {
        if ($(".dosen-row").length > 1) {
            $(this).closest(".dosen-row").remove();
        } else {
            alert("Minimal harus ada 1 dosen");
        }
    });

    $("#btnAdd").on("click", function () {
        $("#formCreate")[0].reset();
        $("#penelitian_id").val("");
        $("#dosenWrapper").empty();

        // minimal 1 dosen
        $("#dosenWrapper").append(createDosenRow());

        $("#modalTitle").text("Tambah Data");
        $("#modalCreate").modal("show");
    });

    $(document).on("click", ".editBtn", function () {
        let id = $(this).data("id");

        $.get("/penelitian/pengabdian/penelitian/" + id, function (res) {
            let data = res.data;
            let selected = res.selected_dosens ?? [];

            $("#formCreate")[0].reset();
            $("#penelitian_id").val(id);
            $("#dosenWrapper").empty();

            $("#judul").val(data.judul);
            $("#tahun").val(data.tahun);
            $("#jenis").val(data.jenis);
            $("#abstrak").val(data.abstrak);
            $("#status").val(data.status);

            if (selected.length > 0) {
                selected.forEach((d) => {
                    $("#dosenWrapper").append(createDosenRow(d.id, d.peran));
                });
            } else {
                $("#dosenWrapper").append(createDosenRow());
            }

            // preview PDF
            if (data.file_url) {
                $("#previewPdf").html(`
                    <a href="/storage/penelitian/${data.file_url}"
                       target="_blank"
                       class="btn btn-sm btn-primary">
                        Lihat PDF Saat Ini
                    </a>
                `);
            } else {
                $("#previewPdf").html("-");
            }

            $("#modalTitle").text("Edit Data");
            $("#modalCreate").modal("show");
        });
    });

    $("#formCreate").on("submit", function (e) {
        e.preventDefault();

        let id = $("#penelitian_id").val();
        let formData = new FormData(this);

        let url = id ? updateUrl + "/" + id : storeUrl;

        if (id) formData.append("_method", "PUT");

        $.ajax({
            url: url,
            type: "POST",
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

    $(document).on("click", ".deleteBtn", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "Yakin?",
            text: "Data akan dihapus",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: updateUrl + "/" + id,
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (res) {
                        Table.ajax.reload();
                        Swal.fire("Berhasil", res.message, "success");
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
            url: "/penelitian/pengabdian/penelitian/sampah",
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
                                <td>${item.jenis}</td>
                                <td>${item.tahun}</td>
                                <td>${item.abstrak}</td>
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
            url: `/penelitian/pengabdian/penelitian/${id}/restore`,
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
            url: `/penelitian/pengabdian/penelitian/${id}/force-delete`,
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

    // DETAIL PENELITIAN
    // DETAIL PENELITIAN
$(document).on("click", ".detailBtn", function () {
    let id = $(this).data("id");

    $.get("/penelitian/pengabdian/penelitian/" + id, function (res) {
        if (!res.status) return;

        let data = res.data;

        // ===== SET DATA =====
        $("#detail_judul").text(data.judul ?? "-");
        $("#detail_jenis").text(data.jenis ?? "-");
        $("#detail_tahun").text(data.tahun ?? "-");
        $("#detail_abstrak").text(data.abstrak ?? "-");
        $("#detail_status").text(data.status ?? "-");

        // ===== FILE =====
        if (data.file_url) {
            $("#detail_file").html(`
                <a href="/storage/penelitian/${data.file_url}"
                   target="_blank"
                   class="btn btn-sm btn-primary">
                   Lihat PDF
                </a>
            `);
        } else {
            $("#detail_file").text("-");
        }

        // ===== DOSEN =====
        let dosenHtml = "-";
        if (data.dosen && data.dosen.length > 0) {
            dosenHtml = "<ul class='mb-0'>";
            data.dosen.forEach(d => {
                dosenHtml += `
                    <li>
                        ${d.nama}
                        ${d.pivot?.peran ? ` - <em>${d.pivot.peran}</em>` : ""}
                    </li>
                `;
            });
            dosenHtml += "</ul>";
        }

        $("#detail_dosen").html(dosenHtml);

        $("#modalDetail").modal("show");
    });
});
// DETAIL PENELITIAN
$(document).on("click", ".detailBtn", function () {
    let id = $(this).data("id");

    $.get("/penelitian/pengabdian/penelitian/" + id, function (res) {
        if (!res.status) return;

        let data = res.data;

        // ===== SET DATA =====
        $("#detail_judul").text(data.judul ?? "-");
        $("#detail_jenis").text(data.jenis ?? "-");
        $("#detail_tahun").text(data.tahun ?? "-");
        $("#detail_abstrak").text(data.abstrak ?? "-");
        $("#detail_status").text(data.status ?? "-");

        // ===== FILE =====
        if (data.file_url) {
            $("#detail_file").html(`
                <a href="/storage/penelitian/${data.file_url}"
                   target="_blank"
                   class="btn btn-sm btn-primary">
                   Lihat PDF
                </a>
            `);
        } else {
            $("#detail_file").text("-");
        }

        // ===== DOSEN =====
        let dosenHtml = "-";
        if (data.dosen && data.dosen.length > 0) {
            dosenHtml = "<ul class='mb-0'>";
            data.dosen.forEach(d => {
                dosenHtml += `
                    <li>
                        ${d.nama}
                        ${d.pivot?.peran ? ` - <em>${d.pivot.peran}</em>` : ""}
                    </li>
                `;
            });
            dosenHtml += "</ul>";
        }

        $("#detail_dosen").html(dosenHtml);

        $("#modalDetail").modal("show");
    });
});

});
