<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';
    protected $guarded = [];
    protected $fillable = ['judul', 'konten', 'slug', 'thumbnail', 'tanggal_kegiatan', 'kategori_kegiatan', 'thumnail'];

    protected static function booted()
    {
        static::creating(function ($artikel) {
            $artikel->slug = Str::slug($artikel->judul);
        });

        static::updating(function ($artikel) {
            $artikel->slug = Str::slug($artikel->judul);
        });

        static::deleting(function ($artikel) {
            if ($artikel->foto && Storage::disk('public')->exists($artikel->foto)) {
                Storage::disk('public')->delete($artikel->foto);
            }
        });
    }

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    public static function updateArtikelSeeder()
    {
        $data = self::all()->map(function ($artikel) {
            // Pastikan 'thumbnail' tetap string, bukan path resource
            $artikel->thumbnail = $artikel->thumbnail ?? null;
            return $artikel;
        })->toArray();

        file_put_contents(database_path('seeders/data/artikel.json'), json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

}
