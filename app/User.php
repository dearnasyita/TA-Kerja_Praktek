<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey ='id_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'id_roles','id_users'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token', 'isDeleted', 'created_at', 'created_by', 'updated_at', 'updated_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function mahasiswa(){
        return $this->hasOne('App\Mahasiswa', 'id_users');
    }
    public function dosen(){
        return $this->hasOne('App\Dosen', 'id_users');
    }
    public function instansi(){
        return $this->hasOne('App\Instansi', 'id_users');
    }

}
