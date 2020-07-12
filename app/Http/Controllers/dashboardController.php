<?php

namespace App\Http\Controllers;


use App\User;
use App\Admin;
use Carbon\Carbon;
use App\Periode;
use App\Kelompok;
use App\Usulan;
use App\Mahasiswa;
use DB;
use App\DetailKelompok;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class dashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $user= User::where(['api_token'=>$request->api_token])->first();

        return response()->json([
            'user' =>$user,
            'code' => 200,
        ], 200);
    }

    public function usersmahasiswa()
    {
        
        $user= Auth::user()->load('mahasiswa');
        return response()->json([
            'user' =>$user,
            'message' => "succes",
        ]);
    }


    public function indexmahasiswa(){

        $periode = Periode::where('status', 'open')->first();
        $date = Carbon::now()->translatedFormat('l, d F Y');

       
        
        return view('mahasiswa.index', compact('periode','date'));
    }




    public function kelompokCount()
    {
        $userId = Auth::id();
        $idMahasiswa = Mahasiswa::select('id_mahasiswa')
                                ->where('id_users', $userId)->first();
        $idKelompok = DetailKelompok::join('kelompok','kelompok_detail.id_kelompok','kelompok.id_kelompok')
                                ->select('kelompok_detail.id_kelompok', 'kelompok_detail.isDeleted')
                                ->where('kelompok.tahap', '!=', 'ditolak')
                                ->orderBy('id_kelompok', 'desc')
                                ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)->first();
        if(!$idKelompok&&empty($idKelompok) || $idKelompok->isDeleted == 1 ){
            return response()->json([
            'jumlah' => 0,
            'message' => 'success',
            ]);
        }else{
        $data = Kelompok::join('kelompok_detail', 'kelompok.id_kelompok', 'kelompok_detail.id_kelompok')
                            ->where('kelompok_detail.id_kelompok', $idKelompok->id_kelompok)
                            ->where('kelompok_detail.isDeleted', '!=', '1')
                            ->where(function($q) {
                                $q->where('kelompok_detail.status_join', 'create')
                                ->orWhere('kelompok_detail.status_join', 'diinvite')
                                ->orWhere('kelompok_detail.status_join', 'diterima');
                            })
                            ->count();
                        }
        return response()->json([
            'jumlah' => $data,
            'message' => "succes",
        ]);
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
        //
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
        //
    }
}
