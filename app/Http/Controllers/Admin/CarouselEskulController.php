<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarouselEskul;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class CarouselEskulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = CarouselEskul::all();
        return view('pages.admin.carousel.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('carousel_eskul', 'public');
        }

        CarouselEskul::create($data);

        toast('Data berhasil ditambahkan', 'success');
        return redirect()->route('carousel.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carousel = CarouselEskul::findOrFail($id);
        return view('pages.admin.carousel.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $item = CarouselEskul::findOrFail($id);
        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $item->image);
            $data['image'] = $request->file('image')->store('carousel_eskul', 'public');
        }

        $item->update($data);

        toast('Data berhasil diupdate', 'success');
        return redirect()->route('carousel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = CarouselEskul::findOrFail($id);

        if ($item->image) {
            Storage::delete('public/' . $item->image);
        }

        $item->delete();

        toast('Data berhasil dihapus', 'success');
        return redirect()->route('carousel.index');
    }
}
