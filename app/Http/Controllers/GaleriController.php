<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Services\GoogleDriveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;


class GaleriController extends Controller
{
    public function indexDapur(Request $request)
    {
        $galeri = Galeri::latest()->get();
        return view('dapur.galeri.index', compact('galeri'));
    }

    public function tambahalbum()
    {
        return view('dapur.galeri.store');
    }

    public function edit($id, GoogleDriveService $drive)
    {
        $album = Galeri::findOrFail($id);
        $files = $drive->listFilesInFolder($album->google_drive_folder_id);

        return view('dapur.galeri.edit', compact('album', 'files'));
    }

    public function store(Request $request, GoogleDriveService $drive)
    {
        $request->validate([
            'nama_album' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:35840', // Tambah validasi thumbnail
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $folderId = $drive->createFolder($request->nama_album);

        Galeri::create([
            'nama_album' => $request->nama_album,
            'google_drive_folder_id' => $folderId,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('dapurgaleri')->with('success', 'Album berhasil ditambahkan!');
    }

    public function uploadFoto(Request $request, $id, GoogleDriveService $drive)
    {
        $request->validate([
            'foto' => 'required|array|max:20',
            'foto.*' => 'image|max:35840', // masing-masing file max 35MB
            'custom_name' => 'nullable|string|max:255',
        ], [
            'foto.*.max' => 'Ukuran foto maksimal 35MB!',
        ]);

        $album = Galeri::findOrFail($id);
        $files = $request->file('foto');
        $customBaseName = $request->input('custom_name');

        $counter = 1;
        foreach ($files as $file) {
            $extension = $file->getClientOriginalExtension();

            if ($customBaseName) {
                $finalName = $customBaseName . '_' . $counter . '.' . $extension;
            } else {
                // Jika tidak ada custom name, tetap gunakan nama asli
                $finalName = $file->getClientOriginalName();
            }

            $drive->upload($file, $finalName, $album->google_drive_folder_id);
            $counter++;
        }

        return redirect()->route('galeri.edit', $album->id)->with('success', 'Foto berhasil diupload ke Google Drive!');
    }

    public function hapusFoto($id, $fileId)
    {
        $album = Galeri::findOrFail($id);
        $drive = new GoogleDriveService;
        $result = $drive->deleteFile($fileId);

        return redirect()->route('galeri.edit', $album->id)->with(
            $result ? 'success' : 'error',
            $result ? 'Foto berhasil dihapus dari Google Drive.' : 'Gagal menghapus foto.'
        );
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        $drive = new GoogleDriveService();

        $drive->deleteFolder($galeri->google_drive_folder_id);
        $galeri->delete();

        return redirect()->back()->with('success', 'Album berhasil dihapus.');
    }  
    
    public function downloadSeederFromDrive(GoogleDriveService $drive)
    {
        $folders = $drive->listAllGaleriFolders(); // dari Google Drive
        $folderIds = collect($folders)->pluck('id')->toArray(); // ambil daftar ID folder

        $albums = Galeri::whereIn('google_drive_folder_id', $folderIds)->get();

        $data = collect($folders)->map(function ($folder) use ($albums) {
            $matchingAlbum = $albums->firstWhere('google_drive_folder_id', $folder->getId());

            return [
                'id' => $matchingAlbum?->id, // ambil ID database jika ada
                'nama_album' => $matchingAlbum?->nama_album ?? $folder->getName(),
                'google_drive_folder_id' => $folder->getId(),
                'created_at' => $matchingAlbum?->created_at ?? now()->toDateTimeString(),
                'updated_at' => $matchingAlbum?->updated_at ?? now()->toDateTimeString(),
            ];
        });

        $jsonData = $data->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $filename = 'galeri_' . now()->format('Ymd_His') . '.json';
        Storage::disk('local')->put("seeders/data/{$filename}", $jsonData);

        return Response::make($jsonData, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_album' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:35840',
        ]);

        $galeri = Galeri::findOrFail($id);
        $data = [
            'nama_album' => $request->nama_album,
        ];
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($galeri->thumbnail && Storage::disk('public')->exists($galeri->thumbnail)) {
                Storage::disk('public')->delete($galeri->thumbnail);
            }
        
            // Upload thumbnail baru
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = $thumbnailPath;
        }

        $galeri->update($data);

        return redirect()->route('dapurgaleri')->with('success', 'Album berhasil diperbarui!');
    }
}