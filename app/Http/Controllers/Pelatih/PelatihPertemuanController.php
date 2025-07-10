<?php


namespace App\Http\Controllers\Pelatih;

use App\Models\Eskul;
use App\Models\PertemuanEskul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PelatihPertemuanController extends Controller
{
    public function index()
    {
        $eskuls = Eskul::with('pertemuans')
            ->where('pelatih_id', auth()->id())
            ->get();

        return view('pages.pelatih.pertemuan.index', compact('eskuls'));
    }

    public function create()
    {
        $eskuls = Eskul::where('pelatih_id', auth()->id())
            ->whereHas('pendaftarans', function ($query) {
                $query->where('status', 'Disetujui');
            })
            ->get();

        return view('pages.pelatih.pertemuan.create', compact('eskuls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'eskul_id' => 'required',
            'tanggal' => 'required|date',
            'materi' => 'required',
        ]);

        PertemuanEskul::create($request->all());

        toast('Pertemuan berhasil ditambahkan.', 'success');
        return redirect()->route('pertemuan.index');
    }

    public function edit($id)
    {
        $pertemuan = PertemuanEskul::findOrFail($id);
        return view('pages.pelatih.pertemuan.edit', compact('pertemuan'));
    }

    public function update(Request $request, $id)
    {
        $pertemuan = PertemuanEskul::findOrFail($id);
        $pertemuan->update($request->all());

        toast('Pertemuan berhasil diperbarui.', 'success');
        return redirect()->route('pertemuan.index');
    }

    public function editJumlah($id)
    {
        $eskul = Eskul::where('pelatih_id', auth()->id())->findOrFail($id);
        return view('pages.pelatih.pertemuan.edit-jumlah', compact('eskul'));
    }

    public function updateJumlah(Request $request, $id)
    {
        $request->validate([
            'jumlah_pertemuan' => 'required|integer|min:1',
        ]);

        $eskul = Eskul::where('pelatih_id', auth()->id())->findOrFail($id);
        $eskul->jumlah_pertemuan = $request->jumlah_pertemuan;
        $eskul->save();

        toast('Jumlah pertemuan berhasil diperbarui.', 'success');
        return redirect()->route('pertemuan.index');
    }
}
