<?php

namespace App\Http\Controllers;

use App\LevelUser;
use App\Menu;
use App\User;
use App\UserRule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends DashboardBaseController
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
        $user = User::all();

        return view('/user/index', compact('sql_menu', 'menu', 'user'));
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
        $user = User::all();
        $level = LevelUser::all();

        return view('/user/create', compact('sql_menu', 'menu', 'user', 'level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nama_lengkap'  => 'required',
            'email'         => 'required',
            'password'      => 'required',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_level_user' => $request->id_level_user,
        ]);

        if (request()->has('foto')) {
            User::create([
                'foto' => Storage::put('Siswa', request()->foto),
            ]);
        }

        return redirect()->action('UserController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;
        $decrypt =
            $user = LevelUser::all();

        return view('/user/rule', compact('sql_menu', 'menu', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;
        $user = User::where('id', $id)->first();
        $level = LevelUser::all();

        return view('/user/edit', compact('sql_menu', 'menu', 'user', 'level'));
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
        // dd($request);
        request()->validate([
            'nama_lengkap'  => 'required',
            'email'         => 'required',
        ]);


        User::where('id', $id)
            ->update([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
            ]);

        if (request()->has('password')) {
            User::where('id', $id)
                ->update([
                    'password' => Hash::make($request->password)
                ]);
        }

        if (request()->has('foto')) {
            User::where('id', $id)
                ->update([
                    'foto' => Storage::put('Siswa', request()->foto)
                ]);
        }

        return redirect()->action('UserController@index')->with('update', 'Data User Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->action('UserController@index');
    }

    public function rule()
    {
        $menu = $this->view[0]->menu;
        $sql_menu = $this->view[0]->sql_menu;
        $level = LevelUser::all();
        $modul = Menu::select('id', 'nama_menu', 'link')->with('rule')->get();

        return view('/user/rule', compact('sql_menu', 'menu', 'level', 'modul'));
    }

    public function level($level)
    {
        $modul = Menu::select('id', 'nama_menu', 'link')->get();
        $collection = UserRule::select('id_menu')->where('id_level_user', $level);
        $count = Menu::whereHas('rule', function ($query) use ($collection) {
            $query->whereIn('id', $collection);
        })->select('id')->get();

        return response()->json([
            'modul'  => $modul,
            'count' => $count
        ]);
    }

    public function uprule($level, $id)
    {
        $rule = UserRule::select()->where([
            ['id_level_user', $level],
            ['id_menu', $id]
        ])->first();
        if (UserRule::where([
                ['id_level_user', $level],
                ['id_menu', $id]
            ])->exists()) {
                UserRule::where([
                ['id_level_user', $level],
                ['id_menu', $id]
            ])->delete();
            return response()->json('Ada');
        }
        UserRule::create([
                'id_level_user' => $level,
                'id_menu' => $id
            ]);
        return response()->json('Kosong');

    }
}
