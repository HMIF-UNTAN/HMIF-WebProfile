<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TentangKami extends Model
{
    protected $table = 'tentang_kamis';
    protected $guarded = [];
    protected $casts = [
        'konten' => 'array',
    ];

    public static function updateTentangKamiSeeder()
    {
        $data = self::all()->toArray();
        file_put_contents(database_path('seeders/data/tentangkami.json'), json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    
}