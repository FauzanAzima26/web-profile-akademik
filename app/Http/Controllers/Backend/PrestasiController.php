<?php

namespace App\Http\Controllers\Backend;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Storage;
use Laravel\Ui\Presets\Preset;
use Yajra\DataTables\Facades\DataTables;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Backend.PrestasiMahasiswa.index');
    }

    public function getData()
    {
        $agenda = Prestasi::query();

        return DataTables::of($agenda)
            ->addIndexColumn()

            ->addColumn('foto', function ($row) {
                if ($row->foto) {
                    return '<img src="' . asset('storage/prestasi/' . $row->foto) . '" width="60">';
                }
                return '-';
            })
            ->addColumn('aksi', function ($row) {
                $updateUrl = route('prestasi.update', $row->id);
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
            ->rawColumns(['foto', 'aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'tingkat'   => 'required|in:Internasional,Nasional,Provinsi,Kabupaten/Kota,Universitas',
            'tahun'     => 'required|digits:4|integer|min:2000|max:' . (date('Y') + 1),
            'mahasiswa' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        // upload gambar
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('prestasi', $nama, 'public');
            $data['foto'] = $nama;
        }

        // simpan berita
        $agenda = Prestasi::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $agenda
        ]);
    }

    public function show($id)
    {
        $agenda = Prestasi::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => [
                'judul' => $agenda->judul,
                'kategori' => $agenda->kategori,
                'tingkat' => $agenda->tingkat,
                'tahun' => $agenda->tahun,
                'mahasiswa' => $agenda->mahasiswa,
                'deskripsi' => $agenda->deskripsi,
                'foto' => $agenda->foto ? asset('storage/prestasi/' . $agenda->foto) : null,
            ]
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul'     => 'sometimes|required|string|max:255',
            'kategori'  => 'sometimes|required|string|max:100',
            'tingkat'   => 'sometimes|required|in:Internasional,Nasional,Provinsi,Kabupaten/Kota,Universitas',
            'tahun'     => 'sometimes|required|digits:4|integer|min:2000',
            'mahasiswa' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $agenda = Prestasi::findOrFail($id);

        // update data selain foto
        $data = array_filter(
            $request->only([
                'judul',
                'kategori',
                'tingkat',
                'tahun',
                'mahasiswa',
                'deskripsi',
            ]),
            fn($v) => $v !== null
        );

        $agenda->update($data);

        // handle foto
        if ($request->hasFile('foto')) {

            if ($agenda->foto && Storage::disk('public')->exists('prestasi/' . $agenda->foto)) {
                Storage::disk('public')->delete('prestasi/' . $agenda->foto);
            }

            $file = $request->file('foto');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('prestasi', $namaFoto, 'public');

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
        $agenda = Prestasi::findOrFail($id);

        // JANGAN hapus gambar saat soft delete
        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipindahkan ke sampah'
        ]);
    }

    public function sampah()
    {
        $sampah = Prestasi::onlyTrashed()->get();

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah->map(function ($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'kategori' => $item->kategori,
                    'tingkat' => $item->tingkat,
                    'tahun' => $item->tahun,
                    'mahasiswa' => $item->mahasiswa,
                    'deskripsi' => $item->deskripsi,
                    'deleted_at' => $item->deleted_at,
                    'foto' => $item->foto
                        ? asset('storage/prestasi/' . $item->foto)
                        : null
                ];
            })
        ]);
    }

    public function restore($id)
    {
        $barang = Prestasi::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $agenda = Prestasi::withTrashed()->findOrFail($id);

        // Hapus file foto
        if ($agenda->foto && Storage::disk('public')->exists('prestasi/' . $agenda->foto)) {
            Storage::disk('public')->delete('prestasi/' . $agenda->foto);
        }

        $agenda->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus permanen'
        ]);
    }
}
