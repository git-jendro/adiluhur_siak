<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Jadwal;
use App\Jurusan;
use App\Kelas;
use App\Nilai;
use App\Riwayat;
use App\Ruangan;
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

    public function naik($id)
    {
        $siswa = Siswa::where('nis', $id)->first();
        
        if ($siswa->kelas->kd_tingkatan == '001') {
            $kelas = Kelas::select('kd_kelas')->where([
                ['kd_tingkatan', '002'],
                ['kd_jurusan', $siswa->kelas->jurusan->kd_jurusan]
                ]);
            $count = $kelas->count();
            $kd = $kelas->first();
            $siswa2 = Siswa::where('kd_kelas', $kd->kd_kelas)->count();
            $check = Kelas::select('kd_ruangan')->where('kd_kelas', $kd->kd_kelas);
            $sql = Ruangan::whereHas('kelas', function ($query) use ($check) {
            $query->whereIn('kd_ruangan', $check);
            })->get();
            foreach ($sql as $key ) {
                if ($siswa2 == $key->kapasitas) {
                    $kd = Kelas::where([
                        ['kd_tingkatan', '002'],
                        ['kd_jurusan', $siswa->kelas->jurusan->kd_jurusan]
                    ])->latest('kd_kelas')->first();
                    Siswa::where('nis', $id)
                        ->update([
                            'kd_kelas' => $kd->kd_kelas,
                        ]);
                    $guru = Guru::select('id_guru')
                        ->where('email', Auth::user()->email)
                        ->first();
                    $walikelas = Walikelas::where('id_guru', $guru->id_guru)->first();
                    $data = Siswa::where('kd_kelas', $walikelas->kd_kelas)->get();
                    return response()->json([
                        'siswa' => $siswa->nama,
                        'kd' => $kd->kd_kelas,
                        'data' => $data
                    ]);

                } else {
                    Siswa::where('nis', $id)
                        ->update([
                            'kd_kelas' => $kd->kd_kelas,
                        ]);
                    $guru = Guru::select('id_guru')
                        ->where('email', Auth::user()->email)
                        ->first();
                    $walikelas = Walikelas::where('id_guru', $guru->id_guru)->first();
                    $data = Siswa::where('kd_kelas', $walikelas->kd_kelas)->get();
                    return response()->json([
                        'siswa' => $siswa->nama,
                        'kd' => $kd->kd_kelas,
                        'data' => $data
                    ]);
                }
            }

            return response()->json($siswa2);
        } else {
            
            $kd = Kelas::select('kd_kelas')->where([
                ['kd_tingkatan', '003'],
                ['kd_jurusan', $siswa->kelas->jurusan->kd_jurusan]
            ])->first();
            $siswa2 = Siswa::where('kd_kelas', $kd->kd_kelas)->count();
            $check = Kelas::select('kd_ruangan')->where('kd_kelas', $kd->kd_kelas);
            $sql = Ruangan::whereHas('kelas', function ($query) use ($check) {
            $query->whereIn('kd_ruangan', $check);
            })->get();
            
            foreach ($sql as $key ) {
                if ($siswa2 == $key->kapasitas) {
                    $kelas = Kelas::where([
                        ['kd_tingkatan', '003'],
                        ['kd_jurusan', $siswa->kelas->jurusan->kd_jurusan]
                    ]);
                    $count = $kelas->count();
                    $kd = $kelas->latest('kd_kelas')->first();

                    if ($siswa2 == $key->kapasitas && $count < 2) {
                        return response()->json('penuh');
                    } else {
                        Siswa::where('nis', $id)
                        ->update([
                            'kd_kelas' => $kd->kd_kelas,
                        ]);
                    $guru = Guru::select('id_guru')
                        ->where('email', Auth::user()->email)
                        ->first();
                    $walikelas = Walikelas::where('id_guru', $guru->id_guru)->first();
                    $siswa2 = Siswa::where('kd_kelas', $walikelas->kd_kelas)->get();
                    return response()->json([
                        'siswa' => $siswa,
                        'kd' => $kd->kd_kelas,
                        'siswa2' => $siswa2
                    ]);
                    }
                    
                
                } else {
                    Siswa::where('nis', $id)
                        ->update([
                            'kd_kelas' => $kd->kd_kelas,
                        ]);
                    $guru = Guru::select('id_guru')
                        ->where('email', Auth::user()->email)
                        ->first();
                    $walikelas = Walikelas::where('id_guru', $guru->id_guru)->first();
                    $data = Siswa::where('kd_kelas', $walikelas->kd_kelas)->get();
                    return response()->json([
                        'siswa' => $siswa->nama,
                        'kd' => $kd->kd_kelas,
                        'data' => $data
                    ]);

                    
                }
            }
            // return response()->json($siswa2);
        }
        

    }

    public function riwayat()
    {
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;
        $tahun = TahunAkademik::all();
        if (Auth::user()->id_level_user == 6) {
            $walikelas = Walikelas::all();
            return view('/laporan_nilai/riwayat', compact('sql_menu', 'menu', 'tahun', 'walikelas'));
        }
        $guru = Guru::select('id_guru')
            ->where('email', Auth::user()->email)
            ->first();
        $walikelas = Walikelas::where('id_guru', $guru->id_guru)->first();
        
        if ($walikelas != null) {
            $siswa = Siswa::where('kd_kelas', $walikelas->kd_kelas)->get();
            $walikelas = Walikelas::where('id_guru', $guru->id_guru)->get();
            
            return view('/laporan_nilai/riwayat', compact('sql_menu', 'menu', 'tahun', 'walikelas', 'siswa'));
        }

        return view('/laporan_nilai/riwayat', compact('sql_menu', 'menu', 'tahun'));
    }

    public function nilai($nis)
    {
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;

        $siswa = Siswa::where('nis', $nis)->first();
        $nilai = Nilai::where('nis', $nis)->get();

        return view('/laporan_nilai/nilai', compact('menu', 'sql_menu', 'nilai', 'siswa'));
    }
}
