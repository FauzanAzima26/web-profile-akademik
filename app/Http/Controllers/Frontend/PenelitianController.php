<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Penelitian;
use App\Models\Pengabdian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jenis = $request->jenis;
        $tahun = $request->tahun;

        $penelitian = Penelitian::with('dosen')
            ->when($tahun, fn($q) => $q->where('tahun', $tahun))
            ->where('status', 'publish')
            ->get();

        $pengabdian = Pengabdian::with('dosen')
            ->when($tahun, fn($q) => $q->where('tahun', $tahun))
            ->where('status', 'publish')
            ->get();

        return view('frontend.penelitian.index', compact(
            'penelitian',
            'pengabdian',
            'jenis',
            'tahun'
        ));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
