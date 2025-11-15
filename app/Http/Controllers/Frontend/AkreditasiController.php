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
            while (($data = fgetcsv($file, 1000, ';')) !== false) { // ← delimiter pakai ;
                $rows[] = $data;
            }
            fclose($file);
        }

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
