<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TingkatanKelas extends Model
{
    //Menghubungkan model dengan table
    protected $table = 'tbl_tingkatan_kelas';

    protected $primaryKey = 'kd_tingkatan';

    public $incrementing = false;

    //Menentukan field yang boleh diisi
    protected $fillable = [
        'kd_tingkatan', 'nama_tingkatan'
    ];

    public function kelas(){
        return $this->hasMany('App\Kelas');
    }

    public function kurikulum(){
        return $this->belongsTo('App\Kurikulum', 'id_kurikulum', 'id_kurikulum');
    }

    public function detail(){
        return $this->hasMany('App\KurikulumDetail');
    }
    
    public function jadwal(){
        return $this->hasMany('App\Jadwal');
    }
    
    public function walikelas(){
        return $this->hasMany('App\Walikelas');
    }
}
