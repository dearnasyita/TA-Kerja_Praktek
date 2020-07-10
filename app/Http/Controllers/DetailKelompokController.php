<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\DetailKelompok;
use App\Jadwal;
use App\Kelompok;
use App\Mahasiswa;
use DB;
use Illuminate\Http\Request;

class DetailKelompokController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

         //initial var;
        $jadwal = $detail_kelompok = $mahasiswa = $kelompok = $anggota = $magang = $instansi = [];
        $auth = auth()->user()->id_users;
        
        $mahasiswi = Mahasiswa::where('id_users', $auth)
            ->first();

        $id_mahasiswa = $mahasiswi != null ? $mahasiswi->id_mahasiswa : [];

        if ($id_mahasiswa) {

            $group = DetailKelompok::where('id_mahasiswa', $id_mahasiswa)
                ->where('status_join', '!=', 'ditolak')
                ->where('isDeleted', '!=', '1')
                ->orderBy('id_kelompok_detail','desc')
                ->first();

            $id_kelompok = $group != null ? $group->id_kelompok : [];

            $mahasiswa = Mahasiswa::findOrFail($id_mahasiswa);
            $magang = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                ->leftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                ->leftJoin('dosen', 'kelompok.id_dosen', 'dosen.id_dosen')
                ->select('dosen.nama', 'dosen.email', 'dosen.nip', 'dosen.no_hp', 'dosen.foto')
                ->where('mahasiswa.id_mahasiswa', $id_mahasiswa)
                ->first();

            $instansi = Mahasiswa::join('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                ->join('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                ->join('magang', 'kelompok.id_kelompok', 'magang.id_kelompok')
                ->join('instansi', 'magang.id_instansi', 'instansi.id_instansi')
                ->select('instansi.nama', 'instansi.deskripsi', 'instansi.alamat', 'instansi.foto', 'instansi.website')
                ->where('mahasiswa.id_mahasiswa', $id_mahasiswa)
                ->first();

            $kelompok = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                ->leftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                ->select('kelompok.nama_kelompok', 'kelompok.tahap', 'kelompok_detail.status_keanggotaan')
                ->where('mahasiswa.id_mahasiswa', $id_mahasiswa)
                ->get();
    
        if ($id_kelompok) {
    
    
                    $detail_kelompok = Kelompok::where('id_kelompok', $id_kelompok)
                        ->first();
    
                    $jadwal = Jadwal::join('dosen', 'dosen.id_dosen', 'jadwal_presentasi.id_dospeng')
                        ->join('sesiwaktu', 'sesiwaktu.id_sesiwaktu', 'jadwal_presentasi.id_sesiwaktu')
                        ->join('ruang', 'ruang.id_ruang', 'jadwal_presentasi.id_ruang')
                        ->where('jadwal_presentasi.id_kelompok', $id_kelompok)
                        ->select('jadwal_presentasi.tanggal', 'sesiwaktu.sesi', 'ruang.ruang', 'dosen.nama')
                        ->first();
    
                    $anggota = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                        ->LeftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                        ->select('kelompok.id_kelompok', 'mahasiswa.id_mahasiswa', 'mahasiswa.nama', 'mahasiswa.foto', 'mahasiswa.nim', 'mahasiswa.angkatan', 'kelompok_detail.status_keanggotaan')
                        ->where('kelompok_detail.status_join', '!=', 'ditolak')
                        ->where('kelompok_detail.isDeleted', '!=', '1')
                        ->where('kelompok_detail.id_kelompok', $id_kelompok)
                        ->get();
                }
            }
            return view('mahasiswa.kelompok.detailkelompok', compact(
                'jadwal',
                'detail_kelompok',
                'mahasiswa',
                'kelompok',
                'anggota',
                'magang',
                'instansi'
            ));
        }

       
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id_kelompok)
    {
        $data = Kelompok::findOrFail($id_kelompok);
        return view('mahasiswa.kelompok.daftaranggota', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function daftaranggota(Request $id_kelompok, $id)
    {   
         // Get id user from Auth
         $userId = Auth::id();
         // Mengambil id_mahasiswa yang sesuai dengan id yang login sekarang
         $idMahasiswa = Mahasiswa::select('id_mahasiswa')
                                 ->where('id_users', $userId)->first();
         
        $idKelompok = DetailKelompok::join('kelompok','kelompok_detail.id_kelompok','kelompok.id_kelompok')
                                    ->select('kelompok_detail.id_kelompok', 'kelompok.nama_kelompok','kelompok_detail.id_kelompok_detail')
                                    ->where('kelompok.id_kelompok', $id)
                                    ->where('kelompok_detail.isDeleted', 0)
                                    ->first();

        $statusKeanggotaan = @DetailKelompok::select('kelompok_detail.status_keanggotaan')
                                ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
                                ->orderBy('id_kelompok', 'desc')->first(); 
          
        $anggota = Mahasiswa::get();
        if(request()->ajax()){
            $data = [];
            if ($idKelompok){
            $data  = Mahasiswa::leftJoin('kelompok_detail', 'mahasiswa.id_mahasiswa', 'kelompok_detail.id_mahasiswa')
                    ->LeftJoin('kelompok', 'kelompok_detail.id_kelompok', 'kelompok.id_kelompok')
                    ->select('kelompok.id_kelompok', 'mahasiswa.id_mahasiswa', 'mahasiswa.nama',  'mahasiswa.nim','kelompok_detail.status_keanggotaan','kelompok_detail.id_kelompok_detail')
                    ->where('kelompok_detail.status_keanggotaan','!=', 'Ketua')
                    ->where('kelompok_detail.status_join','!=', 'ditolak')
                    ->where('kelompok_detail.id_kelompok', $idKelompok->id_kelompok)
                    ->where('kelompok_detail.isDeleted', 0)
                    ->get();
            }
            
            return datatables()->of($data)->addIndexColumn()
                ->addColumn('action', function ($data){
                    
                    if($data != null ){
                    $btn = '<button type="button" name="delete" id="' . $data->id_kelompok_detail . '" class="btn btn-danger btn-sm deleteAnggota "><i class="fas fa-trash"></i></button>';
                   return $btn; 
                }
            
                return;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('mahasiswa.kelompok.daftaranggota', compact('anggota','idKelompok','statusKeanggotaan'));
    }
    
    public function kick($id_kelompok_detail)
    {
        $anggota = DetailKelompok::find($id_kelompok_detail);
        $anggota->isDeleted = '1';
        $anggota->save();
        return response()->json(['message' => 'Anggota deleted successfully.']);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
