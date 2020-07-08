<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    protected $primaryKey = 'id_pelamar';
    protected $table = 'pelamar';
    protected $guarded = [];

    public function kelompok(){
        return $this->belongsTo('App\Kelompok', 'id_kelompok');
    }
    public function lowongan(){
        return $this->belongsTo('App\Lowongan', 'id_lowongan');
    }
    public function DetailKelompok(){
        return $this->hasMany('App\DetailKelompok','id_kelompok','id_kelompok') ;
    }
}
