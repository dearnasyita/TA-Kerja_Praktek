<?php

namespace App\Http\Controllers;

use App\LaporanHarian;
use App\Mahasiswa;
use App\Periode;
use App\DetailKelompok;
use App\Magang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Contracts\Validation\Validator;

class LaporanHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                  
        $laporanharian = LaporanHarian::get();
        
        // Get id user from Auth
        $userId = Auth::id();
        
        // Mengambil id_mahasiswa yang sesuai dengan id yang login sekarang
        $idMahasiswa = Mahasiswa::select('mahasiswa.id_mahasiswa')
                                ->where('mahasiswa.id_users', $userId)->first();

        $idKelompok = DetailKelompok::select('kelompok_detail.id_kelompok')
                                ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
                                ->orderBy('id_kelompok', 'desc')->first();

        $status = @Magang::where('id_kelompok', $idKelompok->id_kelompok)->first();

        $periode = Periode::select('id_periode')->where('status', 'open')->first();
       
        if(request()->ajax()){
                $data = LaporanHarian::join('mahasiswa', 'buku_harian.id_mahasiswa', '=', 'mahasiswa.id_mahasiswa')
                ->select('buku_harian.*')
                ->orderBy('created_at','DESC')
                ->where('buku_harian.id_mahasiswa', $idMahasiswa->id_mahasiswa)->get();

            return datatables()->of($data)->addIndexColumn()

                ->editColumn('tanggal', function ($laporanharian) {
                    return Carbon::parse($laporanharian->tanggal)->translatedFormat('d F Y');
                })
                ->editColumn('waktu_mulai', function ($laporanharian) {
                    return date('H:i', strtotime($laporanharian->waktu_mulai) );
                })

                ->editColumn('waktu_selesai', function ($laporanharian) {
                    return date('H:i', strtotime($laporanharian->waktu_selesai) );

                })

                ->addColumn('action', function ($laporanharian){
                    $disable = $laporanharian->status == 'diperiksa'? "disabled" : " ";
                    $btn = '<a href="/mahasiswa/editlaporanharian/'.$laporanharian->id_buku_harian.'" class="btn btn-info btn-sm '.$disable.' "><i class="fas fa-edit"></i></a>';
                    $btn .= '&nbsp;&nbsp;';
                    return $btn;
                })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('mahasiswa.laporan.laporanharian', compact('laporanharian', 'idMahasiswa','userId','periode','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data = LaporanHarian::all();
        return view('mahasiswa.laporan.laporanharian',compact('data'));
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
            'tanggal' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'kegiatan' => 'required',
        ],[
            'tanggal.required' => 'Tanggal tidak boleh kosong !',
            'waktu_mulai.required' => 'Waktu mulai tidak boleh kosong !',
            'waktu_selesai.required' => 'Waktu selesai tidak boleh kosong !',
            'kegiatan.required' => 'Kegiatan tidak boleh kosong !'
        ]);

        $data = LaporanHarian::create([
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'kegiatan' => $request->kegiatan,
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_periode' => $request->id_periode,
            'created_by' => $request->created_by,
        ]);
        $data->save();
        
        return response()->json(['message' => 'Berhasil ditambahkan !']);
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
    public function edit($id_buku_harian)
    {
        
        $data = LaporanHarian::findOrFail($id_buku_harian);
        return view('mahasiswa.laporan.editlaporanharian', compact('data'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_buku_harian)
        {$this->validate($request, [
            'tanggal' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'kegiatan' => 'required',
        ],
        [
            'tanggal.required' => 'Tanggal tidak boleh kosong !',
            'waktu_mulai.required' => 'Waktu mulai tidak boleh kosong !',
            'waktu_selesai.required' => 'Waktu selesai tidak boleh kosong !',
            'kegiatan.required' => 'Kegiatan tidak boleh kosong !'
        ]);
        $data = LaporanHarian::findOrFail($id_buku_harian);
        $data -> update([
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'kegiatan' => $request->kegiatan,
            'id_mahasiswa' => $request->id_mahasiswa,
        ]);
        $data->save();
        return response()->json(['message' => 'Berhasil diubah !']);
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_buku_harian)
    {
        $data = LaporanHarian::find($id_buku_harian);
        $data->delete();
        return response()->json(['message' => 'Berhasil dihapus.']);    
    }
}

