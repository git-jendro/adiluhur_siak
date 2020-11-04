<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //Menghubungkan model dengan table
    protected $table = 'tbl_siswa';

    protected $primaryKey = 'nis';

    //Menentukan field yang boleh diisi
    protected $fillable = [
        'nama', 'jenis_kelamin', 'alamat_siswa', 'tanggal_lahir', 'tempat_lahir', 'nama_ayah', 'nama_ibu',
        'alamat_ortu', 'no_telp_ortu', 'no_telp_siswa', 'no_ijazah', 'sekolah_asal', 'kd_agama', 'foto',
        'kd_kelas', 'status_siswa', 'email', 'password',
    ];

    public function kelas(){
    return $this->belongsTo('App\Kelas', 'kd_kelas', 'kd_kelas');
    }

    public function agama(){
        return $this->belongsTo('App\Agama', 'kd_agama', 'kd_agama');
    }

    public function jurusan(){
        return $this->belongsTo('App\Jurusan', 'kd_jurusan', 'kd_jurusan');
    }
    
    public function nilai()
    {
        return $this->hasMany('App\Nilai');
    }

    public function Walikelas()
    {
        return $this->belongsTo('App\Walikelas', 'id_walikelas', 'id_walikelas');
    }
}
