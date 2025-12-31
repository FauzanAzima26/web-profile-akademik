<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Galeri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategori = $request->get('kategori');

        $galeri = Galeri::query()
            ->when($kategori, fn($q) => $q->where('kategori', $kategori))
            ->where('status', true)
            ->latest()
            ->paginate(9)
            ->withQueryString(); // agar pagination tetap membawa filter

        return view('frontend.galery.index', compact('galeri', 'kategori'));
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
