<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('artikel');
    }

    public function indexDapur(Request $request)
    {
        $query = Artikel::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status')) {
            if ($request->status === 'upcoming') {
                $query->where('tanggal_kegiatan', '>', now());
            } elseif ($request->status === 'past') {
                $query->where('tanggal_kegiatan', '<=', now());
            }
        }

        if ($request->has('sort') && $request->sort === 'desc') {
            $query->orderBy('tanggal_kegiatan', 'desc');
        } else {
            $query->orderBy('tanggal_kegiatan', 'asc');
        }

        $artikels = $query->paginate(8);
        return view('dapur.artikel.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function tambahArtikel(){
        return view('dapur.artikel.store');
    }

    public function store(Request $request)
    {
    $request->validate([
        'judul' => 'required|string|max:255',
        'konten' => 'required',
        'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:35840',
        'tanggal_kegiatan' => 'required|date'
    ]);

    $gambarPath = null;
    if ($request->hasFile('thumbnail')) {
        $gambarPath = $request->file('thumbnail')->store('artikel_images', 'public');
    }


    Artikel::create([
        'judul' => $request->judul,
        'konten' => $request->konten,
        'thumbnail' => $gambarPath,
        'tanggal_kegiatan' => $request->tanggal_kegiatan ?? now()->toDateString(),
    ]);

    Artikel::updateArtikelSeeder();
    return redirect()->route('dapurartikel')->with('success', 'Artikel berhasil diunggah.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('dapur.artikel.edit',  compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_kegiatan' => 'required|date'
        ]);

        $artikel = Artikel::findOrFail($id);
        $artikel->judul = $request->judul;
        $artikel->konten = $request->konten;
        $artikel->slug = Str::slug($request->judul);
        $artikel->tanggal_kegiatan = $request->tanggal_kegiatan;

        if ($request->hasFile('thumbnail')) {
            // hapus gambar lama
            if ($artikel->thumbnail) {
                Storage::delete('public/' . $artikel->thumbnail);
            }

            $file = $request->file('thumbnail');
            $path = $file->store('artikel_images', 'public');
            $artikel->thumbnail = $path;
        }

        Artikel::updateArtikelSeeder();
        $artikel->save();

        return redirect()->route('dapurartikel')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($artikel->thumbnail) {
            \Storage::delete('public/' . $artikel->thumbnail);
        }

        $artikel->delete();
        Artikel::updateArtikelSeeder();
        return redirect()->route('dapurartikel')->with('success', 'Artikel berhasil dihapus.');
    }
}
