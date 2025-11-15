<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaturan;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::first();
        return view('backend.pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_aplikasi' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
        ]);

        $pengaturan = Pengaturan::first();

        if (!$pengaturan) {
            return redirect()->back()->with('error', 'Data pengaturan belum tersedia.');
        }

        $pengaturan->update($validated);

        return redirect()->back()->with('success', 'Data pengaturan berhasil diperbarui!');
    }
}


