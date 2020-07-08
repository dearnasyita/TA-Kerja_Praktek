<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $guarded = [];
    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';


    public function mahasiswa(){
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa');
    }

    
    public function aspek_nilai(){
        return $this->belongsTo('App\AspekNilai', 'id_aspek_penilaian');
    }
}
