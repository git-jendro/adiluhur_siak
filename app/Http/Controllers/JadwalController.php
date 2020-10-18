<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Jadwal;
use App\Jurusan;
use App\Kelas;
use App\Kurikulum;
use App\KurikulumDetail;
use App\Ruangan;
use App\TahunAkademik;
use App\TingkatanKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends DashboardBaseController
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
        $jadwal = Jadwal::all();
        $kurikulum = Kurikulum::all();
        $guru = Guru::all();
        $ruangan = Ruangan::all();
        $jurusan = Jurusan::all();
        $tingkatan = TingkatanKelas::all();
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;

        return view('/jadwal/index', compact('menu', 'sql_menu','jadwal', 'kurikulum','jurusan', 'tingkatan'));
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
        $kurikulum = KurikulumDetail::where('id_kurikulum', $request->id_kurikulum)->get();
        
        $tahun = TahunAkademik::where('is_aktif', TRUE)->first();
        foreach ($kurikulum as $k) {
            $kelas = Kelas::where([
                ['kd_jurusan', $k->kd_jurusan],
                ['kd_tingkatan', $k->kd_tingkatan],
            ])->first();

                Jadwal::create([

                    'id_tahun_akademik' => $tahun->id_tahun_akademik,
                    'semester'			=> $request->semester,
                    'kd_jurusan'		=> $k->kd_jurusan,
                    'kd_tingkatan'		=> $k->kd_tingkatan,
                    'kd_kelas'			=> $kelas->kd_kelas,
                    'kd_mapel'			=> $k->kd_mapel,
                    'id_guru'			=> '0',
                    'jam'				=> '',
                    'kd_ruangan'		=> '000',
                    'hari'				=> ''
                ]);
        }
        return redirect()->action('JadwalController@index');
        
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
    public function edit($id)
    {
        //
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
        DB::table('tbl_jadwal')->where('id_jadwal', $id)->delete();

        return redirect()->action('JadwalController@index');
    }

    public function kelas($jurusan, $tingkatan)
    {
        $data = Kelas::where([
            ['kd_jurusan', $jurusan],
            ['kd_tingkatan', $tingkatan]
        ])->get();
        
        return response()->json($data);
    }

    public function mapel($tingkatan, $kelas)
    {
        $jadwal = Jadwal::where([
            ['kd_tingkatan', $tingkatan],
            ['kd_kelas', $kelas],
        ])->with('mapel', 'guru', 'ruangan')->get();

        $guru = Guru::all();

        $ruangan = Ruangan::all();
        
        return response()->json([
            'jadwal' => $jadwal, 
            'guru' => $guru,
            'ruangan' => $ruangan
        ]);
    }
    public function guru($guru, $id)
    {
        $data = Jadwal::where('id_jadwal', $id)
        ->update([
            'id_guru' => $guru
        ]);

        return response()->json($data);
    }

    public function ruangan($ruangan, $id)
    {
        $data = Jadwal::where('id_jadwal', $id)
        ->update([
            'kd_ruangan' => $ruangan
        ]);

        return response()->json($ruangan);
    }

    public function hari($hari, $id)
    {
        $data = Jadwal::where('id_jadwal', $id)
        ->update([
            'hari' => $hari
        ]);

        return response()->json($data);
    }

    public function jam($jam, $id)
    {
        $data = Jadwal::where('id_jadwal', $id)
        ->update([
            'jam' => $jam
        ]);

        return response()->json($data);
    }

}
