<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\GoogleDriveService;

class HomeController extends Controller
{
    public function index(GoogleDriveService $driveService)
    {
        $himpunanInfo = TentangKami::find(2);
        $dataTentangKami = TentangKami::all();
        $newestArticles = Artikel::latest()->take(2)->get();
        $albums = Galeri::inRandomOrder()->get();

        // Fallback
        $defaultData = [
            'judul' => 'Himpunan Mahasiswa Informatika',
            'konten' => 'Deskripsi belum tersedia.',
        ];

        return view('index', [
            'himpunanInfo' => $himpunanInfo ?: (object) $defaultData,
            'dataTentangKami' => $dataTentangKami,
            'newestArticles' => $newestArticles,
            'albums' => $albums,
        ]);
    }
}
