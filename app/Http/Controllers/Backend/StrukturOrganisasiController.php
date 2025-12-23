<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Backend.ManagementKonten.struktur-organisasi.index');
    }

    public function getData()
    {
        $agenda = StrukturOrganisasi::query();

        return DataTables::of($agenda)
            ->addIndexColumn()
            ->addColumn('foto', function ($row) {
                if ($row->foto) {
                    return '<img src="' . asset('storage/Struktur-Organisasi/' . $row->foto) . '" width="60">';
                }
                return '-';
            })
            ->addColumn('aksi', function ($row) {
                $updateUrl = route('struktur.organisasi.update', $row->id);
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
            'jabatan' => 'required',
            'nama' => 'required',
            'urutan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        // upload gambar
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('Struktur-Organisasi', $nama, 'public');
            $data['foto'] = $nama;
        }

        // simpan berita
        $agenda = StrukturOrganisasi::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $agenda
        ]);
    }

    public function show($id)
    {
        $agenda = StrukturOrganisasi::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => [
                'nama' => $agenda->nama,
                'jabatan' => $agenda->jabatan,
                'urutan' => $agenda->urutan,
                'foto' => $agenda->foto ? asset('storage/Struktur-Organisasi/' . $agenda->foto) : null,
            ]
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'jabatan' => 'sometimes|required|string|max:255',
            'nama'    => 'sometimes|required|string|max:255',
            'urutan'  => 'sometimes|nullable|integer|min:1',
            'foto'    => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $agenda = StrukturOrganisasi::findOrFail($id);

        // Ambil hanya field yang dikirim & bukan null
        $data = array_filter(
            $request->only([
                'nama',
                'jabatan',
                'urutan',
            ]),
            fn($v) => $v !== null
        );

        // Update data teks
        $agenda->update($data);

        // Handle gambar terpisah
        if ($request->hasFile('foto')) {

            if ($agenda->foto && Storage::disk('public')->exists('Struktur-Organisasi/' . $agenda->foto)) {
                Storage::disk('public')->delete('Struktur-Organisasi/' . $agenda->foto);
            }

            $file = $request->file('foto');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('Struktur-Organisasi', $nama, 'public');

            $agenda->update(['foto' => $nama]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $agenda
        ]);
    }

    public function destroy($id)
    {
        $agenda = StrukturOrganisasi::findOrFail($id);

        // JANGAN hapus gambar saat soft delete
        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipindahkan ke sampah'
        ]);
    }

    // Ambil semua data yang dihapus (Sampah)
    public function sampah()
    {
        $sampah = StrukturOrganisasi::onlyTrashed()->get();

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'jabatan' => $item->jabatan,
                    'urutan' => $item->urutan,
                    'deleted_at' => $item->deleted_at,
                    'foto' => $item->foto
                        ? asset('storage/Struktur-Organisasi/' . $item->foto)
                        : null
                ];
            })
        ]);
    }

    // Restore data dari sampah
    public function restore($id)
    {
        $barang = StrukturOrganisasi::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    // Hapus permanen
    public function forceDelete($id)
    {
        $agenda = StrukturOrganisasi::withTrashed()->findOrFail($id);

        // Hapus file foto
        if ($agenda->foto && Storage::disk('public')->exists('Struktur-Organisasi/' . $agenda->foto)) {
            Storage::disk('public')->delete('Struktur-Organisasi/' . $agenda->foto);
        }

        $agenda->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus permanen'
        ]);
    }
}
