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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('/users', 'UsersController');
    Route::resource('/instansi', 'InstansiController');
    Route::get('/login', 'UsersController@indexlogin')->name('login');
    Route::post('/login', 'UsersController@login')->name('login');
    Route::get('/logout', 'UsersController@logout')->name('logout');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::resource('/mahasiswa', 'MahasiswaController');
    Route::resource('/pengumuman', 'PengumumanController');
    Route::resource('/periode', 'PeriodeController');


});

Route::get('/admin/login', 'UsersController@indexlogin')->name('login');
Route::post('/admin/login', 'UsersController@login')->name('login');

Route::group(['middleware' => ['auth:web'], 'prefix' => 'mahasiswa'],
    function () {
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('/index', 'dashboardController@indexmahasiswa');
    Route::get('/profile', 'MahasiswaController@indexmahasiswa');
    Route::post('/profile/{id}', 'MahasiswaController@updateAvatar');
    Route::get('/editprofil/{id}', 'MahasiswaController@edit');
    // Route::put('/editprofil/{id_mahasiswa}', 'MahasiswaController@update');
    Route::get('/pengumuman', 'PengumumanController@indexmahasiswa');
    Route::get('/indexlowongan', 'LowonganController@indexmahasiswa');
    Route::get('/laporanharian', 'LaporanHarianController@index');
    Route::get('/buatkelompok', 'KelompokController@index');

    Route::get('/editlaporanharian/{id}', 'LaporanHarianController@edit');
    Route::delete('/laporanharian/{id}', ['as' => 'laporanharian.destroy', 'uses' => 'LaporanHarianController@destroy']);
    Route::get('/laporan/create', ['as' => 'laporan.create', 'uses' => 'LaporanAkhirController@create']);
    Route::get('/laporanpkl', 'LaporanAkhirController@index');

    Route::get('/laporanpkl/create', ['as' => 'laporanpkl.create', 'uses' => 'LaporanAkhirController@create']);
    Route::get('/editlaporanpkl/{id}', 'LaporanAkhirController@edit');
    Route::delete('/laporanpkl/{id}', ['as' => 'laporanpkl.destroy', 'uses' => 'LaporanAkhirController@destroy']);

    Route::get('/indexusulan', 'UsulanController@index');
    Route::get('/indexusulan/create', ['as' => 'usulan.create', 'uses' => 'UsulanController@create']);
    Route::get('/editusulan/{id}', 'UsulanController@edit');
    Route::delete('/indexusulan/{id}', ['as' => 'usulan.destroy', 'uses' => 'LaporanAkhirController@destroy']);

    Route::put('/editlaporanpkl/{id_laporan}', 'LaporanAkhirController@update');
    Route::get('/ubah_password', 'MahasiswaController@showchangePassword');

    Route::get('/namakelompok/create', ['as' => 'kelompok.create', 'uses' => 'KelompokController@create']);

    Route::get('/buatkelompok', 'KelompokController@datamahasiswa');
    Route::get('/namakelompok', 'KelompokController@datamahasiswa2');


    Route::get('/mahasiswa', ['as' => 'mahasiswa.index', 'uses' => 'MahasiswaController@index']);

    Route::get('/daftaranggota/{id}', 'DetailKelompokController@daftaranggota');
    
    // Route::get('/daftaranggota/hapus/{id}', 'DetailKelompokController@kick');

    Route::get('/detailkelompok', 'DetailKelompokController@show');
    Route::get('/indexkelompok', 'KelompokController@riwayatkelompok');

    Route::get('/indexpenilaian', 'NilaiController@show');

    Route::post('/nilai/{id_mahasiswa}', 'NilaiController@update')->name('nilai-mahasiswa');

    Route::get('/lamaran', 'LamaranController@index');
    Route::get('/applylowongan/{id_lowongan}', 'LowonganController@show');
    Route::get('/applylowongan', 'LowonganController@lamar');


    Route::get('/formnilai/{id}', 'NilaiController@edit');

    Route::get('/indexpenilaian/{id_mahasiswa}', 'NilaiController@getNilai');
});


Route::get('/admin', 'Mah@admin')->name('/admin');

Route::get('/daftar_mahasiswa', 'Mah@index')->name('/daftar_mahasiswa');
Route::get('/detail_mahasiswa', 'Mah@index1')->name('/detail_mahasiswa');
Route::get('/daftar_dosen', 'Mah@index2')->name('/daftar_dosen');
Route::get('/detail_dosen', 'Mah@showdosen')->name('/detail_dosen');
Route::get('/daftar_partner', 'Mah@indexpartner')->name('/daftar_partner');
Route::get('/detail_partner', 'Mah@showpartner')->name('/detail_partner');
Route::get('/persetujuan_kelompok', 'Mah@indexpkelompok')->name('/persetujuan_kelompok');
Route::get('/usulan_pkl', 'Mah@UsulanPKL')->name('/usulan_pkl');
Route::get('/detail_usulan', 'Mah@detailUsulan')->name('/detail_usulan');
//Route::get('/detailKelompok', 'Mah@detailKelompok')->name('/detailKelompok');
Route::get('/periodeListing', 'Mah@periodeListing')->name('/periodeListing');
Route::get('/add_new_periode', 'Mah@AddNewPeriode')->name('/add_new_periode');
Route::get('/edit_periode', 'Mah@EditPeriode')->name('/edit_periode');
Route::get('/magangListing', 'Mah@magangListing')->name('/magangListing');
Route::get('/detailMagang', 'Mah@detailMagang')->name('/detailMagang');
Route::get('/presentasi_kelompok', 'Mah@presentasiKelompok')->name('/presentasi_kelompok');
Route::get('/add_presentasi', 'Mah@addpresentasiKelompok')->name('/add_presentasi');
Route::get('/edit_presentasi', 'Mah@editpresentasiKelompok')->name('/edit_presentasi');
Route::get('/adlowongan', 'Mah@lowonganPKL')->name('/adlowongan');
Route::get('/detail_lowongan', 'Mah@detaillowonganPKL')->name('/detail_lowongan');
Route::get('/add_lowongan', 'Mah@addlowonganPKL')->name('/add_lowongan');
Route::get('/edit_lowongan', 'Mah@editlowonganPKL')->name('/edit_lowongan');


//MAHASISWA

Route::get('/index', function () {
    return view('mahasiswa.index');
});
Route::get('/dashboard', function () {
    return view('mahasiswa.index');
});
Route::get('/ubah_password', function () {
    return view('mahasiswa.ubah_password');
});
Route::get('/profile', function () {
    return view('mahasiswa.profil.profile');
});

Route::get('/editprofil', function () {
    return view('mahasiswa.profil.editprofil');
});

Route::get('/buatkelompok', function () {
    return view('mahasiswa.kelompok.buatkelompok');
});

Route::get('/namakelompok', function () {
    return view('mahasiswa.kelompok.namakelompok');
});

Route::get('/tambahanggota', function () {
    return view('mahasiswa.tambahanggota');
});

Route::get('/indexusulan', function () {
    return view('mahasiswa.usulan.indexusulan');
});

Route::get('/editusulan', function () {
    return view('mahasiswa.usulan.editusulan');
});
Route::get('/tambahusulan', function () {
    return view('mahasiswa.usulan.tambahusulan');
});
// Route::get('/indexlowongan', function () {
//     return view('mahasiswa.lowongan.indexlowongan');
// });
Route::get('/applylowongan', function () {
    return view('mahasiswa.lowongan.applylowongan');
});
Route::get('/editanggota', function () {
    return view('mahasiswa.editanggota');
});
Route::get('/indexpenilaian', function () {
    return view('mahasiswa.penilaian.indexpenilaian');
});
Route::get('/formnilai', function () {
    return view('mahasiswa.penilaian.formnilai');
});
Route::get('/editnilai', function () {
    return view('mahasiswa.penilaian.editnilai');
});

Route::get('/editlaporanharian', function () {
    return view('mahasiswa.editlaporanharian');
});
Route::get('/editlaporanpkl', function () {
    return view('mahasiswa.editlaporanpkl');
});
Route::get('/tambahlaporanharian', function () {
    return view('mahasiswa.tambahlaporanharian');
});
Route::get('/tambahlaporanpkl', function () {
    return view('mahasiswa.laporan.tambahlaporanpkl');
});
Route::get('/lihatlaporanpkl', function () {
    return view('mahasiswa.lihatlaporanpkl');
});

Route::get('/laporanharian', function () {
    return view('mahasiswa.laporanharian');
});
Route::get('/laporanpkl', function () {
    return view('mahasiswa.laporan.laporanpkl');
});
Route::get('/pengumuman', 'PengumumanController@indexmahasiswa');
// Route::get('/indexlowongan', 'LowonganController@indexmahasiswa');

Route::get('/login', function () {
    return view('mahasiswa.login');
});
Route::get('/tambahanggotakelompok', function () {
    return view('mahasiswa.tambahanggotakelompok');
});
// Route::get('/detailkelompok', function () {
//     return view('mahasiswa.kelompok.detailkelompok');
// });

Route::get('/indexkelompok', function () {
    return view('mahasiswa.kelompok.indexkelompok');
});


Route::get('/applylowongan', function () {
    return view('mahasiswa.lowongan.applylowongan');
});
Route::get('/lowongan', function () {
    return view('mahasiswa.lowongan.lamaran');
});



