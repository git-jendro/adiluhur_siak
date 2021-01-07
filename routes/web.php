<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', 'HomeController@index')->middleware('auth');;
Route::get('/home', 'HomeController@index')->middleware('auth');;

// Route Siswa
Route::get('/siswa', 'SiswaController@index');
Route::get('/siswa/create', 'SiswaController@create');
Route::post('/siswa/store', 'SiswaController@store');
Route::get('/siswa/aktif', 'DidikController@index');
// Route::get('/didik/{jurusan}', 'SiswaController@kelas');
Route::get('/siswa/{nis}', 'SiswaController@show');
Route::get('/siswa/{nis}/edit', 'SiswaController@edit');
Route::delete('/siswa/{nis}', 'SiswaController@destroy');
Route::patch('/siswa/{nis}', 'SiswaController@update');
Route::get('/siswa/kelas/{kelas}', 'SiswaController@kelas');


// Route Guru;
Route::get('/guru', 'GuruController@index');
Route::get('/guru/create', 'GuruController@create');
Route::post('/guru/store', 'GuruController@store');
Route::get('/guru/{id_guru}', 'GuruController@show');
Route::get('/guru/{id_guru}/edit', 'GuruController@edit');
Route::delete('/guru/{id_guru}', 'GuruController@destroy');
Route::patch('/guru/{id_guru}', 'GuruController@update');

// Route Mapel;
Route::get('/mapel', 'MapelController@index');
Route::get('/mapel/create', 'MapelController@create');
Route::post('/mapel/store', 'MapelController@store');
Route::get('/mapel/{kd_mapel}', 'MapelController@show');
Route::get('/mapel/{kd_mapel}/edit', 'MapelController@edit');
Route::delete('/mapel/{kd_mapel}', 'MapelController@destroy');
Route::patch('/mapel/{kd_mapel}', 'MapelController@update');

// Route Ruangan;
Route::get('/ruangan', 'RuanganController@index');
Route::get('/ruangan/create', 'RuanganController@create');
Route::post('/ruangan/store', 'RuanganController@store');
Route::get('/ruangan/{kd_ruangan}', 'RuanganController@show');
Route::get('/ruangan/{kd_ruangan}/edit', 'RuanganController@edit');
Route::delete('/ruangan/{kd_ruangan}', 'RuanganController@destroy');
Route::patch('/ruangan/{kd_ruangan}', 'RuanganController@update');

// Route Tingkat Kelas;
Route::get('/tingkatan', 'TingkatanController@index');
Route::get('/tingkatan/create', 'TingkatanController@create');
Route::post('/tingkatan/store', 'TingkatanController@store');
Route::get('/tingkatan/{kd_tingkatan}', 'TingkatanController@show');
Route::get('/tingkatan/{kd_tingkatan}/edit', 'TingkatanController@edit');
Route::delete('/tingkatan/{kd_tingkatan}', 'TingkatanController@destroy');
Route::patch('/tingkatan/{kd_tingkatan}', 'TingkatanController@update');

// Route Jurusan;
Route::get('/jurusan', 'JurusanController@index');
Route::get('/jurusan/create', 'JurusanController@create');
Route::post('/jurusan/store', 'JurusanController@store');
Route::get('/jurusan/{kd_jurusan}', 'JurusanController@show');
Route::get('/jurusan/{kd_jurusan}/edit', 'JurusanController@edit');
Route::delete('/jurusan/{kd_jurusan}', 'JurusanController@destroy');
Route::patch('/jurusan/{kd_jurusan}', 'JurusanController@update');

// Route Tahun Akademik;
Route::get('/tahunakademik', 'TahunAkademikController@index');
Route::get('/tahunakademik/create', 'TahunAkademikController@create');
Route::patch('/tahunakademik/aktif/{id_tahun_akademik}', 'TahunAkademikController@aktif');
Route::get('/tahunakademik/{id_tahun_akademik}', 'TahunAkademikController@edit');
Route::patch('/tahunakademik/{id_tahun_akademik}', 'TahunAkademikController@update');
Route::post('/tahunakademik/store', 'TahunAkademikController@store');
Route::get('/tahunakademik/{id_tahun_akademik}/delete', 'TahunAkademikController@destroy');

// Route Kelas;
Route::get('/kelas', 'KelasController@index');
Route::get('/kelas/create', 'KelasController@create');
Route::post('/kelas/store', 'KelasController@store');
Route::get('/kelas/{kd_kelas}', 'KelasController@show');
Route::get('/kelas/{kd_kelas}/edit', 'KelasController@edit');
Route::delete('/kelas/{kd_kelas}', 'KelasController@destroy');
Route::patch('/kelas/{kd_kelas}', 'KelasController@update');

// Route Kurikulum;
Route::get('/kurikulum', 'KurikulumController@index');
Route::get('/kurikulum/create', 'KurikulumController@create');
Route::post('/kurikulum/store', 'KurikulumController@store');
Route::get('/kurikulum/{kd_kurikulum}', 'KurikulumController@show');
Route::get('/kurikulum/{kd_kurikulum}/edit', 'KurikulumController@edit');
Route::delete('/kurikulum/{kd_kurikulum}', 'KurikulumController@destroy');
Route::patch('/kurikulum/{kd_kurikulum}', 'KurikulumController@update');
 
// Route User;
Route::get('/user', 'UserController@index');
Route::get('/user/create', 'UserController@create');
Route::post('/user/store', 'UserController@store');
Route::get('/user/rule', 'UserController@rule');
Route::get('/user/rule/{level}', 'UserController@level');
Route::get('/user/uprule/{level}/{id}', 'UserController@uprule');
Route::get('/user/{id}/edit', 'UserController@edit');
Route::delete('/user/{id}', 'UserController@destroy');
Route::patch('/user/{id}', 'UserController@update');

// Route Kurikulum Detail;
Route::get('/kurikulum_detail', 'KurikulumDetailController@index');
Route::get('/kurikulum_detail/create', 'KurikulumDetailController@create');
Route::post('/kurikulum_detail/store', 'KurikulumDetailController@store');
Route::get('/kurikulum_detail/{id}', 'KurikulumDetailController@show');
Route::get('/kurikulum_detail/{id}/edit', 'KurikulumDetailController@edit');
Route::delete('/kurikulum_detail/{id}', 'KurikulumDetailController@destroy');
Route::patch('/kurikulum_detail/{id}', 'KurikulumDetailController@update');
Route::get('/kurikulum_detail/{kurikulum}/{tingkat_kelas}/{jurusan}', 'KurikulumDetailController@get');

// Route Didik;
Route::get('/didik', 'DidikDetailController@index');
Route::get('/didik/create', 'DidikDetailController@create');
Route::get('/didik/kelas/{jurusan}', 'KelasController@kelas');
Route::get('/didik/siswa/{kelas}', 'DidikController@siswa');
Route::post('/didik/store', 'DidikDetailController@store');
Route::get('/didik/{id}', 'DidikDetailController@show');
Route::get('/didik/{id}/edit', 'DidikDetailController@edit');
Route::delete('/didik/{id}', 'DidikDetailController@destroy');
Route::patch('/didik/{id}', 'DidikDetailController@update');

// Route Jadwal;
Route::get('/jadwal', 'JadwalController@index');
Route::get('/jadwal/create', 'JadwalController@create');
Route::post('/jadwal/store', 'JadwalController@store');
Route::get('/jadwal/kelas/{jurusan}/{tingkatan}', 'JadwalController@kelas');
Route::get('/jadwal/mapel/{tingkatan}/{kelas}', 'JadwalController@mapel');
Route::get('/jadwal/guru/{guru}/{id}', 'JadwalController@guru');
Route::get('/jadwal/ruangan/{ruangan}/{id}', 'JadwalController@ruangan');
Route::get('/jadwal/hari/{hari}/{id}', 'JadwalController@hari');
Route::get('/jadwal/jam/{jam}/{id}/{guru}/{ruangan}/{hari}', 'JadwalController@jam');
Route::get('/jadwal/{id_jadwal}/delete', 'JadwalController@destroy');

// Route Walikelas;
Route::get('/walikelas', 'WalikelasController@index');
Route::get('/walikelas/{guru}/{id}', 'WalikelasController@guru');
Route::get('/walikelas/{wali}', 'WalikelasController@riwayat');

// Route Menu;
Route::get('/menu', 'MenuController@index');
Route::get('/menu/create', 'MenuController@create');
Route::post('/menu/store', 'MenuController@store');
Route::get('/menu/{id}/edit', 'MenuController@edit');
Route::delete('/menu/{id}', 'MenuController@destroy');
Route::patch('/menu/{id}', 'MenuController@update');

// Route Nilai;
Route::get('/nilai', 'NilaiController@index');
Route::get('/nilai/{id_jadwal}', 'NilaiController@edit');
Route::get('/nilai/update/{id}/{tugas}/{uts}/{uas}', 'NilaiController@nilai');
Route::get('/nilai/print/{nis}', 'NilaiController@print');

// Route Laporan Nilai;
Route::get('/laporan_nilai', 'LaporanNilaiController@index');
Route::get('/laporan_nilai/kepsek_lihat', 'LaporanNilaiController@index');
Route::get('/laporan_nilai/riwayat', 'LaporanNilaiController@riwayat');
Route::get('/laporan_nilai/nilai/{nilai}', 'LaporanNilaiController@nilai');
Route::get('/laporan_nilai/{nis}', 'LaporanNilaiController@show');
Route::get('/laporan_nilai/kelas/{jurusan}', 'LaporanNilaiController@kelas');
Route::get('/laporan_nilai/siswa/{jurusan}', 'LaporanNilaiController@siswa');
Route::get('/laporan_nilai/naik/{id}', 'LaporanNilaiController@naik');
