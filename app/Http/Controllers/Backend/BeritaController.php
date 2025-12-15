<?php

namespace App\Http\Controllers\Backend;

use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriBerita;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriBerita::all();
        return view('Backend.ManagementKonten.berita.index', compact('kategori'));
    }

    public function getData()
    {
        $data = Berita::with('kategori')->orderByDesc('id')->get();

        return datatables()->of($data)
            ->addIndexColumn()

            ->addColumn('kategori', function ($row) {
                return '<span class="badge" style="background:' . ($row->kategori->warna ?? '#999') . '">'
                    . $row->kategori->nama .
                    '</span>';
            })

            ->addColumn('gambar', function ($row) {
                if (!$row->gambar) return '-';
                return '<img src="' . asset('storage/' . $row->gambar) . '" width="60">';
            })

            ->addColumn('status', function ($row) {
                return $row->is_published
                    ? '<span class="badge bg-success">Published</span>'
                    : '<span class="badge bg-secondary">Draft</span>';
            })

            ->addColumn('action', function ($row) {
                $updateUrl = route('backend.berita.update', $row->id);
                return '
                    <div class="d-flex gap-1">
                        <button class="btn btn-warning btn-sm editBerita"
                            data-id="' . $row->id . '"
                            data-update="' . $updateUrl . '">
                            <i class="bx bx-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm deleteBerita" data-id="' . $row->id . '">
                            <i class="bx bx-trash"></i>
                        </button>
                        <button class="btn btn-primary btn-sm detailBerita" data-id="' . $row->id . '">
                            <i class="bx bx-show"></i>
                        </button>
                    </div>
                    ';
            })

            ->rawColumns(['kategori', 'gambar', 'status', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'penulis' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->all();

        // upload gambar
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $data['slug'] = Str::slug($request->judul);

        // simpan berita
        $berita = Berita::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil ditambahkan',
            'data' => $berita
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $berita = Berita::with('kategori')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => [
                'judul' => $berita->judul,
                'kategori_id' => $berita->kategori_id,
                'kategori' => $berita->kategori->nama ?? '-',
                'penulis' => $berita->penulis,
                'gambar' => $berita->gambar ? asset('storage/' . $berita->gambar) : null,
                'konten' => $berita->konten,
                'status' => $berita->is_published ? 'Published' : 'Draft',
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
        // Validasi request
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required',
            'penulis' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Ambil data berita
        $berita = Berita::findOrFail($id);

        // Update field
        $berita->judul = $request->judul;
        $berita->kategori_id = $request->kategori_id;
        $berita->penulis = $request->penulis;
        $berita->konten = $request->konten;
        $berita->slug = Str::slug($request->judul);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }

            $berita->gambar = $request->file('gambar')->store('berita', 'public');
        }

        // Simpan perubahan
        $berita->save();

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil diperbarui',
            'data' => $berita
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus gambar jika ada
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil dihapus'
        ]);
    }

    public function list()
    {
        return response()->json([
            'data' => KategoriBerita::select('id', 'nama')->latest()->get()
        ]);
    }
}
