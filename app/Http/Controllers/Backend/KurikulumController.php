<?php

namespace App\Http\Controllers\Backend;

use App\Models\Kurikulum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class KurikulumController extends Controller
{
    public function index()
    {
        return view('Backend.ManagementAkademik.kurikulum.index');
    }

    public function getData()
    {
        $kurikulum = Kurikulum::query();

        return DataTables::of($kurikulum)
            ->addIndexColumn()

            // ===== KOLOM FILE PDF =====
            ->addColumn('file_pdf', function ($row) {
                if ($row->file_pdf) {
                    $url = asset('storage/kurikulum/' . $row->file_pdf);

                    return '
                    <a href="' . $url . '" target="_blank"
                       class="btn btn-primary btn-sm">
                        <i class="bx bx-file"></i> PDF
                    </a>
                ';
                }

                return '-';
            })

            ->addColumn('aksi', function ($row) {
                $updateUrl = route('kurikulum.update', $row->id);
                return '
                <div class="d-flex gap-1">
                    <button class="btn btn-warning btn-sm editBtn"
                        data-id="' . $row->id . '"
                        data-update="' . $updateUrl . '">
                        <i class="bx bx-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm deleteBtn" data-id="' . $row->id . '">
                        <i class="bx bx-trash"></i>
                    </button>
                    </div>
            ';
            })

            ->rawColumns(['file_pdf', 'aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'tahun'      => 'required|digits:4|integer|min:2000',
            'total_sks'  => 'required|integer|min:1|max:300',
            'deskripsi'  => 'nullable|string',
            'file_pdf'   => 'nullable|mimes:pdf|max:2048',
        ]);

        // ⛔ JANGAN PAKE $request->all()
        // ambil field teks saja
        $data = $request->only([
            'nama',
            'tahun',
            'total_sks',
            'deskripsi',
        ]);

        // ✅ HANDLE FILE PDF
        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');

            $namaFile = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('kurikulum', $namaFile, 'public');

            // simpan NAMA FILE ke DB
            $data['file_pdf'] = $namaFile;
        }

        $agenda = Kurikulum::create($data);

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil ditambahkan',
            'data'    => $agenda
        ]);
    }

    public function show($id)
    {
        $agenda = Kurikulum::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $agenda
        ]);
    }

    public function update(Request $request, string $id)
    {
        // 1️⃣ Validasi
        $request->validate([
            'nama'       => 'sometimes|required|string|max:255',
            'tahun'      => 'sometimes|required|digits:4|integer|min:2000',
            'total_sks'  => 'sometimes|required|integer|min:1|max:300',
            'deskripsi'  => 'nullable|string',
            'file_pdf'   => 'sometimes|nullable|mimes:pdf|max:2048',
        ]);

        // 2️⃣ Ambil data kurikulum
        $kurikulum = Kurikulum::findOrFail($id);

        // 3️⃣ Ambil field teks saja
        $data = $request->only([
            'nama',
            'tahun',
            'total_sks',
            'deskripsi',
        ]);

        // 4️⃣ Handle upload PDF (jika ada)
        if ($request->hasFile('file_pdf')) {

            // hapus PDF lama
            if (
                $kurikulum->file_pdf &&
                Storage::disk('public')->exists('kurikulum/' . $kurikulum->file_pdf)
            ) {
                Storage::disk('public')->delete('kurikulum/' . $kurikulum->file_pdf);
            }

            // simpan PDF baru
            $file = $request->file('file_pdf');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('kurikulum', $namaFile, 'public');

            $data['file_pdf'] = $namaFile;
        }

        // 5️⃣ Update data
        $kurikulum->update($data);

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil diperbarui',
            'data'    => $kurikulum
        ]);
    }

    public function destroy($id)
    {
        $agenda = Kurikulum::findOrFail($id);

        // JANGAN hapus gambar saat soft delete
        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipindahkan ke sampah'
        ]);
    }

    public function sampah()
    {
        $sampah = Kurikulum::onlyTrashed()->get();

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah
        ]);
    }

    public function restore($id)
    {
        $barang = Kurikulum::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $kurikulum = Kurikulum::withTrashed()->findOrFail($id);

        // 🔥 HAPUS FILE PDF JIKA ADA
        if (
            $kurikulum->file_pdf &&
            Storage::disk('public')->exists('kurikulum/' . $kurikulum->file_pdf)
        ) {
            Storage::disk('public')->delete('kurikulum/' . $kurikulum->file_pdf);
        }

        // 🔥 HAPUS DATA PERMANEN
        $kurikulum->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data dan file PDF berhasil dihapus permanen'
        ]);
    }
}
