<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Eskul;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EskulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eskuls = Eskul::with('pelatih')->get();
        return view('pages.admin.eskul.index', compact('eskuls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelatih = User::whereHas('level', function ($query) {
            $query->where('name', 'Pelatih Eskul');
        })->get();

        return view('pages.admin.eskul.create', compact('pelatih'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_eskul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'pelatih_id' => 'required|exists:users,id',
            'tahun_ajaran' => 'required|string|max:20',
            'jumlah_pertemuan' => 'required|integer|min:1',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pelatih = User::find($request->pelatih_id);

        $data = $request->all();
        $data['no_hp'] = $pelatih->no_hp;

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logo-eskul', 'public');
        }

        $eskul = Eskul::create($data);

        $eskul
            ? toast('Data Eskul berhasil ditambah', 'success')
            : toast('Data Eskul gagal ditambahkan', 'error');

        return redirect()->route('eskul.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $eskul = Eskul::findOrFail($id);
        $pelatih = User::whereHas('level', function ($query) {
            $query->where('name', 'Pelatih Eskul');
        })->get();

        return view('pages.admin.eskul.edit', compact('eskul', 'pelatih'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_eskul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'pelatih_id' => 'required|exists:users,id',
            'tahun_ajaran' => 'required|string|max:20',
            'jumlah_pertemuan' => 'required|integer|min:1',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $eskul = Eskul::findOrFail($id);
        $pelatih = User::find($request->pelatih_id);

        $data = $request->all();
        $data['no_hp'] = $pelatih->no_hp;

        if ($request->hasFile('logo')) {
            if ($eskul->logo) {
                Storage::delete('public/' . $eskul->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo-eskul', 'public');
        }

        $eskul->update($data);

        $eskul
            ? toast('Data Eskul berhasil diupdate', 'success')
            : toast('Data Eskul gagal diupdate', 'error');

        return redirect()->route('eskul.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $eskul = Eskul::findOrFail($id);

        if ($eskul->logo) {
            Storage::delete('public/' . $eskul->logo);
        }

        $eskul->delete();

        $eskul
            ? toast('Data Eskul berhasil dihapus', 'success')
            : toast('Data Eskul gagal dihapus', 'error');

        return redirect()->route('eskul.index');
    }
}
