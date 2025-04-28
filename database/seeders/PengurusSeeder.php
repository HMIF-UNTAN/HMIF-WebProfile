<?php

namespace Database\Seeders;

use App\Models\Pengurus;
use App\Models\Kepengurusan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengurusSeeder extends Seeder
{
    public function run()
    {
        // ✅ Matikan foreign key check untuk sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate dengan aman
        Kepengurusan::truncate();
        Pengurus::truncate();

        // ✅ Aktifkan kembali foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ambil data dari file JSON
        $data = json_decode(file_get_contents(database_path('seeders/data/pengurus.json')), true);

        // Insert data
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
