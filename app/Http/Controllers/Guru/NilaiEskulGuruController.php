<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Eskul;

class NilaiEskulGuruController extends Controller
{
    public function index()
    {
        // Ambil semua eskul beserta pendaftarannya dan user-nya serta nilai-nya
        $eskuls = Eskul::with(['pendaftarans.user', 'pendaftarans.nilaiEskul'])
                    ->whereHas('pendaftarans') // hanya eskul yang punya pendaftaran
                    ->get();

        return view('pages.guru.nilai.index', compact('eskuls'));
    }
}
