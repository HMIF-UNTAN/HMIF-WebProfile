<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $fillable = [
        'alamat',
        'narahubung_nama',
        'narahubung_kontak',
        'email',
    ];
}
