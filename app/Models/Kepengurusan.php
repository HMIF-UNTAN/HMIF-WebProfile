<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kepengurusan extends Model
{
    protected $table = 'kepengurusan';
    
    protected $fillable = [
        'pengurus_id',
        'divisi_id',
        'jabatan',
        'periode',
    ];

    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
