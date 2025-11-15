<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = dosen::all();
        return view('frontend.dosen.index', compact('dosens'));
    }
}
