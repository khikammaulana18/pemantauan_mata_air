<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $table = 'media';
    public $timestamps = true;
    protected $fillable = [
        'nama_media',
        'type',
        'path',
    ];


    public function MataAir(){
        return $this->belongsToMany(MataAir::class,MediaMataAir::class,'media_id');
    }

    public function Laporan(){
        return $this->belongsToMany(Laporan::class,MediaLaporan::class,'media_id');
    }
    public function Pemantauan(){
        return $this->belongsToMany(Pemantauan::class, MediaPemantauan::class,'media_id');
    }


}
