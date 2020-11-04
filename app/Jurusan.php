<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    //Menghubungkan model dengan table
    protected $table = 'tbl_jurusan';

    protected $primaryKey = 'kd_jurusan';

    public $incrementing = false;

    //Menentukan field yang boleh diisi
    protected $fillable = [
        'kd_jurusan', 'nama_jurusan'
    ];

    public function kelas(){
        return $this->hasMany('App\Kelas');
    }

    public function kurikulum(){
        return $this->belongsTo('App\kurikulum', 'id_kurikulum', 'id_kurikulum');
    }

    public function detail(){
        return $this->hasMany('App\KurikulumDetail');
    }

    public function siswa(){
        return $this->hasMany('App\Siswa');
    }
    public function jadwal(){
        return $this->hasMany('App\Jadwal');
    }

    public function walikelas(){
        return $this->hasMany('App\Walikelas');
    }
    
}
