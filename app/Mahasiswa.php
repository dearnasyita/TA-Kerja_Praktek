<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $guarded = []; 
    

    public function users(){
        return $this->belongsTo('App\User', 'id_users');
    }

    public function kelompok(){
        return $this->belongsTo('App\Kelompok', 'id_mahasiswa');
    }

    public function laporanharian(){
        return $this->hasMany('App\LaporanHarian', 'id_mahasiswa');
    }

    public function detailKelompok(){
        return $this->hasMany('App\DetailKelompok', 'id_mahasiswa','id_mahasiswa');
    }

    
    public function periode(){
        return $this->belongsTo('App\Periode', 'id_periode');
    }
}
