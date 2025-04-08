<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;
use Illuminate\Support\Facades\File;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('seeders/data/galeri.json');

        if (!File::exists($jsonPath)) {
            $this->command->error("File galeri.json tidak ditemukan.");
            return;
        }

        $data = json_decode(File::get($jsonPath), true);

        foreach ($data as $album) {
            Galeri::updateOrCreate(
                ['google_drive_folder_id' => $album['google_drive_folder_id']],
                [
                    'nama_album' => $album['nama_album'],
                    'created_at' => $album['created_at'] ?? now(),
                    'updated_at' => $album['updated_at'] ?? now(),
                ]
            );
        }

        $this->command->info("Seeder galeri berhasil dijalankan!");
    }
}
