<?php

namespace App\Http\Controllers\Backend;

use App\Models\Kurikulum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Penelitian;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PenelitianController extends Controller
{
    public function index()
    {
        $dosens = Dosen::orderBy('nama')->get();

        return view('Backend.PenelitianPengabdian.penelitian.index', compact('dosens'));
    }

    public function getData()
    {
        $kurikulum = Penelitian::query();

        return DataTables::of($kurikulum)
            ->addIndexColumn()

            // ===== KOLOM FILE PDF =====
            ->addColumn('file_url', function ($row) {
                if ($row->file_url) {
                    $url = asset('storage/penelitian/' . $row->file_url);

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
                $updateUrl = route('penelitian.update', $row->id);
                return '
                <div class="d-flex gap-1">
                    <button class="btn btn-info btn-sm detailBtn" data-id="' . $row->id . '">
                        <i class="bx bx-show"></i>
                    </button>
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

            ->rawColumns(['file_url', 'aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'tahun'      => 'required|digits:4|integer|min:2000',
            'jenis'  => 'required|string|max:255',
            'abstrak'  => 'nullable|string',
            'status'  => 'nullable|string',
            'file_url'   => 'nullable|mimes:pdf|max:2048',
            'dosen_id'   => 'required|array',
            'dosen_id.*' => 'exists:dosens,id',
            'peran'   => 'nullable|array',
        ]);

        // ⛔ JANGAN PAKE $request->all()
        // ambil field teks saja
        $data = $request->only([
            'judul',
            'tahun',
            'jenis',
            'abstrak',
            'status',
        ]);

        // ✅ HANDLE FILE PDF
        if ($request->hasFile('file_url')) {
            $file = $request->file('file_url');

            $namaFile = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('penelitian', $namaFile, 'public');

            // simpan NAMA FILE ke DB
            $data['file_url'] = $namaFile;
        }

        $agenda = Penelitian::create($data);

        $pivotData = [];
        foreach ($request->dosen_id as $i => $dosenId) {
            if ($dosenId) {
                $pivotData[$dosenId] = [
                    'peran' => $request->peran[$i] ?? null
                ];
            }
        }

        $agenda->dosen()->attach($pivotData);

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil ditambahkan',
            'data'    => $agenda
        ]);
    }

    public function show($id)
    {
        $agenda = Penelitian::with('dosen')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $agenda,
            'selected_dosens' => $agenda->dosen->map(function ($dosen) {
                return [
                    'id'    => $dosen->id,
                    'peran' => $dosen->pivot->peran
                ];
            }),
            'dosens' => Dosen::select('id', 'nama')->get()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul'    => 'sometimes|required|string|max:255',
            'jenis'    => 'sometimes|required|string|max:100',
            'tahun'    => 'sometimes|required|digits:4|integer|min:2000',
            'abstrak'  => 'nullable|string',
            'status'   => 'sometimes|required|in:draft,publish',
            'file_url' => 'sometimes|nullable|mimes:pdf|max:2048',
            'dosen_id'   => 'sometimes|array',
            'dosen_id.*' => 'exists:dosens,id',
            'peran'       => 'nullable|array',
        ]);

        // 2️⃣ Ambil data kurikulum
        $kurikulum = Penelitian::findOrFail($id);

        // 3️⃣ Ambil field teks saja
        $data = $request->only([
            'judul',
            'tahun',
            'jenis',
            'abstrak',
            'status',
        ]);

        // 4️⃣ Handle upload PDF (jika ada)
        if ($request->hasFile('file_url')) {

            // hapus PDF lama
            if (
                $kurikulum->file_url &&
                Storage::disk('public')->exists('penelitian/' . $kurikulum->file_url)
            ) {
                Storage::disk('public')->delete('penelitian/' . $kurikulum->file_url);
            }

            // simpan PDF baru
            $file = $request->file('file_url');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('penelitian', $namaFile, 'public');

            $data['file_url'] = $namaFile;
        }

        // 5️⃣ Update data
        $kurikulum->update($data);

        // 6️⃣ UPDATE RELASI DOSEN (PIVOT)
        if ($request->has('dosen_id')) {
            $pivotData = [];

            foreach ($request->dosen_id as $i => $dosenId) {
                if ($dosenId) {
                    $pivotData[$dosenId] = [
                        'peran' => $request->peran[$i] ?? null
                    ];
                }
            }

            $kurikulum->dosen()->sync($pivotData);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil diperbarui',
            'data'    => $kurikulum
        ]);
    }

    public function destroy($id)
    {
        $agenda = Penelitian::findOrFail($id);

        // JANGAN hapus gambar saat soft delete
        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipindahkan ke sampah'
        ]);
    }

    public function sampah()
    {
        $sampah = Penelitian::onlyTrashed()->get();

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah
        ]);
    }

    public function restore($id)
    {
        $barang = Penelitian::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $kurikulum = Penelitian::withTrashed()->findOrFail($id);

        // 🔥 HAPUS FILE PDF JIKA ADA
        if (
            $kurikulum->file_url &&
            Storage::disk('public')->exists('penelitian/' . $kurikulum->file_url)
        ) {
            Storage::disk('public')->delete('penelitian/' . $kurikulum->file_url);
        }

        // 🔥 HAPUS DATA PERMANEN
        $kurikulum->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data dan file PDF berhasil dihapus permanen'
        ]);
    }
}
