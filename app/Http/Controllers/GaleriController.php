<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Http\Controllers\Controller;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Galeri::all();
        return view('galeri.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $galeri = Galeri::create($validated);

        $patch = $request->file('gambar')->store('galeri_images', 'public');
        $galeri->gambar = $patch;
        $galeri->save();

        return redirect()->route('galeri.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('galeri.show', compact('galeri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->judul = $request->input('judul');
        $galeri->deskripsi = $request->input('deskripsi');
        
        $galeri->save();

        return redirect()->route('galeri.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->delete();

        return redirect()->route('galeri.index');
    }
}
