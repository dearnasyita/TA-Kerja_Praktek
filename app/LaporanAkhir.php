<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanAkhir extends Model
{
    protected $guarded = [];
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';

    public function kelompok(){
        return $this->belongsTo('App\Kelompok', 'id_kelompok');
    }
}
