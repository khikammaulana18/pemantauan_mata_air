<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaMataAir extends Model
{
    //
    protected $table ='media_mata_air';
    public $timestamps = true;
    protected $fillable = [
        'mata_air_id',
        'media_id'
    ];
}
