<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BidangKeahlian;
use Illuminate\Http\Request;

class BidangKeahlianController extends Controller
{
    public function index()
    {
        return view('Backend.ManagementAkademik.bidang_keahlian.index');
    }

    public function getData()
    {
        $data = BidangKeahlian::query();

        return datatables()->of($data)
            ->addIndexColumn()

            ->addColumn('aksi', function ($row) {
                $updateUrl = route('bidang.keahlian.update', $row->id);
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
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = $request->all();

        // simpan berita
        $agenda = BidangKeahlian::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $agenda
        ]);
    }

    public function show($id)
    {
        $agenda = BidangKeahlian::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => [
                'nama' => $agenda->nama,
                'deskripsi' => $agenda->deskripsi,
            ]
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'sometimes|required',
            'deskripsi' => 'nullable|string',
        ]);

        $agenda = BidangKeahlian::findOrFail($id);

        // Ambil hanya field yang dikirim & bukan null
        $data = array_filter(
            $request->only([
                'nama',
                'deskripsi'
            ]),
            fn($v) => $v !== null
        );

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
        $agenda = BidangKeahlian::findOrFail($id);

        // JANGAN hapus gambar saat soft delete
        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipindahkan ke sampah'
        ]);
    }

    public function sampah()
    {
        $sampah = BidangKeahlian::onlyTrashed()->get();

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah
        ]);
    }

    public function restore($id)
    {
        $barang = BidangKeahlian::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $agenda = BidangKeahlian::withTrashed()->findOrFail($id);

        $agenda->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus permanen'
        ]);
    }
}
