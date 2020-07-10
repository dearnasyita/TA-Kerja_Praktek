<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;
use App\Lowongan;
use App\Instansi;
use App\Periode;
use App\Mahasiswa;
use App\DetailKelompok;
use App\Lamaran;
use App\Usulan;
use DB;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function indexmahasiswa()
    {
         $userId = Auth::id();
         $idMahasiswa = Mahasiswa::select('id_mahasiswa', 'id_periode')
                                 ->where('id_users', $userId)->first();


         $idKelompok = DetailKelompok::select('kelompok_detail.id_kelompok')
            ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
            ->orderBy('id_kelompok', 'desc')->first();

         $lowongan = Lowongan::get();
        if(request()->ajax()){

            $data = [];
            if ($idKelompok){
            $data = Lowongan::leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                            ->select('lowongan.*', 'instansi.nama')
                            ->where('lowongan.id_periode', $idMahasiswa->id_periode)
                            ->where('lowongan.isDeleted', '!=', '1')
                            ->get();
            }
            return datatables()->of($data)->addIndexColumn()

                ->addColumn('action', function ($lowongan){
                    if ($lowongan !=null){
                    $btn = '<a href="/mahasiswa/applylowongan/'.$lowongan->id_lowongan.'" class="btn btn-warning btn-sm"><i class="fas fa-arrow-right"></i></a>';
                    return $btn;
                    }
                    return;
                })

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('mahasiswa.lowongan.indexlowongan',compact('lowongan'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Instansi::get();
        $datas = Periode::get();
        return view('admin.lowongan.add_lowongan',compact('data', 'datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pekerjaan' => 'required|string|max:100',
            'persyaratan' => 'required',
            'kapasitas' => 'required',
        ]);
        $data = Lowongan::create([
            'pekerjaan' => $request->pekerjaan,
            'persyaratan' => $request->persyaratan,
            'kapasitas' => $request->kapasitas,
            'id_instansi' => $request->id_instansi,
            'id_periode' => $request->id_periode
        ]);
        $data->save();
        return response()->json(['message' => 'Lowongan status added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_lowongan)
    {
         // Get id user from Auth
         $userId = Auth::id();
        
         // Mengambil id_mahasiswa yang sesuai dengan id yang login sekarang
         $idMahasiswa = Mahasiswa::select('id_mahasiswa')
                                 ->where('id_users', $userId)->first();
         
         $idKelompok = DetailKelompok::select('kelompok_detail.id_kelompok')
                                     ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
                                     ->orderBy('id_kelompok','desc')->first(); 

        $status = DetailKelompok::select('kelompok_detail.status_keanggotaan')
        ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
        ->orderBy('id_kelompok', 'desc')
        ->first();
        
        $statusUsulan = @Usulan::leftJoin('kelompok', 'usulan.id_kelompok', '=', 'kelompok.id_kelompok')
            ->select('usulan.status')
            ->where('usulan.id_kelompok', $idKelompok->id_kelompok)->first();

        $statusLamaran = @Lamaran::select('pelamar.status')->where('pelamar.id_kelompok', $idKelompok->id_kelompok)->first();


        $instansi = Instansi::get();
        $datas = Periode::get();
        $lowongan = Lowongan::findOrFail($id_lowongan);
        return view('mahasiswa.lowongan.applylowongan',compact('instansi','lowongan','datas','idKelompok','data','userId','status','statusUsulan','statusLamaran'));
    }

    
    public function lamarLowongan(Request $request){
        
        $data = Lamaran::create([
            'id_lowongan' => $request->id_lowongan,
            'id_kelompok'=>  $request->id_kelompok,
            'created_by'=> $request->created_by,
        ]);
        $data->save();
        return response()->json(['message' => 'Apply Lowongan successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_lowongan)
    {
        $lowongan = Lowongan::find($id_lowongan);
        $lowongan->delete();
        return response()->json(['message' => 'Lowongan deleted successfully.']);
    }
}
