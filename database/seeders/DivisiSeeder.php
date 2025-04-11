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
            ['nama' => 'Ketua Himpunan'],
            ['nama' => 'Bendahara'],
            ['nama' => 'Sekretaris'],
            ['nama' => 'Sumber Daya Mahasiswa'],
            ['nama' => 'Usaha Dana, Profesi dan Jasa'],
            ['nama' => 'Komunikasi dan Informasi'],
            ['nama' => 'Kesejahteraan Rumah Tangga'],
            ['nama' => 'Pendidikan dan Riset Teknologi'],
        ]);
    }
}
