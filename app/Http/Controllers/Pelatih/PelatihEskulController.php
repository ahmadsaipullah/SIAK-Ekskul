<?php
namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use App\Models\Eskul;
use App\Models\User;
use App\Models\PendaftaranEskul;
use Illuminate\Http\Request;

class PelatihEskulController extends Controller
{
 public function index()
{
    $eskuls = Eskul::where('pelatih_id', auth()->id())
        ->whereHas('pendaftarans') // hanya eskul yang punya pendaftaran
        ->get();

    return view('pages.pelatih.eskul.index', compact('eskuls'));
}


    public function siswa($id)
    {
        $eskul = Eskul::findOrFail($id);
        $pendaftar = PendaftaranEskul::with('user')->where('eskul_id', $id)->get();

        return view('pages.pelatih.eskul.siswa', compact('eskul', 'pendaftar'));
    }

public function approve($eskulId, $userId)
{
    $eskul = Eskul::findOrFail($eskulId);

    // Validasi kepemilikan eskul
    if ($eskul->pelatih_id != auth()->id()) {
        abort(403, 'Anda tidak berwenang menyetujui pendaftaran ini.');
    }

    $pendaftaran = PendaftaranEskul::where('eskul_id', $eskulId)
                    ->where('user_id', $userId)
                    ->firstOrFail();

    $pendaftaran->update(['status' => 'Disetujui']);
    toast('Pendaftaran disetujui.', 'success');
    return back();
}

public function reject($eskulId, $userId)
{
    $eskul = Eskul::findOrFail($eskulId);

    // Validasi kepemilikan eskul
    if ($eskul->pelatih_id != auth()->id()) {
        abort(403, 'Anda tidak berwenang menolak pendaftaran ini.');
    }

    $pendaftaran = PendaftaranEskul::where('eskul_id', $eskulId)
                    ->where('user_id', $userId)
                    ->firstOrFail();

    $pendaftaran->update(['status' => 'Ditolak']);
    toast('Pendaftaran ditolak.', 'info');
    return back();
}

}
