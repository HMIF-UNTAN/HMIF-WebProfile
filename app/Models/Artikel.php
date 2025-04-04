<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';
    protected $guarded = [];
    protected $fillable = ['judul', 'konten', 'slug', 'thumbnail', 'tanggal_kegiatan'];

    protected static function booted()
    {
        static::creating(function ($artikel) {
            $artikel->slug = Str::slug($artikel->judul);
        });

        static::updating(function ($artikel) {
            $artikel->slug = Str::slug($artikel->judul);
        });
    }

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

}
