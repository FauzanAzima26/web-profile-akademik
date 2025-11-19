<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AkreditasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $filePath = storage_path('app/data/akreditasi_unimal.csv');

        if (!file_exists($filePath)) {
            dd("File tidak ditemukan di: " . $filePath);
        }

        $rows = [];
        if (($file = fopen($filePath, 'r')) !== false) {

            while (($data = fgetcsv($file, 2000, ';')) !== false) {

                // Skip baris kosong
                if (count(array_filter($data)) === 0) {
                    continue;
                }

                $rows[] = $data;
            }

            fclose($file);
        }

        // ============================
        // 1) Buang header kosong
        // ============================
        $rows = array_filter($rows, function ($row) {
            return count(array_filter($row)) > 0;
        });

        $rows = array_values($rows);

        // ============================
        // 2) Ambil header asli
        // ============================
        $header = $rows[0];

        // ============================
        // 3) Buang header duplikat (baris yang sama persis dg header)
        // ============================
        $cleaned = [];
        foreach ($rows as $i => $row) {
            if ($i === 0) { // header asli jangan dibuang
                $cleaned[] = $row;
                continue;
            }

            if ($row === $header) { // header ganda
                continue;
            }

            $cleaned[] = $row;
        }

        $rows = array_values($cleaned);

        return view('Frontend.Profil.akreditasi', compact('rows'));
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
