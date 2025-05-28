<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Artikel::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                ->orWhere('konten', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('kategori')) {
            $kategori = $request->kategori;
            if (is_array($kategori)) {
                $query->whereIn('kategori_kegiatan', $kategori);
            }
        }

        if ($request->filled('status_kegiatan')) {
            $today = Carbon::today();
            if ($request->status_kegiatan == 'terlaksana') {
                $query->whereDate('tanggal_kegiatan', '<', $today);
            } elseif ($request->status_kegiatan == 'belum') {
                $query->whereDate('tanggal_kegiatan', '>=', $today);
            }
        }

        $artikels = $query->orderBy('tanggal_kegiatan', 'desc')->paginate(6)->withQueryString();
        $daftarKategori = Artikel::select('kategori_kegiatan')->distinct()->orderBy('kategori_kegiatan')->pluck('kategori_kegiatan');
        $artikelTerkini = Artikel::whereDate('tanggal_kegiatan', '<=', Carbon::today())
        ->orderByDesc('tanggal_kegiatan')
        ->limit(3)
        ->get();

        return view('artikel.index', compact('artikels', 'daftarKategori', 'artikelTerkini'));
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

        if ($request->filled('kategori')) {
            $query->where('kategori_kegiatan', $request->kategori);
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
        'tanggal_kegiatan' => 'required|date',
        'kategori_kegiatan' => 'required|in:Fakultas,Himpunan,Eksternal',
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
        'kategori_kegiatan' => $request->kategori_kegiatan,
    ]);

    Artikel::updateArtikelSeeder();

    return redirect()->route('dapurartikel')->with('success', 'Artikel berhasil diunggah.');
}

    /**
     * Display the specified resource.
     */
    public function show($slug_id)
    {
        $id = (int) Str::afterLast($slug_id, '-');
        $artikel = Artikel::findOrFail($id);
        return view('artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('dapur.artikel.edit',  compact('artikel'));
    }

    public function update(Request $request, $id)
{
    $artikel = Artikel::find($id);

    if (!$artikel) {
        return back()->with('error', 'Artikel tidak ditemukan.');
    }

    \Log::info('Request:', $request->all());

    $artikel->judul = $request->judul;
    $artikel->konten = $request->konten;
    $artikel->tanggal_kegiatan = $request->tanggal_kegiatan;
    $artikel->kategori_kegiatan = $request->kategori_kegiatan;

    if ($request->hasFile('thumbnail')) {
        $path = $request->file('thumbnail')->store('thumbnails', 'public');
        $artikel->thumbnail = $path;
    }

    $artikel->save();
    Artikel::updateArtikelSeeder();
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
