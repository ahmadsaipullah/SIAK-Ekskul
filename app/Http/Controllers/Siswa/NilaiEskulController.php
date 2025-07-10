<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NilaiEskulController extends Controller
{
     public function index()
    {
        $nilais = auth()->user()->nilaiEskul()->with('eskul')->get();
        return view('pages.siswa.nilai.index', compact('nilais'));
    }
}
