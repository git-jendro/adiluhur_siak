<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Jadwal;
use App\Nilai;
use App\Siswa;
use App\TahunAkademik;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends DashboardBaseController
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
        $tahun = TahunAkademik::where('is_aktif', 'Y')->first();
        $guru = Guru::select('id_guru')
            ->where('email', Auth::user()->email)
            ->first();
        $jadwal = Jadwal::where('id_guru', $guru->id_guru)->get();

        return view('/nilai/index', compact('sql_menu', 'menu', 'jadwal', 'tahun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_jadwal)
    {
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;
        $tahun = TahunAkademik::where('is_aktif', 'Y')->first();
        $jadwal = Jadwal::where('id_jadwal', $id_jadwal)->first();
        // $siswa = Siswa::where('kd_kelas', $jadwal->kd_kelas)->get();
        $nilai = Nilai::where('id_jadwal', $id_jadwal)->get();

        return view('/nilai/edit', compact('sql_menu', 'menu', 'jadwal', 'tahun', 'nilai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function nilai($id, $tugas, $uts, $uas)
    {
        Nilai::where('id_nilai', $id)
            ->update([
                'nilai_tugas'   => $tugas,
                'nilai_uts'     => $uts,
                'nilai_uas'     => $uas,
                'nilai'         => (0.3*$tugas) + (0.3*$uts) + (0.4*$uas)
            ]);
        
        $nilai = Nilai::where('id_nilai', $id)->get();
        
        return response()->json($nilai);
    }

    public function print($nis)
    {
        $tahun = TahunAkademik::where('is_aktif', 'Y')->first();
        $siswa = Siswa::where('nis', $nis)->first();
        $nilai = Nilai::where('nis', $nis)->get();

        $pdf = PDF::loadview('nilai/print', compact('nilai', 'siswa', 'tahun'));
    	return $pdf->download('laporan-nilai-pdf');
        // return view('nilai/print', compact('nilai', 'siswa', 'tahun'));
    }
}
