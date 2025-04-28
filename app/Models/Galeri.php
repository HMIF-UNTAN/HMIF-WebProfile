<?php

namespace App\Models;

use App\Services\GoogleDriveService;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeris';

    protected $fillable = [
        'nama_album',
        'google_drive_folder_id',
        'thumbnail',
    ];
}
