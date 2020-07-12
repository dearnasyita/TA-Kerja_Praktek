<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Mahasiswa;
use App\DetailKelompok;
use App\Lamaran;

use Illuminate\Http\Request;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // Get id user from Auth
        $userId = Auth::id();

        $idMahasiswa = Mahasiswa::select('id_mahasiswa')
            ->where('id_users', $userId)->first();

        $idKelompok = DetailKelompok::select('kelompok_detail.id_kelompok')
            ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
            ->where('kelompok_detail.isDeleted', '=', '0')
            ->orderBy('id_kelompok', 'desc')
            ->first();
        
        $lamaran = Lamaran::get();
        if (request()->ajax()) {

            $data = [];
            if ($idKelompok){
                $data = Lamaran::where('id_kelompok',$idKelompok->id_kelompok)
                    ->join('lowongan','lowongan.id_lowongan','pelamar.id_lowongan')
                    ->join('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                    ->select('pelamar.status','instansi.nama','lowongan.pekerjaan')
                    ->get();
                }

            return datatables()->of($data)->addIndexColumn()
            ->addIndexColumn()
            ->make(true);
        }
        return view('mahasiswa.lowongan.lamaran', compact('lamaran'));
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
