<?php

namespace Database\Seeders;

use App\Models\Artikel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    public function run()
    {
        Artikel::truncate();

        $data = json_decode(file_get_contents(database_path('seeders/data/artikel.json')), true);
        
        // Format ulang datetime sebelum insert
        $formattedData = array_map(function ($item) {
            return [
                'judul' => $item['judul'],
                'kategori_kegiatan' => $item['kategori_kegiatan'],
                'konten' => $item['konten'],
                'slug' => $item['slug'],
                'tanggal_kegiatan' => Carbon::parse($item['tanggal_kegiatan'])->format('Y-m-d'),
                'thumbnail' => $item['thumbnail'],
                'created_at' => Carbon::parse($item['created_at'])->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s'),
            ];
        }, $data);

        Artikel::insert($formattedData);
    }
}