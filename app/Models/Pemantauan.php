<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemantauan extends Model
{
    //
    protected $table = 'pemantauan';
    public $timestamps = true;
    protected $fillable = [
        'mata_air_id',
        'user_id',
        'tgl_pemantauan',
        'debit_mata_air',
        'kondisi_air',
        'kerusakan'
    ];

    public function MataAir(){
        return $this->belongsTo(MataAir::class,'mata_air_id');
    }
    public function Users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function Media(){
        return $this->belongsToMany(Media::class, MediaPemantauan::class,'pemantauan_id');
    }
}
