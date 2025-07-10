<?php

namespace App\Http\Controllers\Pelatih;

use App\Models\NilaiEskul;
use App\Models\Eskul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PelatihNilaiController extends Controller
{
    public function index()
    {
        $eskuls = Eskul::with(['pendaftarans.user', 'pendaftarans.nilaiEskul'])
            ->where('pelatih_id', auth()->id())
            ->get();

        return view('pages.pelatih.nilai.index', compact('eskuls'));
    }

    public function store(Request $request)
    {
        $userIds = $request->input('user_id');
        $eskulIds = $request->input('eskul_id');
        $nilais   = $request->input('nilai');
        $catatans = $request->input('catatan');

        for ($i = 0; $i < count($userIds); $i++) {
            if ($userIds[$i] && $eskulIds[$i] && $nilais[$i] !== null) {
                // Cek otorisasi pelatih
                $eskul = Eskul::where('id', $eskulIds[$i])
                              ->where('pelatih_id', auth()->id())
                              ->first();

                if ($eskul) {
                    NilaiEskul::updateOrCreate(
                        [
                            'user_id' => $userIds[$i],
                            'eskul_id' => $eskulIds[$i],
                        ],
                        [
                            'nilai' => $nilais[$i],
                            'catatan' => $catatans[$i] ?? null,
                        ]
                    );
                }
            }
        }

        toast('success', 'Semua nilai berhasil disimpan.');
        return back();
    }

    public function edit($id)
    {
        $nilaiEskul = NilaiEskul::with(['user', 'eskul'])->findOrFail($id);

        // Cek otorisasi pelatih
        if ($nilaiEskul->eskul->pelatih_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('pages.pelatih.nilai.edit', compact('nilaiEskul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        $nilai = NilaiEskul::with('eskul')->findOrFail($id);

        // Cek otorisasi pelatih
        if ($nilai->eskul->pelatih_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $nilai->update([
            'nilai' => $request->nilai,
            'catatan' => $request->catatan,
        ]);

        toast('success', 'Nilai berhasil diperbarui.');
        return redirect()->route('pelatih.nilai.index');
    }

    public function destroy($id)
    {
        $nilai = NilaiEskul::with('eskul')->findOrFail($id);

        // Cek otorisasi pelatih
        if ($nilai->eskul->pelatih_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $nilai->delete();

        toast('success', 'Nilai berhasil dihapus.');
        return redirect()->route('pelatih.nilai.index');
    }
}
