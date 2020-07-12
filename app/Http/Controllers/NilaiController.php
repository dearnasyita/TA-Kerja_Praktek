<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Validation\Validator;
use App\Nilai;
use App\Mahasiswa;
use App\Periode;
use App\DetailKelompok;
use App\Kelompok;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show()
    {

        $userId = Auth::id();
        
        $idMahasiswa = Mahasiswa::select('id_mahasiswa')
                                ->where('id_users', $userId)->first();
        
        $idKelompok = DetailKelompok::join('kelompok','kelompok_detail.id_kelompok','kelompok.id_kelompok')
                                ->select('kelompok_detail.id_kelompok', 'kelompok.nama_kelompok')
                                ->where('kelompok_detail.isDeleted', '=', '0')
                                ->where('kelompok.tahap', '!=', 'ditolak')
                                ->orderBy('id_kelompok', 'desc')
                                ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)->first();
        
        $data = [];
        if ($idKelompok){
                $data = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                                    ->LeftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                                    ->select('kelompok.id_kelompok','mahasiswa.id_mahasiswa','mahasiswa.nama','kelompok_detail.status_keanggotaan','mahasiswa.nim')
                                    ->where('kelompok_detail.id_kelompok', $idKelompok->id_kelompok)
                                    ->where('kelompok_detail.status_join', '!=', 'ditolak')
                                    ->where('kelompok_detail.isDeleted', '!=', '1')
                                    ->get();
                        }

       return view('mahasiswa.penilaian.indexpenilaian',compact('data','userId'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_mahasiswa)
    {
        $anggota = Mahasiswa::findOrFail($id_mahasiswa);
        $userId = Auth::id();
        return view('mahasiswa.penilaian.formnilai', compact('anggota','userId'));
    }

    public function store(Request $request)
    { 
        $periode=Periode::where(['status'=>'open'])->first();
        $userId = Auth::id();

        foreach($request->id_aspek_penilaian as $key => $value)
        {
            $model = new Nilai;
            $model->id_aspek_penilaian = $value;
            $model->nilai = $request->nilai[$key];
            $model->id_periode = $periode->id_periode;
            $model->id_kelompok_penilai=$request->id_kelompok_penilai;
            $model->id_mahasiswa = $request->id_mahasiswa;
            $model->created_by= $request->created_by;
            $model->save();
        
    }

        return response()->json(['message' => 'Nilai berhasil ditambahkan.']);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_mahasiswa)
    {
        $nilai=Nilai::find($id);
        if(is_null($nilai)){
            return response()->json(['messege'=>'record not found', 400]);
        }
        $nilai->update($request->all());
        return response()->json($nilai, 200);
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
