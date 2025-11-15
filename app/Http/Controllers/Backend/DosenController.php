<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosens = dosen::all();
        return view('backend.dosen.index', compact('dosens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:20',
            'jabatan' => 'nullable|string|max:255',
            'bidang_keahlian' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['nama', 'nip', 'jabatan', 'bidang_keahlian', 'pendidikan', 'email', 'telepon']);
        $data['user_id'] = auth()->id() ?? 1; // Default to 1 if not authenticated

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        dosen::create($data);

        return redirect()->route('backend.dosen.index')->with('success', 'Dosen created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(dosen $dosen)
    {
        return view('backend.dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(dosen $dosen)
    {
        return view('backend.dosen.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, dosen $dosen)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:20',
            'jabatan' => 'nullable|string|max:255',
            'bidang_keahlian' => 'nullable|string|max:255',
            'pendidikan' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['nama', 'nip', 'jabatan', 'bidang_keahlian', 'pendidikan', 'email', 'telepon']);

        if ($request->hasFile('foto')) {
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $data['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        $dosen->update($data);

        return redirect()->route('backend.dosen.index')->with('success', 'Dosen updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(dosen $dosen)
    {
        if ($dosen->foto) {
            Storage::disk('public')->delete($dosen->foto);
        }
        $dosen->delete();

        return redirect()->route('backend.dosen.index')->with('success', 'Dosen deleted successfully.');
    }
}
