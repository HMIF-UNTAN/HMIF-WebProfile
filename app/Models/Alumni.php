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
        'nim',
        'angkatan',
        'email',
        'no_hp',
        'pekerjaan',
        'instansi',
        'alamat_domisili',
        'status_verifikasi',
    ];
}
