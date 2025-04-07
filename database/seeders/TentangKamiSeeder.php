<?php

use Illuminate\Database\Seeder;
use App\Models\TentangKami;

class TentangKamiSeeder extends Seeder
{
    public function run()
    {
        TentangKami::truncate(); // bersihkan dulu biar ga dobel

        TentangKami::insert(json_decode(file_get_contents(database_path('seeders/data/tentangkami.json')), true));
    }
}

