<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';
    protected $guarded = [];
    

    public function users(){
        return $this->belongsTo('App\User', 'id_users');
    }

    public function kelompok(){
        return $this->belongsTo('App\Kelompok', 'id_dosen');
    }
    public function presentasi(){
        return $this->hasMany('App\Presentasi', 'id_dosen');
    }
}
