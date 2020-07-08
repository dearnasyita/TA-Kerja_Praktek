<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AspekNilai extends Model
{
    protected $guarded = [];
    protected $table = 'aspek_penilaian';
    protected $primaryKey = 'id_aspek_penilaian';
}
