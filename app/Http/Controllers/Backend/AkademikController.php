<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Akademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AkademikController extends Controller
{
    // Tampilkan semua data akademik
    public function index()
    {
        $akademiks = Akademik::latest()->get();
        return view('backend.akademik.index', compact('akademiks'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        return view('backend.akademik.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads/akademik', 'public');
        }

        Akademik::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'file' => $filePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('backend.akademik.index')->with('success', 'Data berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $akademik = Akademik::findOrFail($id);
        return view('backend.akademik.edit', compact('akademik'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $akademik = Akademik::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,png|max:2048',
        ]);

        $filePath = $akademik->file;
        if ($request->hasFile('file')) {
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('file')->store('uploads/akademik', 'public');
        }

        $akademik->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'file' => $filePath,
        ]);

        return redirect()->route('backend.akademik.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Hapus data (soft delete)
    public function destroy($id)
    {
        $akademik = Akademik::findOrFail($id);
        if ($akademik->file && Storage::disk('public')->exists($akademik->file)) {
            Storage::disk('public')->delete($akademik->file);
        }
        $akademik->delete();

        return redirect()->route('backend.akademik.index')->with('success', 'Data berhasil dihapus!');
    }
}
