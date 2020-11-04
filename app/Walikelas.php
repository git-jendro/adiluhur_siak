<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    //Menghubungkan model dengan table
    protected $table = 'tbl_walikelas';

    protected $primaryKey = 'id_walikelas';

    //Menentukan field yang boleh diisi
    protected $fillable = [
        'id_guru', 'id_tahun_akademik', 'kd_kelas', 'kd_jurusan', 'kd_tingkatan'
    ];

    public function kelas(){
        return $this->belongsTo('App\Kelas', 'kd_kelas', 'kd_kelas');
    }

    public function tingkatan(){
        return $this->belongsTo('App\TingkatanKelas', 'kd_tingkatan', 'kd_tingkatan');
    }

    public function jurusan(){
        return $this->belongsTo('App\Jurusan', 'kd_jurusan', 'kd_jurusan');
    }

    public function guru()
    {
        return $this->belongsTo('App\guru', 'id_guru', 'id_guru');
    }
    
    public function tahunakademik()
    {
        return $this->belongsTo('App\TahunAkademik', 'id_tahun_akademik', 'id_tahun_akademik');
    }
    
    public function siswa()
    {
        return $this->hasMany('App\Siswa');
    }
    
}
