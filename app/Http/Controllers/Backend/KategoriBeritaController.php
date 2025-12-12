<?php

namespace App\Http\Controllers\Backend;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\KategoriBerita;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class KategoriBeritaController extends Controller
{
    /**
     * DATATABLES KATEGORI
     */
    public function data()
    {
        $kategori = KategoriBerita::orderBy('id', 'DESC')->get();

        return DataTables::of($kategori)
            ->addIndexColumn()

            // kolom warna
            ->addColumn('warna', function ($k) {
                return '<div style="width: 40px; height: 20px; background: ' . $k->warna . '"></div>';
            })

            // kolom aksi
            ->addColumn('action', function ($k) {
                return '
                    <button class="btn btn-danger btn-sm deleteKategori" data-id="' . $k->id . '">Hapus</button>
                ';
            })

            ->rawColumns(['warna', 'action'])
            ->make(true);
    }

    /**
     * SIMPAN / UPDATE KATEGORI
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|max:100',
            'warna' => 'required'
        ]);

        // jika ada id, maka update
        $kategori = KategoriBerita::updateOrCreate(
            ['id' => $request->id],
            [
                'nama'  => $request->nama,
                'warna' => $request->warna
            ]
        );

        return response()->json([
            'status'  => true,
            'message' => $request->id ? 'Kategori berhasil diperbarui' : 'Kategori berhasil ditambahkan',
            'data'    => $kategori
        ]);
    }

    /**
     * HAPUS KATEGORI
     */
    public function destroy($id)
    {
        $kategori = KategoriBerita::findOrFail($id);
        $kategori->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}
