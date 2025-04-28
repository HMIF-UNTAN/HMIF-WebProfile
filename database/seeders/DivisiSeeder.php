<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('divisi')->insert([
            ['id' => 1, 'nama' => 'Ketua Himpunan'],
            ['id' => 2, 'nama' => 'Bendahara'],
            ['id' => 3, 'nama' => 'Sekretaris'],
            ['id' => 4, 'nama' => 'Sumber Daya Mahasiswa'],
            ['id' => 5, 'nama' => 'Usaha Dana, Profesi dan Jasa'],
            ['id' => 6, 'nama' => 'Komunikasi dan Informasi'],
            ['id' => 7, 'nama' => 'Kesejahteraan Rumah Tangga'],
            ['id' => 8, 'nama' => 'Pendidikan dan Riset Teknologi'],
        ]);
    }
}
