<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'jenis_jabatan',
        'foto',
    ];

    protected static function booted()
    {
        static::deleting(function ($pengurus) {
            if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
                Storage::disk('public')->delete($pengurus->foto);
            }
        });
    }

    public function kepengurusan()
    {
        return $this->hasOne(Kepengurusan::class);
    }

    public static function updatePengurusSeeder()
    {
        $data = self::with(['kepengurusan.divisi'])->get()->map(function ($p) {
            return [
                'nama' => $p->nama,
                'nim' => $p->nim,
                'email' => $p->email,
                'jenis_jabatan' => $p->jenis_jabatan,
                'foto' => $p->foto,
                'kepengurusan' => [
                    'divisi_id' => optional($p->kepengurusan)->divisi_id,
                    'jabatan' => optional($p->kepengurusan)->jabatan,
                    'periode' => optional($p->kepengurusan)->periode,
                ],
            ];
        });

        File::ensureDirectoryExists(database_path('seeders/data'));
        File::put(
            database_path('seeders/data/pengurus.json'),
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }
}

