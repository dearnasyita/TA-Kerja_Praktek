<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Acces-Control-Request-Method, Authorization");
header("Acces-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('mahasiswa')->group(function () {
        Route::group(['middleware' => 'auth:api'], function(){
        Route::get('/userlogin', 'dashboardController@usersmahasiswa');
        Route::get('/jumlahmahasiswa','dashboardController@kelompokCount');
    });
    Route::post('/pengumuman/{id}', 'PengumumanController@indexmahasiswa');
    Route::get('/pengumuman', 'PengumumanController@show');
    Route::put('/editlaporanharian/{id}/edit', 'LaporanHarianController@update');
    Route::post('/editprofil/{id}/edit', 'MahasiswaController@update');
    Route::delete('/laporanharian/{id}', 'LaporanHarianController@destroy');
    Route::post('/laporanharian', 'LaporanHarianController@store');
    Route::post('/laporan/tambahlaporanpkl', 'LaporanAkhirController@store');
    Route::post('/editlaporanpkl/{id}/edit', 'LaporanAkhirController@update');
    Route::get('/laporanpkl/{id}', 'LaporanAkhirController@edit');
    Route::get('/showlaporan', 'LaporanAkhirController@show');
    Route::apiResource('nilai','NilaiController');
    Route::post('/penilaian/formnilai', 'NilaiController@store');
    Route::post('/usulan/tambahusulan', 'UsulanController@store');
    Route::post('/editusulan/{id}/edit', 'UsulanController@update');
    Route::get('/showsurat', 'UsulanController@show');
    Route::post('/changepassword/{id}/', 'UsersController@updatePassword');
    Route::post('/profile/{id}/edit', 'MahasiswaController@updateAvatar');
    Route::post('/lowongan/applylowongan', 'LowonganController@lamarLowongan');
    Route::get('/applylowongan/{id}', 'LowonganController@show');
    Route::post('/kelompok/buatkelompok', 'KelompokController@store');
    Route::post('/kelompok/namakelompok', 'KelompokController@store');
    Route::post('/kelompok/daftaranggota', 'DetailKelompokController@daftaranggota');
    Route::post('/kelompok/addanggota', 'KelompokController@addAnggota');
    Route::get('/daftaranggota/hapus/{id}', 'DetailKelompokController@kick');
    Route::get('/profile/hapuscv/{id}', 'MahasiswaController@hapusCV');

});


Route::get('pengumumanApi','PengumumanController@indexmahasiswa');

Route::post('login', function(Request $request){
    if(auth()->attempt(['username' => $request->input('username'), 'password' => $request->input('password')]))
    {
        $user = auth()->user();
        $user->api_token = str_random(60);
        $user->save();
        return $user;
    }
    return response()->json([
        'error' =>'error bung',
        'code' => 401,
    ], 401);
});

Route::get('/dashboard', 'dashboardController@index');