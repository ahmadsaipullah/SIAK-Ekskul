<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Eskul;
use App\Models\PendaftaranEskul;
use Illuminate\Http\Request;

class SiswaEskulController extends Controller
{
    public function index()
    {
        $eskuls = Eskul::with('pelatih')->get();
        return view('pages.siswa.eskul.index', compact('eskuls'));
    }

    public function show($id)
    {
        $eskul = Eskul::with('pelatih')->findOrFail($id);
        return view('pages.siswa.eskul.show', compact('eskul'));
    }

  public function daftar($id)
{
    $user = auth()->user();

    // Hitung jumlah eskul yang sudah disetujui
    $jumlahDisetujui = PendaftaranEskul::where('user_id', $user->id)
        ->where('status', 'Disetujui')
        ->count();

    // Jika sudah mencapai batas maksimal 2 eskul
    if ($jumlahDisetujui >= 2) {
        toast('Kamu sudah terdaftar maksimal 2 eskul yang disetujui.', 'info');
        return redirect()->back();
    }

    $cek = PendaftaranEskul::where('user_id', $user->id)->where('eskul_id', $id)->first();

    if ($cek) {
        // Jika statusnya ditolak atau pending, update ulang jadi pending
        $cek->update([
            'status' => 'Pending'
        ]);
    } else {
        // Daftar baru
        PendaftaranEskul::create([
            'user_id' => $user->id,
            'eskul_id' => $id,
            'status' => 'Pending'
        ]);
    }

    toast('Pendaftaran berhasil, menunggu persetujuan pelatih.', 'success');
    return redirect()->route('siswa.eskul.index');
}

}

