<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Eskul;
use Illuminate\Http\Request;

class JadwalEskulController extends Controller
{
    // Menampilkan daftar eskul yang disetujui
    public function index()
    {
        $user = auth()->user();

        $eskuls = $user->pendaftaranEskul()
            ->where('status', 'Disetujui')
            ->with('eskul') // load nama, logo, dll
            ->get()
            ->pluck('eskul'); // kita hanya butuh data eskul-nya saja

        return view('pages.siswa.jadwal.index', compact('eskuls'));
    }

    // Menampilkan jadwal dari satu eskul tertentu
    public function show($id)
    {
        $eskul = Eskul::with('jadwals')->findOrFail($id);

        return view('pages.siswa.jadwal.show', compact('eskul'));
    }
}
