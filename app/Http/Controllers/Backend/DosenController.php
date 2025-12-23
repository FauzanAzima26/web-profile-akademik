<?php

namespace App\Http\Controllers\Backend;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Backend.ManagementAkademik.dosen.index');
    }

    public function getData()
    {
        $agenda = Dosen::query();

        return DataTables::of($agenda)
            ->addIndexColumn()
            ->addColumn('foto', function ($row) {
                if ($row->foto) {
                    return '<img src="' . asset('storage/dosen/' . $row->foto) . '" width="60">';
                }
                return '-';
            })
            ->addColumn('aksi', function ($row) {
                $updateUrl = route('dosen.update', $row->id);
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
            ->rawColumns(['foto', 'aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required',
            'nama' => 'required',
            'gelar_depan' => 'required',
            'gelar_belakang' => 'required',
            'jabatan' => 'required',
            'bidang_keahlian' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        // upload gambar
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('dosen', $nama, 'public');
            $data['foto'] = $nama;
        }

        // simpan berita
        $agenda = Dosen::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $agenda
        ]);
    }

    public function show($id)
    {
        $agenda = Dosen::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => [
                'nidn' => $agenda->nidn,
                'nama' => $agenda->nama,
                'gelar_depan' => $agenda->gelar_depan,
                'gelar_belakang' => $agenda->gelar_belakang,
                'bidang_keahlian' => $agenda->bidang_keahlian,
                'jabatan' => $agenda->jabatan,
                'email' => $agenda->email,
                'telepon' => $agenda->telepon,
                'status' => $agenda->status,
                'foto' => $agenda->foto ? asset('storage/dosen/' . $agenda->foto) : null,
            ]
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nidn' => 'sometimes|required|string|max:50',
            'nama' => 'sometimes|required|string|max:255',
            'gelar_depan' => 'sometimes|nullable|string|max:50',
            'gelar_belakang' => 'sometimes|nullable|string|max:50',
            'jabatan' => 'sometimes|nullable|string|max:100',
            'bidang_keahlian' => 'sometimes|nullable|string|max:150',
            'email' => 'sometimes|nullable|email|max:255',
            'telepon' => 'sometimes|nullable|string|max:20',
            'status' => 'sometimes|nullable|in:aktif,nonaktif',
            'foto' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $agenda = Dosen::findOrFail($id);

        // update data selain foto
        $data = array_filter(
            $request->only([
                'nidn',
                'nama',
                'gelar_depan',
                'gelar_belakang',
                'jabatan',
                'bidang_keahlian',
                'email',
                'telepon',
                'status',
            ]),
            fn($v) => $v !== null
        );

        $agenda->update($data);

        // handle foto
        if ($request->hasFile('foto')) {

            if ($agenda->foto && Storage::disk('public')->exists('dosen/' . $agenda->foto)) {
                Storage::disk('public')->delete('dosen/' . $agenda->foto);
            }

            $file = $request->file('foto');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('dosen', $namaFoto, 'public');

            $agenda->update(['foto' => $namaFoto]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $agenda
        ]);
    }

    public function destroy($id)
    {
        $agenda = Dosen::findOrFail($id);

        // JANGAN hapus gambar saat soft delete
        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipindahkan ke sampah'
        ]);
    }

    public function sampah()
    {
        $sampah = Dosen::onlyTrashed()->get();

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nidn' => $item->nidn,
                    'nama' => $item->nama,
                    'gelar_depan' => $item->gelar_depan,
                    'gelar_belakang' => $item->gelar_belakang,
                    'jabatan' => $item->jabatan,
                    'bidang_keahlian' => $item->bidang_keahlian,
                    'email' => $item->email,
                    'telepon' => $item->telepon,
                    'status' => $item->status,
                    'deleted_at' => $item->deleted_at,
                    'foto' => $item->foto
                        ? asset('storage/dosen/' . $item->foto)
                        : null
                ];
            })
        ]);
    }

    public function restore($id)
    {
        $barang = Dosen::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $agenda = Dosen::withTrashed()->findOrFail($id);

        // Hapus file foto
        if ($agenda->foto && Storage::disk('public')->exists('dosen/' . $agenda->foto)) {
            Storage::disk('public')->delete('dosen/' . $agenda->foto);
        }

        $agenda->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus permanen'
        ]);
    }
}
