<?php

namespace Database\Seeders;

use App\Models\Artikel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtikelSeeder extends Seeder
{
    public function run()
    {
        Artikel::truncate();

        Artikel::insert(json_decode(file_get_contents(database_path('seeders/data/artikels.json')), true));
    }
}
