<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Divisi;
use App\Models\Galeri;
use App\Models\Pengurus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DapurController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $jumlahArtikel = Artikel::count();
        $jumlahPengurus = Pengurus::count();
        $jumlahAlbum = Galeri::count();

        $pengurusPerDivisi = Divisi::withCount('kepengurusan')
            ->whereNotIn('nama', ['Ketua Himpunan', 'Sekretaris', 'Bendahara'])
            ->get();

        $latestArtikel = Artikel::latest()->first();
        $latestAlbum = Galeri::latest()->first();

        return view('dapur.index', compact(
            'user',
            'jumlahArtikel',
            'jumlahPengurus',
            'jumlahAlbum',
            'pengurusPerDivisi',
            'latestArtikel',
            'latestAlbum',    
        ));
    }
}
