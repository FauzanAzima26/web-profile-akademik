<?php

namespace App\Http\Controllers\Backend;

use datatables;
use App\Models\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Backend.ManagementKonten.berita');
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
                return '
                    <button class="btn btn-sm btn-warning edit" data-id="' . $row->id . '">Edit</button>
                    <button class="btn btn-sm btn-danger delete" data-id="' . $row->id . '">Hapus</button>
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
