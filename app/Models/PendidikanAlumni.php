<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendidikanAlumni extends Model
{
    protected $table = 'pendidikan_alumni';
    protected $fillable = [
        'alumni_id',
        'jenjang',
        'universitas',
        'tahun_masuk',
        'tahun_lulus',
        'judul_karya_akhir',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }

}
