<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kontak::create([
            'alamat' => 'Gedung Informatika UNTAN, Jl. Prof. Dr. H. Hadari Nawawi, Pontianak',
            'narahubung_nama' => 'John Doe',
            'narahubung_kontak' => '081234567890',
            'email' => 'hmif@informatika.untan.ac.id',
        ]);
    }
}
