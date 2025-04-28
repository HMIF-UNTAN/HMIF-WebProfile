<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TentangKami;
use Carbon\Carbon;

class TentangKamiSeeder extends Seeder
{
    public function run()
    {
        TentangKami::truncate();

        $data = json_decode(file_get_contents(database_path('seeders/data/tentangkami.json')), true);

        $data = array_map(function ($item) {
            // Format ulang datetime ISO 8601 ke format MySQL
            $item['created_at'] = Carbon::parse($item['created_at'])->format('Y-m-d H:i:s');
            $item['updated_at'] = Carbon::parse($item['updated_at'])->format('Y-m-d H:i:s');

            // Pastikan konten berupa string
            if (is_array($item['konten'])) {
                $item['konten'] = json_encode($item['konten']);
            }

            return $item;
        }, $data);

        TentangKami::insert($data);
    }
}
