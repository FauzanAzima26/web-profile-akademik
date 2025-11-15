<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Akademik;

class AkademikController extends Controller
{
    public function index()
    {
        $akademiks = Akademik::all();
        return view('frontend.akademik.index', compact('akademiks'));
    }
}
