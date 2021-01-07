<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = 'tbl_riwayat_kelas';

    protected $primaryKey = 'id_riwayat';

    protected $guard = 'id_riwayat';

    public function walikelas()
    {
        return $this->belongsTo('App\Walikelas', 'id_walikelas', 'id_walikelas');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Siswa', 'nis', 'nis');
    }
}
