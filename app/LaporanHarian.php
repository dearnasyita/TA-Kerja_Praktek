<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    protected $guarded = [];
    protected $table = 'buku_harian';
    protected $primaryKey = 'id_buku_harian';

    public function mahasiswa(){
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa');
    }

    
}
