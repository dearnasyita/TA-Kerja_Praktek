<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $table = 'magang';
    protected $primaryKey = 'id_magang';
    protected $guarded = [];

    public function Kelompok(){
        return $this->belongsTo('App\Kelompok','id_kelompok','id_kelompok') ;
    }
    public function detailKelompok(){
        return $this->hasMany('App\DetailKelompok','id_kelompok','id_kelompok') ;
    }
    public function periode(){
        return $this->belongsTo('App\Periode','id_periode','id_periode') ;
    }
    public function instansi(){
        return $this->belongsTo('App\Instansi','id_instansi','id_instansi') ;
    }
}
