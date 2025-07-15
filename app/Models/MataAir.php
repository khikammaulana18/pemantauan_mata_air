<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataAir extends Model
{
    //
    protected $table = 'mata_air';
    public $timestamps = true;
    protected $fillable = [
        'nama_mata_air',
        'short_desc',
        'long_desc',
        'lat',
        'lng',
        'kondisi',
        'alamat_mata_air',
        'status_mata_air',
    ];

    public function Laporan(){
        return $this->hasMany(Laporan::class);
    }
    public function Pemantauan(){
        return $this->hasMany(Pemantauan::class);
    }
    public function Media(){
        return $this->belongsToMany(Media::class,MediaMataAir::class,'mata_air_id');
    }
}
