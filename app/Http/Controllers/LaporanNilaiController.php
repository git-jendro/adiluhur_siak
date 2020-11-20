<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Jadwal;
use App\Jurusan;
use App\Kelas;
use App\Nilai;
use App\Siswa;
use App\TahunAkademik;
use App\Walikelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanNilaiController extends DashboardBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    
    public function index()
    {
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;
        $tahun = TahunAkademik::where('is_aktif', 'Y')->first();
        if (Auth::user()->id_level_user == 6) {
            $jurusan = Jurusan::all();
            $kelas = Kelas::all();
            $walikelas = null;
            return view('/laporan_nilai/index', compact('sql_menu', 'menu', 'tahun', 'jurusan', 'kelas', 'walikelas'));
        }
        $guru = Guru::select('id_guru')
            ->where('email', Auth::user()->email)
            ->first();
        $walikelas = Walikelas::where('id_guru', $guru->id_guru)->first();
        
        
        if ($walikelas != null) {
            $siswa = Siswa::where('kd_kelas', $walikelas->kd_kelas)->get();
            $kelas = Kelas::all();
            return view('/laporan_nilai/index', compact('sql_menu', 'menu', 'tahun', 'walikelas', 'siswa', 'kelas'));
        }

        return view('/laporan_nilai/index', compact('sql_menu', 'menu', 'tahun'));
    }

    public function show($nis)
    {
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;
        $siswa = Siswa::where('nis', $nis)->first();
        // $jadwal = Jadwal::where('kd_kelas', $siswa->kd_kelas)->get();
        $nilai = Nilai::where('nis', $nis)->get();

        return view('/laporan_nilai/show', compact('sql_menu', 'menu', 'siswa', 'nilai'));
    }

    public function kelas($jurusan)
    {
        $kelas = Kelas::where('kd_jurusan', $jurusan)->get();

        return response()->json($kelas);
    }

    public function siswa($kelas)
    {
        $siswa = Siswa::where('kd_kelas', $kelas)->get();

        return response()->json($siswa);
    }
}
