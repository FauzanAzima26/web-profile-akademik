<?php

namespace App\Http\Controllers\Backend;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\BidangKeahlian;
use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Backend.Galeri.index');
    }

    public function getData()
    {
        $agenda = Galeri::query();

        return DataTables::of($agenda)
            ->addIndexColumn()

            ->addColumn('status', function ($row) {
                return $row->status
                    ? '<span class="badge bg-success">Aktif</span>'
                    : '<span class="badge bg-secondary">Nonaktif</span>';
            })

            ->addColumn('gambar', function ($row) {
                if ($row->gambar) {
                    return '
                <img src="' . asset('storage/galeri/' . $row->gambar) . '"
                     class="img-thumbnail preview-galeri"
                     data-img="' . asset('storage/galeri/' . $row->gambar) . '"
                     style="width:60px; cursor:pointer;">
                ';
                }
                return '-';
            })
            ->addColumn('aksi', function ($row) {
                $updateUrl = route('dosen.update', $row->id);
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
            ->rawColumns(['gambar', 'aksi', 'status'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:150',
            'kategori'  => 'required|in:kegiatan,fasilitas,akademik,lainnya',
            'status'    => 'required|boolean',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        // upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('galeri', $nama, 'public');
            $data['gambar'] = $nama;
        }

        // simpan berita
        $agenda = Galeri::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $agenda
        ]);
    }

    public function show($id)
    {
        $agenda = Galeri::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => [
                'judul' => $agenda->judul,
                'deskripsi' => $agenda->deskripsi,
                'kategori' => $agenda->kategori,
                'status' => $agenda->status,
                'gambar' => $agenda->gambar ? asset('storage/galeri/' . $agenda->gambar) : null,
            ]
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul'     => 'required|string|max:150',
            'kategori'  => 'required|in:kegiatan,fasilitas,akademik,lainnya',
            'status'    => 'required|boolean',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $agenda = Galeri::findOrFail($id);

        // update data selain foto
        $data = array_filter(
            $request->only([
                'judul',
                'deskripsi',
                'kategori',
                'status',
            ]),
            fn($v) => $v !== null
        );

        $agenda->update($data);

        // handle foto
        if ($request->hasFile('gambar')) {

            if ($agenda->gambar && Storage::disk('public')->exists('galeri/' . $agenda->gambar)) {
                Storage::disk('public')->delete('galeri/' . $agenda->gambar);
            }

            $file = $request->file('gambar');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('galeri', $namaFoto, 'public');

            $agenda->update(['gambar' => $namaFoto]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $agenda
        ]);
    }

    public function destroy($id)
    {
        $agenda = Galeri::findOrFail($id);

        // JANGAN hapus gambar saat soft delete
        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipindahkan ke sampah'
        ]);
    }

    public function sampah()
    {
        $sampah = Galeri::onlyTrashed()->get();

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah->map(function ($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'kategori' => $item->kategori,
                    'deskripsi' => $item->deskripsi,
                    'deleted_at' => $item->deleted_at,
                    'gambar' => $item->gambar
                        ? asset('storage/galeri/' . $item->gambar)
                        : null
                ];
            })
        ]);
    }

    public function restore($id)
    {
        $barang = Galeri::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $agenda = Galeri::withTrashed()->findOrFail($id);

        // Hapus file foto
        if ($agenda->gambar && Storage::disk('public')->exists('galeri/' . $agenda->gambar)) {
            Storage::disk('public')->delete('galeri/' . $agenda->gambar);
        }

        $agenda->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus permanen'
        ]);
    }
}
