<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaLaporan extends Model
{
    //
    protected $table = 'media_laporan';
    public $timestamps = true;
    protected $fillable = [
        'laporan_id',
        'media_id'
    ];
}
