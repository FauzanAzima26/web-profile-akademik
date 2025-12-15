<?php

namespace App\Http\Controllers\Backend;

use App\Models\Agenda;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AgendaController extends Controller
{
    public function index()
    {
        return view('Backend.ManagementKonten.agenda.index');
    }

    public function getData()
    {
        $agenda = Agenda::query();

        return DataTables::of($agenda)
            ->addIndexColumn()
            ->addColumn('gambar', function ($row) {
                if ($row->gambar) {
                    return '<img src="' . asset('storage/agenda/' . $row->gambar) . '" width="60">';
                }
                return '-';
            })
            ->addColumn('aksi', function ($row) {
                $updateUrl = route('backend.agenda.update', $row->id);
                return '
                <div class="d-flex gap-1">
                    <button class="btn btn-info btn-sm detailAgenda" data-id="' . $row->id . '">
                        <i class="bx bx-show"></i>
                    </button>
                    <button class="btn btn-warning btn-sm editAgenda"
                        data-id="' . $row->id . '"
                        data-update="' . $updateUrl . '">
                        <i class="bx bx-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm deleteAgenda" data-id="' . $row->id . '">
                        <i class="bx bx-trash"></i>
                    </button>
                    </div>
            ';
            })
            ->rawColumns(['gambar', 'aksi'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        // upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('agenda', $nama, 'public');
            $data['gambar'] = $nama;
        }


        $data['slug'] = Str::slug($request->judul);

        // simpan berita
        $agenda = Agenda::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Agenda berhasil ditambahkan',
            'data' => $agenda
        ]);
    }

    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => [
                'judul' => $agenda->judul,
                'tanggal_mulai' => $agenda->tanggal_mulai,
                'tanggal_selesai' => $agenda->tanggal_selesai,
                'gambar' => $agenda->gambar ? asset('storage/agenda/' . $agenda->gambar) : null,
                'lokasi' => $agenda->lokasi,
                'deskripsi' => $agenda->deskripsi,
            ]
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'sometimes|required',
            'tanggal_mulai' => 'sometimes|required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $agenda = Agenda::findOrFail($id);

        // Ambil hanya field yang dikirim & bukan null
        $data = array_filter(
            $request->only([
                'judul',
                'tanggal_mulai',
                'tanggal_selesai',
                'lokasi',
                'deskripsi'
            ]),
            fn($v) => $v !== null
        );

        // Update data teks
        $agenda->update($data);

        // Handle gambar terpisah
        if ($request->hasFile('gambar')) {

            if ($agenda->gambar && Storage::disk('public')->exists('agenda/' . $agenda->gambar)) {
                Storage::disk('public')->delete('agenda/' . $agenda->gambar);
            }

            $file = $request->file('gambar');
            $nama = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('agenda', $nama, 'public');

            $agenda->update(['gambar' => $nama]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Agenda berhasil diperbarui',
            'data' => $agenda
        ]);
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);

        // Hapus gambar jika ada
        if ($agenda->gambar && Storage::disk('public')->exists($agenda->gambar)) {
            Storage::disk('public')->delete('agenda/' . $agenda->gambar);
        }

        $agenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil dihapus'
        ]);
    }

    // Ambil semua data yang dihapus (Sampah)
    public function sampah()
    {
        $sampah = Agenda::onlyTrashed()
            ->get();

        return response()->json([
            'message' => 'Berhasil mengambil data sampah',
            'data' => $sampah
        ]);
    }

    // Restore data dari sampah
    public function restore($id)
    {
        $barang = Agenda::withTrashed()->findOrFail($id);

        $barang->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda berhasil dipulihkan'
        ]);
    }

    // Hapus permanen
    public function forceDelete($id)
    {
        $agenda = Agenda::withTrashed()->findOrFail($id);

        // aman karena tidak dipakai transaksi
        $agenda->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dihapus permanen'
        ]);
    }
}
