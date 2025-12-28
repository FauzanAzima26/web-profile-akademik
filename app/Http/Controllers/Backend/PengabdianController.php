<?php

namespace App\Http\Controllers\Backend;

use App\Models\Dosen;
use App\Models\Pengabdian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PengabdianController extends Controller
{
    public function index()
    {
        $namaDosen = Dosen::all();

        return view('Backend.PenelitianPengabdian.pengabdian.index', [
            'dosens' => $namaDosen
        ]);
    }

    public function getData()
    {
        $agenda = Pengabdian::with('dosen');

        return DataTables::of($agenda)
            ->addIndexColumn()

            ->addColumn('nama_dosen', function ($row) {
                return $row->dosen->nama ?? '-';
            })

            ->addColumn('foto', function ($row) {
                if ($row->foto_url) {
                    return '<img src="' . asset('storage/pengabdian/' . $row->foto_url) . '" width="60">';
                }
                return '-';
            })
            ->addColumn('aksi', function ($row) {
                $updateUrl = route('pengabdian.update', $row->id);
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
            ->rawColumns(['foto', 'aksi', 'nama_dosen'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'tahun'     => 'required|digits:4|integer|min:2000',
            'dosen_id'  => 'required|exists:dosens,id',
            'lokasi'    => 'nullable|string|max:255',
            'peserta'   => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto_url'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // upload gambar
        if ($request->hasFile('foto_url')) {
            $file = $request->file('foto_url');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pengabdian', $nama, 'public');
            $data['foto_url'] = $nama;
        }

        // simpan berita
        $agenda = Pengabdian::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $agenda
        ]);
    }

    public function show($id)
    {
        $agenda = Pengabdian::with('dosen')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => [
                'judul' => $agenda->judul,
                'tahun' => $agenda->tahun,
                'dosen_id' => $agenda->dosen_id,
                'nama_dosen' => $agenda->dosen->nama ?? '-',
                'lokasi' => $agenda->lokasi,
                'peserta' => $agenda->peserta,
                'deskripsi' => $agenda->deskripsi,
                'foto_url' => $agenda->foto_url ? asset('storage/pengabdian/' . $agenda->foto_url) : null,
                'status' => $agenda->status,
            ]
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul'     => 'sometimes|required|string|max:255',
            'tahun'     => 'sometimes|required|digits:4|integer|min:2000',
            'dosen_id'  => 'sometimes|required|exists:dosens,id',
            'lokasi'    => 'nullable|string|max:255',
            'peserta'   => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto_url'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $agenda = Pengabdian::findOrFail($id);

        // update data selain foto
        $data = array_filter(
            $request->only([
                'judul',
                'tahun',
                'dosen_id',
                'lokasi',
                'peserta',
                'deskripsi',
                'status',
            ]),
            fn($v) => $v !== null
        );

        $agenda->update($data);

        // handle foto
        if ($request->hasFile('foto_url')) {

            if ($agenda->foto_url && Storage::disk('public')->exists('pengabdian/' . $agenda->foto_url)) {
                Storage::disk('public')->delete('pengabdian/' . $agenda->foto_url);
            }

            $file = $request->file('foto_url');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pengabdian', $namaFoto, 'public');

            $agenda->update(['foto_url' => $namaFoto]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $agenda
        ]);
    }

    public function destroy($id)
    {
        $agenda = Pengabdian::findOrFail($id);

        // JANGAN hapus gambar saat soft delete
        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipindahkan ke sampah'
        ]);
    }

    public function sampah()
    {
        $sampah = Pengabdian::onlyTrashed()->with('dosen')->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul,
                    'tahun' => $item->tahun,
                    'dosen_id' => $item->dosen->nama,
                    'lokasi' => $item->lokasi,
                    'deleted_at' => $item->deleted_at,
                ];
            });

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah
        ]);
    }

    public function restore($id)
    {
        $barang = Pengabdian::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $agenda = Pengabdian::withTrashed()->findOrFail($id);

        // Hapus file foto
        if ($agenda->foto_url && Storage::disk('public')->exists('pengabdian/' . $agenda->foto_url)) {
            Storage::disk('public')->delete('pengabdian/' . $agenda->foto_url);
        }

        $agenda->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus permanen'
        ]);
    }
}
