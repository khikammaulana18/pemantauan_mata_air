<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    //
    protected $table = 'laporan';
    protected $fillable  = [
        'mata_air_id',
        'kode_laporan',
        'tgl_pelaporan',
        'nama',
        'job',
        'desc_laporan',
        'created_at',
        'updated_at'
    ];


    public function MataAir(){
        return $this->belongsTo(MataAir::class,'mata_air_id');
    }
    public function Media(){
        return $this->belongsToMany(Media::class,MediaLaporan::class,'laporan_id');
    }

}
