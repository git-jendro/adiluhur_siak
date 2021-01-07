<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Jurusan;
use App\Kelas;
use App\Riwayat;
use App\Siswa;
use App\TahunAkademik;
use App\Walikelas;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\True_;

class WalikelasController extends DashboardBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;
        $tahunakademik = TahunAkademik::where('is_aktif', TRUE)->first();
        $guru = Guru::all();
        $walikelas = Walikelas::where('id_tahun_akademik', $tahunakademik->id_tahun_akademik)
            ->with(['kelas','jurusan', 'tingkatan', 'guru'])->get();


        return view('/walikelas/index', compact('sql_menu', 'menu', 'walikelas', 'guru', 'tahunakademik'));
    }
    
    public function guru($guru, $id)
    {
        $data = Walikelas::where('id_walikelas', $id)
        ->update([
            'id_guru' => $guru
        ]);
        
    }
    public function riwayat($wali)
    {
        $riwayat = Riwayat::where('id_walikelas', $wali)->with('siswa')->get();
        
        return response()->json($riwayat);
    }

    
}
