<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = 'kelompok';
    protected $primaryKey = 'id_kelompok';
    protected $guarded = [];

    public function mahasiswa(){
        return $this->hasMany('App\Mahasiswa', 'id_mahasiswa');
    }

    public function dosen(){
        return $this->hasOne('App\Dosen', 'id_dosen');
    }

    public function presentasi(){
        return $this->hasOne('App\Presentasi', 'id_kelompok');
    }

    public function usulan(){
        return $this->hasMany('App\Usulan', 'id_kelompok');
    }

    
    public function detailKelompok(){
        return $this->hasMany('App\DetailKelompok','id_kelompok','id_kelompok') ;
    }

    public function Periode(){
        return $this->belongsTo('App\Periode','id_periode','id_periode') ;
    }
    public function Lowongan(){
        return $this->hasMany('App\Lowongan','id_periode','id_periode') ;
    }
    public function Lamaran(){
        return $this->hasMany('App\Lamaran','id_kelompok','id_kelompok') ;
    }
    public function Magang(){
        return $this->hasMany('App\Magang','id_kelompok','id_kelompok') ;
    }
    
}
