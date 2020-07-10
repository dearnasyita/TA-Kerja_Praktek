<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;
use App\LaporanAkhir;
use App\Kelompok;
use App\Mahasiswa;
use App\DetailKelompok;
use Illuminate\Http\Request;
use File;
use Carbon\Carbon;


class LaporanAkhirController extends Controller
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
    public function index(Request $request)
    {
        $userId = Auth::id();
        $idMahasiswa = Mahasiswa::select('id_mahasiswa')
                                ->where('id_users', $userId)->first();
        
        $idKelompok = DetailKelompok::select('kelompok_detail.id_kelompok')
                                ->where('kelompok_detail.isDeleted', '=', '0')                                    
                                ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
                                ->orderBy('kelompok_detail.id_kelompok_detail','desc')->first();   

        $status = DetailKelompok::select('kelompok_detail.status_keanggotaan')  
                                ->orderBy('id_kelompok', 'desc')                                    
                                ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)->first(); 

        $statusLaporan = @LaporanAkhir::leftJoin('kelompok', 'laporan.id_kelompok', '=', 'kelompok.id_kelompok')
                                    ->select('laporan.id_laporan')
                                    ->where('laporan.id_kelompok', $idKelompok->id_kelompok)->first();

        $laporanakhir = LaporanAkhir::get();


        if(request()->ajax()){
            $data = [];
            if ($idKelompok){
            $data = LaporanAkhir::leftJoin('kelompok', 'laporan.id_kelompok','=', 'kelompok.id_kelompok')
                ->select('laporan.*')
                ->where('laporan.id_kelompok', $idKelompok->id_kelompok)->get();
            }
                return datatables()->of($data)->addIndexColumn()
                
                ->editColumn('created_at', function ($laporanakhir) {
                    return Carbon::parse($laporanakhir->created_at)->translatedFormat('d F Y');
                })
                ->addColumn('action', function ($laporanakhir){
                    if ($laporanakhir !=null){
                        $btn = '<a href="/mahasiswa/editlaporanpkl/'.$laporanakhir->id_laporan.'" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>';
                        $btn .= '&nbsp;&nbsp;';
                        $btn .='<button type="button" name="show" id="'.$laporanakhir->id_laporan.'" class="btn btn-warning btn-sm detaillaporanakhir" ><i class="fas fa-eye"></i></button>';
                        return $btn;
                    }
                    // else{
                    //     $btn = '<a href="#" class="btn btn-info btn-sm disabled"><i class="fas fa-edit"></i></a>';
                    //     $btn .= '&nbsp;&nbsp;';
                    //     $btn .='<button type="button" name="show" id="'.$laporanakhir->id_laporan.'" class="btn btn-warning btn-sm detaillaporanakhir" ><i class="fas fa-eye"></i></button>';
                    //     return $btn;
                    // }

                    return;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('mahasiswa.laporan.laporanpkl', compact('laporanakhir','status','statusLaporan'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        // Mengambil id_mahasiswa yang sesuai dengan id yang login sekarang
        $idMahasiswa = Mahasiswa::select('id_mahasiswa')
                                ->where('id_users', $userId)->first();
        // mengambil id kelompok
        $idKelompok = DetailKelompok::select('kelompok_detail.id_kelompok')
                                    ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
                                    ->orderBy('kelompok_detail.id_kelompok_detail','desc')->first();
        
        return view('mahasiswa.laporan.tambahlaporanpkl',compact('datas', 'idKelompok','userId'));
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
            'judul' => 'required|string|max:100',
            'berkas' => 'required|mimes:doc,pdf,docx,zip|max:10240',
            
        ],
        [
            'judul.required' => 'Judul tidak boleh kosong !',
            'judul.max' => 'Judul terlalu panjang !',
            'berkas.max' => 'File terlalu besar !',
            'berkas.required' => 'Berkas tidak boleh kosong !'
            ]);

        $berkas= null;
        if($request->hasFile('berkas')){
            $files=$request->file('berkas');
            $berkas=str_slug('Laporan Kelompok-'.$request->id_kelompok) . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/laporanakhir'),$berkas);
        }

        $data = LaporanAkhir::create([
            'judul' => $request->judul,
            'berkas' => $berkas,
            'id_kelompok' => $request->id_kelompok,
            'created_by' => $request->created_by,
        ]);

        $data->save();
        return response()->json(['message' => 'Laporan Akhir added successfully.']);
    
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = LaporanAkhir::where('id_laporan', $request->id_laporan)->first();
        return response()->json($data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_laporan)
    {
        $userId = Auth::id();
        
        // Mengambil id_mahasiswa yang sesuai dengan id yang login sekarang
        $idMahasiswa = Mahasiswa::select('id_mahasiswa')
                                ->where('id_users', $userId)->first();
        
        $idKelompok = DetailKelompok::select('kelompok_detail.id_kelompok')
                                    ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
                                    ->orderBy('kelompok_detail.id_kelompok_detail','desc')->first();
        $datas = Kelompok::get();
        $data = LaporanAkhir::findOrFail($id_laporan);
        
        return view('mahasiswa.laporan.editlaporanpkl', compact('data','idKelompok','userId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_laporan)
        {$this->validate($request, [
            'judul' => 'required|string|max:100',
            'berkas' => 'mimes:doc,pdf,docx,zip|max:10240',
        ],
        [
            'judul.required' => 'Judul tidak boleh kosong !',
            'judul.max' => 'Judul terlalu panjang !',
        ]);

        $data = LaporanAkhir::findOrFail($id_laporan);
        $berkas = $data->berkas;

        if ($request->hasFile('berkas')) {
            !empty($berkas) ? File::delete(public_path('uploads/laporanakhir' . $berkas)):null;
            $files=$request->file('berkas');
            $berkas=str_slug('Laporan Kelompok-'.$request->id_kelompok) . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/laporanakhir'),$berkas);
        }

        
        $data -> update([
            'judul' => $request->judul,
            'berkas' => $berkas,
            'id_kelompok' => $request->id_kelompok,
            
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
    public function destroy($id_laporan)
    {
        $data = LaporanAkhir::find($id_laporan);
        $data->delete();
        return response()->json(['message' => 'Berhasil dihapus.']);    
    }
}
