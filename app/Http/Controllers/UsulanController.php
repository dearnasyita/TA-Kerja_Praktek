<?php

namespace App\Http\Controllers;

use App\DetailKelompok;
use App\Mahasiswa;
use App\Periode;
use App\Usulan;
use App\Lamaran;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;


class UsulanController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        // Get id user from Auth
        $userId = Auth::id();

        $idMahasiswa = Mahasiswa::select('id_mahasiswa')
            ->where('id_users', $userId)->first();

        $idKelompok = DetailKelompok::select('kelompok_detail.id_kelompok')
            ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
            ->orderBy('kelompok_detail.id_kelompok_detail','desc')
            ->where('kelompok_detail.isDeleted', '=', '0')->first();

        $statusKeanggotaan = @DetailKelompok::select('kelompok_detail.status_keanggotaan')
            ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
            ->orderBy('id_kelompok', 'desc')->first();
            
        $usulan = Usulan::get();
        $statusUsulan = @Usulan::leftJoin('kelompok', 'usulan.id_kelompok', '=', 'kelompok.id_kelompok')
        ->select('usulan.status')
        ->where('usulan.id_kelompok', $idKelompok->id_kelompok)->first();

        $statusLamaran = @Lamaran::select('pelamar.status')
        ->where('pelamar.id_kelompok', $idKelompok->id_kelompok)->first();

        if (request()->ajax()) {

            $data = [];
            if ($idKelompok){
                $data = Usulan::leftJoin('kelompok', 'usulan.id_kelompok', '=', 'kelompok.id_kelompok')
                    ->select('usulan.*')
                    ->where('usulan.id_kelompok', $idKelompok->id_kelompok)->get();
            }

            return datatables()->of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if($data != null ){
                        $disable = $data->status == 'diterima' ? "disabled" : " ";
                        $btn = '<a href="/mahasiswa/editusulan/' . $data->id_usulan . '" class="btn btn-info btn-sm ' . $disable . '"><i class="fas fa-edit"></i></a>';
                        $btn .= '&nbsp;&nbsp;';
                        $btn .= '<button type="button" name="show" id="' . $data->id_usulan . '" class="btn btn-warning btn-sm surat" ><i class="fas fa-eye"></i></button>';
                        return $btn;
                    }
                    // else{
                    //     $btn = '<a href="#" class="btn btn-info btn-sm disabled"><i class="fas fa-edit"></i></a>';
                    //     $btn .= '&nbsp;&nbsp;';
                    //     $btn .= '<button type="button" name="show" id="' . $data->id_usulan . '" class="btn btn-warning btn-sm surat" ><i class="fas fa-eye"></i></button>';
                    //     return $btn;
                    // }
                return;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('mahasiswa.usulan.indexusulan', compact('usulan', 'statusKeanggotaan', 'statusUsulan', 'statusLamaran'));
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
        $idMahasiswa = Mahasiswa::select('id_mahasiswa', 'id_periode')
            ->where('id_users', $userId)->first();

        $idKelompok = DetailKelompok::select('kelompok_detail.id_kelompok')
            ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
            ->orderBy('id_kelompok','desc')->first();

        $periode = Periode::select('id_periode')
            ->where('status', 'open')->first();

        $datas = Usulan::get();
        return view('mahasiswa.usulan.tambahusulan', compact('datas', 'idKelompok', 'periode', 'userId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_instansi' => 'required|string|max:100',
            'website_instansi' => 'required|string|max:100',
            'alamat_instansi' => 'required|string|max:100',
            'jobdesk' => 'required|string|max:100',
            'deskripsi_instansi' => 'required|string|max:1000',
            'surat' => 'required|mimes:doc,pdf,docx,zip|max:3072',
        ],
        [
            'nama_instansi.required' => 'Nama instansi tidak boleh kosong !',
            'nama_instansi.max' => 'Nama instansi terlalu panjang !',
            'website_instansi.required' => 'Website instansi tidak boleh kosong !',
            'website_instansi.max' => 'Website instansi terlalu panjang !',
            'alamat_instansi.required' => 'Alamat instansi tidak boleh kosong !',
            'alamat_instansi.max' => 'Alamat instansi terlalu panjang !',
            'jobdesk.required' => 'Jobdesk tidak boleh kosong !',
            'jobdesk.max' => 'Jobdesk terlalu panjang !',
            'deskripsi_instansi.required' => 'Deskripsi instansi tidak boleh kosong !',
            'deskripsi_instansi.max' => 'Deskripsi instansi terlalu panjang !',
            'surat.required' => 'File tidak boleh kosong !',
            'surat.max' => 'File terlalu besar !'
        ]);

        $surat = null;
        if ($request->hasFile('surat')) {
            $files = $request->file('surat');
            $surat = str_slug('Kelompok-'.$request->id_kelompok) . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/suratpersetujuan'), $surat);
        }
        $data = Usulan::create([
            'nama_instansi' => $request->nama_instansi,
            'website_instansi' => $request->website_instansi,
            'alamat_instansi' => $request->alamat_instansi,
            'jobdesk' => $request->jobdesk,
            'deskripsi_instansi' => $request->deskripsi_instansi,
            'surat' => $surat,
            'created_by' => $request->created_by,
            'id_periode' => $request->id_periode,
            'id_kelompok' => $request->id_kelompok,
        ]);

        $data->save();
        return response()->json(['message' => 'Usulan added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Usulan::where('id_usulan', $request->id_usulan)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_usulan)
    {
        // Get id user from Auth
        $userId = Auth::id();

        // Mengambil id_mahasiswa yang sesuai dengan id yang login sekarang
        $idMahasiswa = Mahasiswa::select('id_mahasiswa')
            ->where('mahasiswa.id_users', $userId)->first();
        $idKelompok = DetailKelompok::select('kelompok_detail.id_kelompok')
            ->where('kelompok_detail.id_mahasiswa', $idMahasiswa->id_mahasiswa)
            ->orderBy('id_kelompok','desc')->first();

        $data = Usulan::findOrFail($id_usulan);

        return view('mahasiswa.usulan.editusulan', compact('data', 'idKelompok'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_usulan)
    {
        $this->validate($request, 
        [
            'nama_instansi' => 'required|string|max:100',
            'website_instansi' => 'required|string|max:100',
            'alamat_instansi' => 'required|string|max:100',
            'jobdesk' => 'required|string|max:100',
            'deskripsi_instansi' => 'required|string|max:100',
            'surat' => 'mimes:doc,pdf,docx,zip|max:3072',
        ],
        [
            'nama_instansi.required' => 'Nama instansi tidak boleh kosong !',
            'nama_instansi.max' => 'Nama instansi terlalu panjang !',
            'website_instansi.required' => 'Website instansi tidak boleh kosong !',
            'website_instansi.max' => 'Website instansi terlalu panjang !',
            'alamat_instansi.required' => 'Alamat instansi tidak boleh kosong !',
            'alamat_instansi.max' => 'Alamat instansi terlalu panjang !',
            'jobdesk.required' => 'Jobdesk tidak boleh kosong !',
            'jobdesk.max' => 'Jobdesk terlalu panjang !',
            'deskripsi_instansi.required' => 'Deskripsi instansi tidak boleh kosong !',
            'deskripsi_instansi.max' => 'Deskripsi instansi terlalu panjang !',
            'surat.max' => 'File terlalu besar !'
        ]);

        $data = Usulan::findOrFail($id_usulan);
        $surat = $data->surat;
        if ($request->hasFile('surat')) {
            !empty($surat) ? File::delete(public_path('uploads/surat' . $surat)) : null;

            $files = $request->file('surat');
            $surat = str_slug('Kelompok-'.$request->id_kelompok) . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/suratpersetujuan'), $surat);
        }

        $data->update([
            'nama_instansi' => $request->nama_instansi,
            'website_instansi' => $request->website_instansi,
            'alamat_instansi' => $request->alamat_instansi,
            'jobdesk' => $request->jobdesk,
            'deskripsi_instansi' => $request->deskripsi_instansi,
            'surat' => $surat,
            'id_kelompok' => $request->id_kelompok,
        ]);
        $data->save();
        return response()->json(['message' => 'Berhasil diubah !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_usulan)
    {
        $data = Usulan::find($id_usulan);
        $data->delete();
        return response()->json(['message' => 'Berhasil dihapus.']);
    }
}
