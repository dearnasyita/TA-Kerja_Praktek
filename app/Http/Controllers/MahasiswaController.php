<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as Image;
use Storage;
use File;
use App\Mahasiswa;
use App\User;
use App\Role;
use App\Periode;
use App\LaporanHarian;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Mahasiswa::get();
        return view('admin.mahasiswa.daftar_mahasiswa',compact('data'));
    }

    public function indexmahasiswa()
    {
        $mahasiswa = Auth::user()->mahasiswa()->leftJoin('users', 'mahasiswa.id_users', 'users.id_users')
                            ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
                            ->select('mahasiswa.id_mahasiswa', 'mahasiswa.id_users', 'users.id_users', 'mahasiswa.nama', 'mahasiswa.foto','roles.id_roles', 'roles.roles', 'mahasiswa.no_hp', 'mahasiswa.email', 'mahasiswa.pengalaman', 'mahasiswa.kemampuan', 'mahasiswa.nim', 'mahasiswa.cv', 'mahasiswa.alamat','mahasiswa.angkatan')
                            ->first();
        return view('mahasiswa.profil.profile', compact('mahasiswa'));
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
        $this->validate($request, [
            // 'nama' => 'required|string|max:100',
            // 'nim' => 'required|string|max:100',
            'angkatan' => 'required|string|max:4',
            'email' => 'required|string|max:100',
            'no_hp' => 'required|string|max:25',
            'alamat' => 'required|string|max:1000',
            'kemampuan' => 'required|string|max:1000',
            'pengalaman' => 'required|string|max:1000',
            'cv' => 'required|mimes:pdf|max:3000',
            'foto' => 'required|mimes:jpg,png,jpeg|max:1024',  
        ],
        [
            // 'nama.required' => 'nama tidak boleh kosong !',
            // 'nim.required' => 'nim tidak boleh kosong !',
            'angkatan.required' => 'angkatan tidak boleh kosong !',
            'email.required' => 'email tidak boleh kosong !',
            'no_hp.required' => 'no.hp tidak boleh kosong !',
            'alamat.required' => 'Alamat tidak boleh kosong !',
            'alamat.max' => 'Alamat terlalu panjang !',
            'kemampuan.required' => 'kemampuan tidak boleh kosong !',
            'kemampuan.max' => 'kemampuan terlalu panjang !',
            'pengalaman.required' => 'pengalaman tidak boleh kosong !',
            'pengalaman.max' => 'Pengalaman terlalu panjang !',
            'foto.max' => 'File terlalu besar !',
            'foto.required' => 'File tidak boleh kosong !',
            'foto.mimes' => 'File harus jpg,png,jpeg',
            'cv.required' => 'File tidak boleh kosong !',
            'cv.max' => 'File terlalu besar !',
            'cv.mimes' => 'File harus pdf'
        ]);

        $cv= null;
        if($request->hasFile('cv')){
            $files=$request->file('cv');
            $cv=str_slug($request->nim) ."-" .time(). '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/cv'),$cv);
        }

        $foto = null;
        if($request->hasFile('foto')){
            $files=$request->file('foto');
            $foto=str_slug($request->nim) ."-" .time() .  '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/fotoprofile'),$foto);
        }

        $data = Mahasiswa::create([
            // 'nama' => $request->nama,
            // 'nim' => $request->nim,
            'angkatan' => $request->angkatan,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kemampuan' => $request->kemampuan,
            'pengalaman' => $request->pengalaman,
            'foto' => $foto,
            'cv' => $cv
            
        ]);

        $data->save();
        return response()->json(['message' => 'Berhasil diubah.']);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function edit($id_mahasiswa)
    {
        $mahasiswa = Mahasiswa::findOrFail($id_mahasiswa);
        return view('mahasiswa.profil.editprofil', compact('mahasiswa'));
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
        $this->validate($request, [
                // 'nama' => 'required|string|max:100',
                // 'nim' => 'required|string|max:100',
                'angkatan' => 'required|string|max:4',
                'email' => 'required|string|max:100',
                'no_hp' => 'required|string|max:25',
                'alamat' => 'required|string|max:1000',
                'kemampuan' => 'required|string|max:1000',
                'pengalaman' => 'required|string|max:1000',
                'cv' => 'mimes:pdf|max:3000',
        ],[
            // 'nama.required' => 'nama tidak boleh kosong !',
            // 'nim.required' => 'nim tidak boleh kosong !',
            'angkatan.required' => 'angkatan tidak boleh kosong !',
            'email.required' => 'email tidak boleh kosong !',
            'no_hp.required' => 'no.hp tidak boleh kosong !',
            'alamat.required' => 'alamat tidak boleh kosong !',
            'alamat.max' => 'alamat terlalu panjang !',
            'kemampuan.required' => 'kemampuan tidak boleh kosong !',
            'kemampuan.max' => 'kemampuan terlalu panjang !',
            'pengalaman.required' => 'pengalaman tidak boleh kosong !',
            'pengalaman.max' => 'pengalaman terlalu panjang !',
            'cv.max' => 'File terlalu besar !',
            'cv.mimes' => 'File harus pdf'
        ]);
        
        $data = Mahasiswa::findOrFail($id_mahasiswa);
        $cv = $data->cv;

        if ($request->hasFile('cv')) {
            !empty($cv) ? File::delete(public_path('uploads/cv' . $cv)):null;

            $files=$request->file('cv');
            $cv=str_slug($request->nim) ."-" .time() . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/cv'),$cv);
        }

        
        $data -> update([
            // 'nama' => $request->nama,
            // 'nim' => $request->nim,
            'angkatan' => $request->angkatan,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kemampuan' => $request->kemampuan,
            'pengalaman' => $request->pengalaman,
            'cv' => $cv
        ]);
        $data->save();
        return response()->json(['message' => 'Berhasil diubah !']);
        
    }


    
    public function updateAvatar(Request $request, $id_mahasiswa){
        $this->validate($request, [
            'foto' => 'required|mimes:jpg,png,jpeg|max:1024',
        ],[
            'foto.max' => 'File terlalu besar !',
            'foto.required' => 'File tidak boleh kosong !',
            'foto.mimes' => 'File harus jpg,png,jpeg'
        ]);

        $data = Mahasiswa::findOrFail($id_mahasiswa);
        $foto = $data->foto;

        if ($request->hasFile('foto')) {
            !empty($foto) ? File::delete(public_path('uploads/fotoprofile/' . $foto)):null;

            $files=$request->file('foto');
            $foto=$data->id_mahasiswa;
            $foto=str_slug($data->nim) ."-" .time() . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/fotoprofile/'),$foto);
        }
        $data->update([
            'foto' => $foto
        ]);
        return response()->json(['data' => $data,
            'message' => 'Foto profil berhasil diubah.']);
    }

    public function showchangePassword(){
        $user = Auth::user();
        return view('mahasiswa.ubah_password', compact('user'));
    }

    public function hapusCV($id_mahasiswa){

        $mhs = Mahasiswa::findOrFail($id_mahasiswa);
        unlink(public_path('uploads/cv/'.$mhs->cv));
        $mhs->delete();
        return response()->json(['message' => 'CV berhasil dihapus.']);
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
