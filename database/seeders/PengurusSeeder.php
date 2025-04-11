<?php

use App\Models\Pengurus;
use App\Models\Kepengurusan;
use Illuminate\Database\Seeder;

class PengurusSeeder extends Seeder
{
    public function run()
    {
        Pengurus::truncate();
        Kepengurusan::truncate();

        $data = json_decode(file_get_contents(database_path('seeders/data/pengurus.json')), true);

        foreach ($data as $item) {
            $pengurus = Pengurus::create([
                'nama' => $item['nama'],
                'nim' => $item['nim'],
                'email' => $item['email'],
                'no_hp' => $item['no_hp'],
                'jenis_jabatan' => $item['jenis_jabatan'],
                'foto' => $item['foto'],
            ]);

            if (isset($item['kepengurusan'])) {
                Kepengurusan::create([
                    'pengurus_id' => $pengurus->id,
                    'divisi_id' => $item['kepengurusan']['divisi_id'],
                    'jabatan' => $item['kepengurusan']['jabatan'],
                    'periode' => $item['kepengurusan']['periode'],
                ]);
            }
        }
    }
}

