<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategori = $request->kategori;
        $tahun = $request->tahun;

        $prestasi = Prestasi::query()
            ->when($kategori, function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            })
            ->when($tahun, function ($q) use ($tahun) {
                $q->where('tahun', $tahun);
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('frontend.prestasi.index', compact(
            'prestasi',
            'kategori',
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
