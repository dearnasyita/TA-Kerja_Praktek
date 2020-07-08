<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailKelompok extends Model
{
    protected $primaryKey = 'id_kelompok_detail';
    protected $table = 'kelompok_detail';
    protected $guarded = [];

    public function kelompok(){
        return $this->hasMany('App\Kelompok', 'id_kelompok','id_kelompok');
    }
    public function magang(){
        return $this->belongsTo('App\Magang','id_kelompok') ;
    }
    // public function instansi(){
    //     return $this->belongsTo('App\Instansi','id_instansi') ;
    // }
    public function mahasiswa(){
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa');
    }
    public function Lamaran(){
        return $this->hasMany('App\DaftarLamaran','id_kelompok','id_kelompok') ;
    }
    
}
