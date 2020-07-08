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
                            ->select('mahasiswa.id_mahasiswa', 'mahasiswa.id_users', 'users.id_users', 'mahasiswa.nama', 'mahasiswa.foto','roles.id_roles', 'roles.roles', 'mahasiswa.no_hp', 'mahasiswa.email', 'mahasiswa.pengalaman', 'mahasiswa.kemampuan', 'mahasiswa.nim', 'mahasiswa.cv', 'mahasiswa.alamat')
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
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'no_hp' => 'required|string|max:25',
            'alamat' => 'required|string|max:1000',
            'kemampuan' => 'required|string|max:1000',
            'pengalaman' => 'required|string|max:1000',
            'cv' => 'mimes:doc,pdf,docx,zip',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
            
        ],
    
        [
            'nama.required' => 'nama can not be empty !',
            'nim.required' => 'nim can not be empty !',
            'email.required' => 'email can not be empty !',
            'no_hp.required' => 'no.hp can not be empty !',
            'alamat.required' => 'alamat can not be empty !',
            'alamat.max' => 'alamat is to long !',
            'kemampuan.required' => 'kemampuan can not be empty !',
            'kemampuan.max' => 'kemampuan is to long !',
            'pengalaman.required' => 'pengalaman can not be empty !',
            'pengalaman.max' => 'pengalaman is to long !',
        ]);

        $cv= null;
        if($request->hasFile('cv')){
            $files=$request->file('cv');
            $cv=str_slug($request->nim) . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/cv'),$cv);
        }

        $foto = null;
        if($request->hasFile('foto')){
            $files=$request->file('foto');
            $foto=str_slug($request->nim) .  '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/fotoprofile'),$foto);
        }

        $data = Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
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
                'nama' => 'required|string|max:100',
                'nim' => 'required|string|max:100',
                'email' => 'required|string|max:100',
                'no_hp' => 'required|string|max:25',
                'alamat' => 'required|string|max:1000',
                'kemampuan' => 'required|string|max:1000',
                'pengalaman' => 'required|string|max:1000',
                'cv' => 'mimes:doc,pdf,docx,zip',
                
        ],
            
                [
                'nama.required' => 'Nama tidak boleh kosong !',
                'nim.required' => 'NIM tidak boleh kosong !',
                'email.required' => 'Email tidak boleh kosong !',
                'no_hp.required' => 'No Hp tidak boleh kosong !',
                'alamat.required' => 'Alamat tidak boleh kosong !',
                'alamat.max' => 'Alamat terlalu panjang  !',
                'kemampuan.required' => 'Kemampuan tidak boleh kosong !',
                'kemampuan.max' => 'Kemampuan terlalu panjang !',
                'pengalaman.required' => 'Pengalaman tidak boleh kosong !',
                'pengalaman.max' => 'Pengalaman terlalu panjang !',
                
                
        ]);
        
        $data = Mahasiswa::findOrFail($id_mahasiswa);
        $cv = $data->cv;

        if ($request->hasFile('cv')) {
            !empty($cv) ? File::delete(public_path('uploads/cv' . $cv)):null;

            $files=$request->file('cv');
            $cv=str_slug($request->nim) . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/cv'),$cv);
        }

        $data -> update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kemampuan' => $request->kemampuan,
            'pengalaman' => $request->pengalaman,
            'cv' => $cv
        ]);
        $data->save();
       
        return redirect('mahasiswa/profile')->with('alert-success','Avatar has been changed!');
    }


    
    public function updateAvatar(Request $request, $id_mahasiswa){
        $this->validate($request, [
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        $data = Mahasiswa::findOrFail($id_mahasiswa);
        $foto = $data->foto;

        if ($request->hasFile('foto')) {
            !empty($foto) ? File::delete(public_path('uploads/fotoprofile/' . $foto)):null;

            $files=$request->file('foto');
            $foto=$data->id_mahasiswa;
            $foto=str_slug($data->nim) . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/fotoprofile/'),$foto);
        }
        $data->update([
            'foto' => $foto
        ]);
        return response()->json(['data' => $data,
            'message' => 'Photo updated successfully.']);
    }

    public function showchangePassword(){
        $user = Auth::user();
        return view('mahasiswa.ubah_password', compact('user'));
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
