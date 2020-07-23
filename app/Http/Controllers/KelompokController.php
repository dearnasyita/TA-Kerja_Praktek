<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Validation\Validator;
use App\Kelompok;
use App\Periode;
use App\Dosen;
use App\Mahasiswa;
use App\DetailKelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function datamahasiswa2()
    {
        $userId = Auth::id();
                
        $idMahasiswa = Mahasiswa::select('id_mahasiswa')
                                ->where('mahasiswa.id_users', $userId)->first();
    
        $idKelompok = DetailKelompok::select('kelompok_detail.*' )
                                    ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
                                    ->orderBy('id_kelompok', 'desc')->first();

        
        $status = @Kelompok::select('kelompok.tahap')->where('id_kelompok', $idKelompok->id_kelompok)->first();


        $periode = Periode::select('id_periode')
                            ->where('status', 'open')->first();

        
        return view('mahasiswa.kelompok.namakelompok', compact('userId','status', 'idMahasiswa', 'idKelompok'));
    }

    public function datamahasiswa()
    {
        $userId = Auth::id();                
        $idMahasiswa = Mahasiswa::select('id_mahasiswa')
                                ->where('mahasiswa.id_users', $userId)->first();
                                
        $idKelompok = DetailKelompok::join('kelompok','kelompok_detail.id_kelompok','kelompok.id_kelompok')
                                    ->select('kelompok_detail.id_kelompok', 'kelompok.nama_kelompok')
                                    ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
                                    ->orderBy('id_kelompok', 'desc')->first();

        $periode = Periode::select('id_periode')
                            ->where('status', 'open')->first();

        $data1 = \DB::table('mahasiswa')
        ->join('kelompok_detail', 'kelompok_detail.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
        ->where('kelompok_detail.status_join', '!=', 'ditolak')
        ->where('kelompok_detail.isDeleted', "=", "0")
        ->select('mahasiswa.id_mahasiswa')
        ->get();
        $mahasiswa_memiliki_kelompok = $data1->pluck('id_mahasiswa');  
        $mahasiswa_memiliki_kelompok->all();

        $data2 = \DB::table('mahasiswa')
        ->join('kelompok_detail', 'kelompok_detail.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
        ->join('kelompok', 'kelompok.id_kelompok', '=', 'kelompok_detail.id_kelompok')
        ->where('kelompok_detail.status_join', '=', "create")
        ->where('kelompok.tahap', '!=', 'ditolak')
        ->select('mahasiswa.id_mahasiswa')
        ->get();
        $mahasiswa_menjadi_ketua = $data2->pluck('id_mahasiswa');
        $mahasiswa_menjadi_ketua->all();

        $data3 = \DB::table('mahasiswa')
        ->join('kelompok_detail', 'kelompok_detail.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
        ->where('kelompok_detail.status_join', "=", "diinvite")
        ->where('kelompok_detail.isDeleted', "=", "0")
        ->select('mahasiswa.id_mahasiswa')
        ->get();
        $mahasiswa_terinvite_users = $data3->pluck('id_mahasiswa');  
        $mahasiswa_terinvite_users->all();

        $mahasiswa_tersedia = \DB::table('mahasiswa')
        ->where('mahasiswa.id_periode', '=', $periode->id_periode)
        ->whereNotIn('mahasiswa.id_mahasiswa', $mahasiswa_memiliki_kelompok)
        ->whereNotIn('mahasiswa.id_mahasiswa', $mahasiswa_menjadi_ketua)
        ->whereNotIn('mahasiswa.id_mahasiswa', $mahasiswa_terinvite_users)
        ->select('mahasiswa.id_mahasiswa', 'mahasiswa.nama', 'mahasiswa.nim')
        ->get();

        return view('mahasiswa.kelompok.buatkelompok', compact('userId','mahasiswa_tersedia', 'idMahasiswa', 'idKelompok'));
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
    public function store(Request $request)
    {   
        $periode = Periode::select('id_periode')
                        ->where('status', 'open')->first();

        $this->validate($request, [
            'nama_kelompok' => 'required|string|max:100',
        ],
        [   
            'nama_kelompok.required' => 'Nama Kelompok tidak boleh kosong !',
            'nama_kelompok.max' => 'Nama Kelompok terlalu panjang !'
        ]);

        $data = Kelompok::create([
            'nama_kelompok' => $request->nama_kelompok,
            'id_periode' => $periode->id_periode,
            'created_by' => $request->created_by,    
        ]);
        

        $data = DetailKelompok::create([
            'id_kelompok' => $data ->id_kelompok,
            'id_mahasiswa' => $request->id_mahasiswa,
            'status_keanggotaan' => 'Ketua',
            'status_join' => 'create',
            'created_by' => $request->created_by,
        ]);

        $data->save();
        return response()->json(['message' => 'Kelompok berhasil ditambahkan.']);
    }

    public function addAnggota(Request $request){

        $data = DetailKelompok::create([
            'id_kelompok' => $request->id_kelompok,
            'id_mahasiswa' => $request->id_mahasiswa,
            'status_keanggotaan' => 'Anggota',
            'status_join' => 'diinvite',
            'created_by' => $request->created_by,
        ]);
        return response()->json(['message' => 'Anggota berhasil ditambahkan.']);
    }


    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function riwayatkelompok(Request $request)
    {   
         $userId = Auth::id();
         $idMahasiswa = Mahasiswa::select('id_mahasiswa')
                                 ->where('id_users', $userId)->first();
         $idKelompok = DetailKelompok::join('kelompok','kelompok_detail.id_kelompok','kelompok.id_kelompok')
                                 ->select('kelompok_detail.id_kelompok', 'kelompok.nama_kelompok')
                                 ->where('kelompok_detail.isDeleted', 0)
                                 ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)->first();
         $kelompok = Kelompok::get();
        if(request()->ajax()){
            $data = [];
            if ($idKelompok){
            $data = DetailKelompok::join('kelompok','kelompok_detail.id_kelompok','kelompok.id_kelompok')
                                 ->select('kelompok.*')
                                 ->where('kelompok_detail.isDeleted', 0)
                                 ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)->get();  
            }
            return datatables()->of($data)->addIndexColumn()
                ->addColumn('action', function ($kelompok){
                    if ($kelompok !=null){
                    $disable = $kelompok->tahap != 'diproses'? "disabled" : " ";
                    $btn = '<a href="/mahasiswa/daftaranggota/'.$kelompok->id_kelompok.'" class="btn btn-info btn-sm '.$disable.'"><i class="fas fa-list"></i></a>';
                   return $btn;}
                return;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('mahasiswa.kelompok.indexkelompok', compact('kelompok'));}
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
