<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    protected $guarded = [];
    protected $table = 'usulan';
    protected $primaryKey = 'id_usulan';

    public function kelompok(){
        return $this->belongsTo('App\Kelompok', 'id_kelompok');
    }
    
    public function periode(){
        return $this->belongsTo('App\Periode', 'id_periode');
    }
}
