<?php

namespace App\Http\Controllers\Pelatih;

use App\Models\AbsensiEskul;
use Illuminate\Http\Request;
use App\Models\PertemuanEskul;
use App\Models\PendaftaranEskul;
use App\Http\Controllers\Controller;

class PelatihAbsensiController extends Controller
{
public function index()
{
    $user = auth()->user();

    // Ambil eskul berdasarkan pelatih_id yang sedang login
    $eskul = \App\Models\Eskul::where('pelatih_id', $user->id)->first();

    // Validasi jika tidak ada eskul yang ditemukan
    if (!$eskul) {
        return view('pages.pelatih.absensi.kosong');
    }

    $pertemuanList = PertemuanEskul::where('eskul_id', $eskul->id)
        ->orderBy('tanggal', 'desc')
        ->get();

    $pendaftarans = $eskul->pendaftarans()
        ->where('status', 'Disetujui')
        ->with('user')
        ->get();

    $absensiList = AbsensiEskul::whereIn('user_id', $pendaftarans->pluck('user_id'))
        ->whereIn('pertemuan_id', $pertemuanList->pluck('id'))
        ->get()
        ->groupBy('user_id');

    $dataAbsensi = $pendaftarans->map(function ($pendaftaran) use ($pertemuanList, $absensiList) {
        $siswa = $pendaftaran->user;
        $absensiSiswa = $absensiList->get($siswa->id, collect())->keyBy('pertemuan_id');

        $riwayat = $pertemuanList->map(function ($pertemuan) use ($absensiSiswa) {
            $absen = $absensiSiswa->get($pertemuan->id);
            return (object)[
                'pertemuan' => $pertemuan,
                'status' => $absen->status ?? 'alfa',
                'foto' => $absen->foto ?? null,
                'lokasi' => $absen->lokasi ?? null,
            ];
        });

        return (object)[
            'siswa' => $siswa,
            'riwayat' => $riwayat,
        ];
    });

    return view('pages.pelatih.absensi.index', compact('eskul', 'pertemuanList', 'dataAbsensi'));
}


}
