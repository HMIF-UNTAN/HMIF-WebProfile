<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';

    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'jenis_kelamin',
        'nim',
        'website_pribadi',
        'judul_tugas_akhir',
        'angkatan',
        'email',
        'no_hp',
        'pekerjaan',
        'nama_perusahaan',
        'website_perusahaan',
        'facebook',
        'linkedin',
        'instagram',
        'twitter',
        'minat_motto',
        'foto',
        'status_verifikasi',
    ];
}
