<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JadwalKuliah;
use App\Models\Kurikulum;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class AkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mataKuliah = MataKuliah::all();
        $kurikulum = Kurikulum::latest('tahun')->first();
        $jadwal = JadwalKuliah::with(['mataKuliah', 'dosen'])->orderBy('hari')->orderBy('jam_mulai')->get();

        return view('Frontend.Akademik.index', [
            'mataKuliah' => $mataKuliah,
            'kurikulum' => $kurikulum,
            'jadwal' =>$jadwal,
        ]);
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
