<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    //Menghubungkan model dengan table
    protected $table = 'tbl_ruangan';

    protected $primaryKey = 'kd_ruangan';

    public $incrementing = false;

    //Menentukan field yang boleh diisi
    protected $fillable = [
       'kd_ruangan', 'nama_ruangan', 'kapasitas'
    ];

    public function jadwal(){
        return $this->hasMany('App\Jadwal');
    }

    public function kelas()
    {
        return $this->hasMany('App\Kelas', 'kd_ruangan');
    }
    
}
