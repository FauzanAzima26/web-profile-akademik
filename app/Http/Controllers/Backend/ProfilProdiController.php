<?php

namespace App\Http\Controllers\Backend;

use App\Models\ProfilProdi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ProfilProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Backend.ManagementKonten.profil-prodi.index');
    }

    public function getData()
    {
        $agenda = ProfilProdi::query();

        return DataTables::of($agenda)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                $updateUrl = route('backend.profil.prodi.update', $row->id);
                return '
                <div class="d-flex gap-1">
                    <button class="btn btn-warning btn-sm editProfil"
                        data-id="' . $row->id . '"
                        data-update="' . $updateUrl . '">
                        <i class="bx bx-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm deleteProfil" data-id="' . $row->id . '">
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
            'nama_prodi' => 'required',
            'akreditasi' => 'required',
            'tahun_berdiri' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'tujuan' => 'required',
        ]);

        $data = $request->all();

        // simpan berita
        $profil = ProfilProdi::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Profil berhasil ditambahkan',
            'data' => $profil
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $agenda = ProfilProdi::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => [
                'nama_prodi' => $agenda->nama_prodi,
                'tahun_berdiri' => $agenda->tahun_berdiri,
                'akreditasi' => $agenda->akreditasi,
                'visi' => $agenda->visi,
                'misi' => $agenda->misi,
                'tujuan' => $agenda->tujuan,
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_prodi' => 'required',
            'akreditasi' => 'required',
            'tahun_berdiri' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'tujuan' => 'required',
        ]);

        $agenda = ProfilProdi::findOrFail($id);

        // Ambil hanya field yang dikirim & bukan null
        $data = array_filter(
            $request->only([
                'nama_prodi',
                'akreditasi',
                'tahun_berdiri',
                'visi',
                'misi',
                'tujuan'
            ]),
            fn($v) => $v !== null
        );

        // Update data teks
        $agenda->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Profil berhasil diperbarui',
            'data' => $agenda
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $agenda = ProfilProdi::findOrFail($id);

        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Profil berhasil dihapus'
        ]);
    }

    public function sampah()
    {
        $sampah = ProfilProdi::onlyTrashed()
            ->get();

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah
        ]);
    }

    public function restore($id)
    {
        $barang = ProfilProdi::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $agenda = ProfilProdi::withTrashed()->findOrFail($id);

        // aman karena tidak dipakai transaksi
        $agenda->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus permanen'
        ]);
    }
}
