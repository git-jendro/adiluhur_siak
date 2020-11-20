<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    //Menghubungkan model dengan table
    protected $table = 'tbl_kelas';
    
    protected $primaryKey = 'kd_kelas';

    public $incrementing = false;

    //Menentukan field yang boleh diisi
    protected $fillable = [
        'kd_kelas', 'nama_kelas', 'kd_tingkatan', 'kd_jurusan'
    ];


    public function siswa(){
        return $this->hasMany('App\Siswa');
    }

    public function tingkatan(){
        return $this->belongsTo('App\TingkatanKelas', 'kd_tingkatan', 'kd_tingkatan');
    }

    public function jurusan(){
        return $this->belongsTo('App\Jurusan', 'kd_jurusan', 'kd_jurusan');
    }

    public function jadwal(){
        return $this->hasMany('App\Jadwal'); 
    }
    
    public function kurikulum(){
        return $this->belongsTo('App\Kurikulum', 'id_kurikulum', 'id_kurikulum');
    }
    
    public function walikelas(){
        return $this->hasMany('App\Walikelas');
    }
    public function ruangan()
    {
        return $this->belongsTo('App\Ruangan', 'kd_ruangan', 'kd_ruangan');
    }   
}
