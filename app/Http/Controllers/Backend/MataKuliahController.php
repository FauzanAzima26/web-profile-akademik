<?php

namespace App\Http\Controllers\Backend;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    public function index()
    {
        return view('Backend.ManagementAkademik.mata_kuliah.index');
    }

    public function getData()
    {
        $agenda = MataKuliah::query();

        return DataTables::of($agenda)
            ->addIndexColumn()

            ->addColumn('aksi', function ($row) {
                $updateUrl = route('mata.kuliah.update', $row->id);
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
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'sks' => 'required',
            'semester' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = $request->all();

        // simpan berita
        $agenda = MataKuliah::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $agenda
        ]);
    }

    public function show($id)
    {
        $agenda = MataKuliah::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $agenda
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode' => [
                'required',
                Rule::unique('mata_kuliah', 'kode')->ignore($id),
            ],

            'nama'      => 'required|string|max:255',

            'sks'       => 'required|integer|min:1|max:10',
            'semester'  => 'required|integer|min:1|max:14',

            'deskripsi' => 'nullable|string',
        ]);

        $agenda = MataKuliah::findOrFail($id);

        // Ambil hanya field yang dikirim & bukan null
        // Ringkas & Elegan (Versi Laravel)
        $data = collect($request->only(['kode', 'nama', 'sks', 'semester', 'deskripsi']))
            ->filter()
            ->toArray();

        // Update data teks
        $agenda->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $agenda
        ]);
    }

    public function destroy($id)
    {
        $agenda = MataKuliah::findOrFail($id);

        // JANGAN hapus gambar saat soft delete
        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipindahkan ke sampah'
        ]);
    }

    public function sampah()
    {
        $sampah = MataKuliah::onlyTrashed()->get();

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah
        ]);
    }

    public function restore($id)
    {
        $barang = MataKuliah::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $agenda = MataKuliah::withTrashed()->findOrFail($id);

        $agenda->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus permanen'
        ]);
    }
}
