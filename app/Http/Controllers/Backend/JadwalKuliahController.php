<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\JadwalKuliah;
use App\Models\MataKuliah;
use Yajra\DataTables\Facades\DataTables;

class JadwalKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::all();
        $dosen = Dosen::all();

        return view('Backend.ManagementAkademik.jadwal_kuliah.index', [
            'mata_kuliah' => $mataKuliah,
            'dosen' => $dosen
        ]);
    }

    public function getData()
    {
        $kurikulum = JadwalKuliah::with(['MataKuliah', 'dosen']);

        return DataTables::of($kurikulum)
            ->addIndexColumn()

            ->addColumn('mata_kuliah', function ($row) {
                return $row->MataKuliah->nama ?? '-';
            })

            ->addColumn('dosen', function ($row) {
                return $row->dosen->nama ?? '-';
            })

            ->addColumn('jam', function ($row) {
                $mulai = date('H:i', strtotime($row->jam_mulai));
                $selesai = date('H:i', strtotime($row->jam_selesai));

                return $mulai . ' - ' . $selesai;
            })

            ->addColumn('aksi', function ($row) {
                $updateUrl = route('jadwal.kuliah.update', $row->id);
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

            ->rawColumns(['aksi', 'mata_kuliah', 'dosen', 'jam'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id'       => 'required|exists:dosens,id',
            'hari'           => 'required|string|max:20',
            'jam_mulai'      => 'required|date_format:H:i',
            'jam_selesai'    => 'required|date_format:H:i|after:jam_mulai',
            'ruangan'        => 'required|string|max:100',
        ]);

        // ⛔ JANGAN PAKE $request->all()
        // ambil field teks saja
        $data = $request->all();

        $agenda = JadwalKuliah::create($data);

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil ditambahkan',
            'data'    => $agenda
        ]);
    }

    public function show($id)
    {
        $agenda = JadwalKuliah::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $agenda
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'mata_kuliah_id' => 'sometimes|required|exists:mata_kuliah,id',
            'dosen_id'       => 'sometimes|required|exists:dosens,id',
            'hari'           => 'sometimes|required|string|max:20',
            'jam_mulai'      => 'sometimes|required|date_format:H:i',
            'jam_selesai'    => 'sometimes|required|date_format:H:i|after:jam_mulai',
            'ruangan'        => 'sometimes|required|string|max:100',
        ]);

        // 2️⃣ Ambil data kurikulum
        $kurikulum = JadwalKuliah::findOrFail($id);

        // 3️⃣ Ambil field teks saja
        $data = $request->all();

        // 5️⃣ Update data
        $kurikulum->update($data);

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil diperbarui',
            'data'    => $kurikulum
        ]);
    }

    public function destroy($id)
    {
        $agenda = JadwalKuliah::findOrFail($id);

        // JANGAN hapus gambar saat soft delete
        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipindahkan ke sampah'
        ]);
    }

    public function sampah()
    {
        $sampah = JadwalKuliah::onlyTrashed()->with(['MataKuliah', 'dosen'])->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'mata_kuliah' => $item->MataKuliah->nama ?? '-',
                    'dosen' => $item->dosen->nama ?? '-',
                    'jam' => $item->jam_mulai . ' - ' . $item->jam_selesai,
                    'hari' => $item->hari,
                    'ruangan' => $item->ruangan,
                    'deleted_at' => $item->deleted_at
                ];
            });

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah
        ]);
    }

    public function restore($id)
    {
        $barang = JadwalKuliah::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    public function forceDelete($id)
    {
        $kurikulum = JadwalKuliah::withTrashed()->findOrFail($id);

        // 🔥 HAPUS DATA PERMANEN
        $kurikulum->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus permanen'
        ]);
    }
}
