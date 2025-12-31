<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Agenda;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class BeritaController extends Controller
{

    public function index(Request $request)
    {
        $kategori = $request->kategori;
        $tahun = $request->tahun;
        $perPage = 6;

        // Query dasar
        if ($kategori === 'berita') {
            $query = Berita::where('is_published', true);

            if ($tahun) {
                $query->whereYear('published_at', $tahun);
            }

            $items = $query->latest('published_at')->paginate($perPage);
        } elseif ($kategori === 'agenda') {
            $query = Agenda::query();

            if ($tahun) {
                $query->whereYear('tanggal_mulai', $tahun);
            }

            $items = $query->latest('tanggal_mulai')->paginate($perPage);
        } else {
            // Gabungkan berita dan agenda
            $berita = Berita::where('is_published', true);
            $agenda = Agenda::query();

            if ($tahun) {
                $berita->whereYear('published_at', $tahun);
                $agenda->whereYear('tanggal_mulai', $tahun);
            }

            $beritaItems = $berita->latest('published_at')->get();
            $agendaItems = $agenda->latest('tanggal_mulai')->get();

            // Gabungkan dan urutkan
            $combined = $beritaItems->concat($agendaItems)
                ->sortByDesc(function ($item) {
                    return $item instanceof Berita
                        ? $item->published_at
                        : $item->tanggal_mulai;
                });

            // Manual pagination
            $page = $request->page ?? 1;
            $paginatedItems = new \Illuminate\Pagination\LengthAwarePaginator(
                $combined->forPage($page, $perPage),
                $combined->count(),
                $perPage,
                $page,
                [
                    'path' => $request->url(),
                    'query' => $request->query()
                ]
            );

            $items = $paginatedItems;
        }

        return view('frontend.berita.index', [
            'items' => $items
        ]);
    }
}
