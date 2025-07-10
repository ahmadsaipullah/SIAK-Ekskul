<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsensiEskul;
use App\Models\PertemuanEskul;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AbsensiEskulController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pendaftaran = $user->pendaftaranEskul()->where('status', 'Disetujui')->first();

        if (!$pendaftaran) {
            return view('pages.siswa.absensi.kosong');
        }

        $eskul = $pendaftaran->eskul;

        // Ambil semua pertemuan
        $pertemuanList = PertemuanEskul::where('eskul_id', $eskul->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Ambil semua absensi siswa
        $absensiList = AbsensiEskul::where('user_id', $user->id)->get()->keyBy('pertemuan_id');

        // Gabungkan pertemuan dan absensi
        $absensis = $pertemuanList->map(function ($pertemuan) use ($absensiList) {
            $absen = $absensiList->get($pertemuan->id);

            return (object)[
                'pertemuan'    => $pertemuan,
                'pertemuan_id' => $pertemuan->id,
                'status'       => $absen->status ?? 'alfa',
                'foto'         => $absen->foto ?? null,
                'lokasi'       => $absen->lokasi ?? null,
            ];
        });

        return view('pages.siswa.absensi.index', compact('eskul', 'absensis'));
    }

 public function store(Request $request, $id)
{
    $request->validate([
        'lokasi' => 'required|string|max:255',
        'foto' => 'required|string',
    ]);

    $user = auth()->user();

    // Cegah absen dobel
    if (AbsensiEskul::where('user_id', $user->id)->where('pertemuan_id', $id)->exists()) {
        toast('Kamu sudah absen.', 'info');
        return back();
    }

    // Validasi & decode base64 image
    if (!preg_match('/^data:image\/(\w+);base64,/', $request->foto, $type)) {
        return back()->withErrors(['foto' => 'Format gambar tidak valid.']);
    }

    $imageData = substr($request->foto, strpos($request->foto, ',') + 1);
    $imageData = base64_decode($imageData);

    if ($imageData === false) {
        return back()->withErrors(['foto' => 'Gagal memproses gambar.']);
    }

    // Tentukan nama file dan simpan
    $fileName = 'absensi-foto/' . uniqid() . '.jpg';
    Storage::disk('public')->put($fileName, $imageData);

    // Simpan ke database
    AbsensiEskul::create([
        'user_id'       => $user->id,
        'pertemuan_id'  => $id,
        'status'        => 'hadir',
        'lokasi'        => $request->lokasi,
        'foto'          => $fileName,
    ]);

    toast('Absensi berhasil.', 'success');
    return back();
}


}
