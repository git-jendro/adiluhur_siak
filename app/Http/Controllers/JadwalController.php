<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Jadwal;
use App\Jurusan;
use App\Kelas;
use App\Kurikulum;
use App\KurikulumDetail;
use App\Nilai;
use App\Ruangan;
use App\Siswa;
use App\TahunAkademik;
use App\TingkatanKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $tahun = TahunAkademik::where('is_aktif', 'Y')->first();
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;
        if (Auth::user()->id_level_user == 1) {

            return view('/jadwal/index', compact('menu', 'sql_menu','jadwal', 'kurikulum','jurusan', 'tingkatan', 'tahun'));
            
        } elseif(Auth::user()->id_level_user == 5) {

            $siswa = Siswa::select('kd_kelas')
            ->where('email', Auth::user()->email)
            ->first();
            
            $jsiswa = Jadwal::where('kd_kelas', $siswa->kd_kelas)->get();

            return view('/jadwal/siswa', compact('menu', 'sql_menu','jsiswa', 'kurikulum','jurusan', 'tingkatan', 'tahun'));
            
        } else {
        }
        $guru = Guru::select('id_guru')
        ->where('email', Auth::user()->email)
        ->first();
        $jguru = Jadwal::where('id_guru', $guru->id_guru)->get();

        return view('/jadwal/guru', compact('menu', 'sql_menu','jguru', 'kurikulum','jurusan', 'tingkatan', 'tahun'));              
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

            $jadwal = new Jadwal;   
            $jadwal->id_tahun_akademik   = $tahun->id_tahun_akademik;
            $jadwal->semester	    = $request->semester;
            $jadwal->kd_jurusan	    = $k->kd_jurusan;
            $jadwal->kd_tingkatan    = $k->kd_tingkatan;
            $jadwal->kd_kelas	    = $kelas->kd_kelas;
            $jadwal->kd_mapel	    = $k->kd_mapel;
            $jadwal->id_guru		= '0';
            $jadwal->jam			=' ';
            $jadwal->kd_ruangan	    = '000';
            $jadwal->hari			= ' ';
            $jadwal->save();

            $id = DB::getPdo()->lastInsertId();;
            // dd($id);
            $siswa = Siswa::where('kd_kelas', $kelas->kd_kelas)->get();
            foreach ($siswa as $s) {
                $nilai = new Nilai;
                $nilai->id_jadwal   = $id;
                $nilai->nilai_tugas = 0;
                $nilai->nilai_uts   = 0;
                $nilai->nilai_uas   = 0;
                $nilai->nis         = $s->nis;
                // $nilai->nilai       = (0.3*$nilai->nilai_tugas) + (0.3*$nilai->nilai_uts) + (0.4*$nilai->nilai_uas);
                $nilai->nilai       = 38;
                $nilai->status      = "-";
                $nilai->save();   
            }

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

    public function mapel($tingkatan, $jurusan)
    {
        $jadwal = Jadwal::where([
            ['kd_tingkatan', $tingkatan],
            ['kd_jurusan', $jurusan],
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

    public function jam($jam, $id, $guru, $ruangan, $hari)
    {
        $data = Jadwal::all();
        $count = Jadwal::where([
            ['id_guru', $guru],
            ['kd_ruangan', $ruangan],
            ['hari', $hari],
            ['jam', $jam]
        ])->count();

        if ($count > 1) {
            return response()->json([
                'con' => 'gagal',
                'count' => $count,
                'data' => $data
                ]);
        }else{
            Jadwal::where('id_jadwal', $id)
        ->update([
            'jam' => $jam
        ]);
        }
        
        return response()->json([
                'con' => 'success',
                'count' => $count,
                'data' => $data,
                'guru' => $guru,
                'ruangan' => $ruangan,
                'hari' => $hari,
                ]);
        // }
    }

}