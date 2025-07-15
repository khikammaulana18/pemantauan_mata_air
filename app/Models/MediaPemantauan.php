<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaPemantauan extends Model
{
    //
    protected $table = 'media_pemantauan';
    public $timestamps = true;
    protected $fillable = [
        'pemantauan_id',
        'media_id'
    ];
}
