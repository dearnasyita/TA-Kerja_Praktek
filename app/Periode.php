<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $guarded = [];
    protected $table = 'periode';
    protected $primaryKey = 'id_periode';

    public function lowongan(){
        return $this->hasMany('App\Lowongan', 'id_instansi');
    }
    public function mahasiswa(){
        return $this->hasMany('App\Mahasiswa', 'id_periode');
    }
    public function magang(){
        return $this->hasMany('App\Magang','id_periode') ;
    }
    
}
