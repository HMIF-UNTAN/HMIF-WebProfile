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
        $albums = Galeri::all();
        $tempThumbnails = [];

        foreach ($albums as $album) {
            $fileId = $album->google_drive_thumbnail_id;
            $filename = $fileId . '.jpg';
            $path = storage_path('framework/cache/' . $filename);

            if (!file_exists($path)) {
                $driveService->downloadFile($fileId, $path);
            }

            $album->localThumbnail = url('temp-thumb/' . $filename);
            $tempThumbnails[] = $filename;
        }

        session(['temp_thumbnails' => $tempThumbnails]);

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
