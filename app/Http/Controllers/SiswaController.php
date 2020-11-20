<?php

namespace App\Http\Controllers;

use App\Jurusan;
use App\Kelas;
use App\Ruangan;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends DashboardBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $siswa = Siswa::all();

        return view('/siswa/index', compact('sql_menu', 'menu', 'siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;
        $kelas = kelas::all();
        foreach ($kelas as $key ) {
            $class = Kelas::select('kd_ruangan')->where('kd_kelas', $kelas);
            $sql = Ruangan::whereHas('kelas', function ($query) use ($class) {
            $query->whereIn('kd_ruangan', $class);
            })->get();
    
            return view('/siswa/create', compact('sql_menu', 'menu'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        

        $siswa = Siswa::create($this->validateRequest());
        
        $this->storeImage($siswa);

        User::create([
            'nama_lengkap' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_level_user' => 5,
        ]);
        

        return redirect()->action('SiswaController@index')->with('store', 'Data Siswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nis)
    {
        $siswa = Siswa::where('nis', $nis)->get();
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;

        return view('/siswa/show', compact('siswa', 'sql_menu', 'menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;

        // dd($agama);
        return view('/siswa/edit', compact('siswa', 'sql_menu', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nis)
    {
        $siswa = Siswa::where('nis', $nis);
        $siswa->update($this->validateRequest());
        $this->storeImage($siswa);

        User::where('email', $request->email)
            ->update([
                'email' => $request->email,
                'password' => Hash::make($request->password)
        ]);

        return redirect()->action('SiswaController@index')->with('update', 'Data Siswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nis)
    {
        Siswa::destroy($nis);

        return redirect()->action('SiswaController@index');
    }

    public function viewAktif()
    {
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;
        $siswa = Siswa::all();
        $jurusan = Jurusan::all();

        return view('/siswa/aktif', compact('sql_menu', 'menu', 'siswa', 'jurusan'));
    }

    public function kelas($kelas)
    {
        $count = Siswa::where('kd_kelas', $kelas)->count();
        $class = Kelas::select('kd_ruangan')->where('kd_kelas', $kelas);
        $sql = Ruangan::whereHas('kelas', function ($query) use ($class) {
        $query->whereIn('kd_ruangan', $class);
        })->get();
        foreach ($sql as $key ) {
            if ($count == $key->kapasitas) {
                return response()->json('false');
            }
        }

        return response()->json($sql);
    }

    public function validateRequest()
    {
        return tap(request()->validate([
            'nama'          => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'kd_agama'      => 'required',
            'alamat_siswa'  => 'required',
            'no_telp_siswa' => 'required',
            'sekolah_asal'  => 'required',
            'no_ijazah'     => 'required',
            'nama_ayah'     => 'required',
            'nama_ibu'      => 'required',
            'alamat_ortu'   => 'required',
            'no_telp_ortu'  => 'required',
            'kd_kelas'      => 'required',
            'status_siswa'  => 'required',
            'email'         => 'required',
            'password'      => 'required',
        ]), function(){
            if (request()->hasFile('foto')){
            request()->validate([
                'foto' => 'required|image',
            ]);
        }
        });
    }

    public function storeImage($siswa)
    {
        if(request()->has('foto')){
            $siswa->update([
                'foto' => Storage::put('Siswa', request()->foto),
            ]);
        }
    }
    

}
