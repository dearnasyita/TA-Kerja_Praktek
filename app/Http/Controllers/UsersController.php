<?php

namespace App\Http\Controllers;

use App\User;
use App\Mahasiswa;
use App\Role;
use App\Periode;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input; //untuk input::get
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Validation\Validator;

class UsersController extends Controller
{

    // public function __construct(){
    //     $this->middleware('auth');
    // }
    

    public function indexlogin(){
        return view('admin.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|string'
        ]);

        $auth = $request->only('username', 'password');
        $auth['id_roles'] = 4;

        if(Auth::attempt($auth)){
            $user = Auth::user();
            $user->api_token = str_random(100);
            $user->save();
            return redirect('/mahasiswa/index')->with('sukses','Anda Berhasil Login');
           
    	}
    	return redirect('admin/login')->with('error','Username atau password tidak sesuai');
    }


    // public function login(Request $request){
    //     if(Auth::attempt($request->only('username','password'))){
    //         $akun = DB::table('users')->where('username', $request->username)->first();
    //         //dd($akun);
    //         if($akun->id_roles == 1){
    //             Auth::guard('administrator')->LoginUsingId($akun->id_users);
    //             return redirect('/admin/dasboard')->with('sukses','Anda Berhasil Login');
    //         } else if($akun->id_roles == 2){
    //             Auth::guard('dosen')->LoginUsingId($akun->id_users);
    //             return redirect('/dosen/dashboard')->with('sukses','Anda Berhasil Login');
    //         }elseif ($akun->id_roles == 3) {
    //           Auth::guard('instansi')->LoginUsingId($akun->id_users);
    //           return redirect('/admin')->with('sukses','Anda Berhasil Login');
    //         }elseif ($akun->id_roles == 4) {
    //           Auth::guard('mahasiswa')->LoginUsingId($akun->id_users);
    //           return redirect('/mahasiswa/index')->with('sukses','Anda Berhasil Login');
    //         }
    // 	}
    // 	return redirect('admin/login')->with('error','Akun Belum Terdaftar');
    // }

    public function logout(Request $request){
        if(Auth::guard('administrator')->check()){
            Auth::guard('administrator')->logout();
        } else if(Auth::guard('dosen')->check()){
            Auth::guard('dosen')->logout();
        } else if(Auth::guard('mahasiswa')->check()){
            Auth::guard('mahasiswa')->logout();
        } else if(Auth::guard('instansi')->check()){
            Auth::guard('instansi')->logout();
        }
    	return redirect('admin/login')->with('sukses','Anda Telah Logout');
    }

    public function updatePassword(Request $request, $id_users){
        $this->validate($request, [
            'password' => 'required|min:6|max:191|confirmed'
        ],
        [
            'password.required' => 'Password tidak boleh kosong ! ',
            'password.min' => 'Password terlalu pendek ! ',
            'password.max' => 'Password terlalu panjang ! ',
            'password.confirmed' => 'Confirm password tidak sama !',
            
        ]);
        $data = User::where ('id_users',$id_users)->first();
        $data->password = Hash::make($request->password);
        $data->save();
        return response()->json(['message'=>'Password berhasil diubah.']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::select('id_roles', 'roles')->get();
        $user = User::get();
        return view('admin.akun.daftar_akun',compact('user','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id_roles', 'roles')->get();
        return view('admin.akun.add_akun', compact('roles'));
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
            'nama' => 'required|string|max:191',
            'username' => 'required|string|max:191',
            'password' => 'required|min:6|max:191'
        ],
        [
            'nama' => 'can not be empty !',
            'username.required' => 'can not be empty !',
            'username.unique' => 'username has already been taken !',
            'password.max' => 'password is to long !',
        ]);
        
        $data = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_roles' => $request->id_roles
        ]);
        $data->save();

        if($request->id_roles == 2){
            $data->dosen()->create([
                'nama' => $request->nama,
            ]);
        }
        else if($request->id_roles == 3){
            $data->instansi()->create([
                'nama' => $request->nama,
            ]);
        }
        else if($request->id_roles == 4){
            $data->mahasiswa()->create([
                'nama' => $request->nama,
                'id_periode' => 1,
            ]);
        }

        return redirect(route('users.index'))
                ->with('alert-success','Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id_users)
    {
        $roles = Role::select('id_roles', 'roles')->get();
        $data = User::findOrFail($id_users);
        return view('admin.akun.edit_akun', compact('data','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_users)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:191',
            'username' => 'required|string|max:191',
            'password' => 'required|min:6|max:191'
        ],
        [
            'nama.required' => 'can not be empty !',
            'username.required' => 'can not be empty !',
            'username.unique' => 'username has already been taken !',
            'password.max' => 'password is to long !',
        ]);
        $data = User::where ('id_users',$id_users)->first();
        $data->username = $request->username;
        $data->password = Hash::make($request->password);

        if($request->id_roles == 2){
            $data->dosen()->update([
                'nama' => $request->nama,
            ]);
        }
        else if($request->id_roles == 3){
            $data->instansi()->update([
                'nama' => $request->nama,
            ]);
        }
        else if($request->id_roles == 4){
            $data->mahasiswa()->update([
                'nama' => $request->nama,
            ]);
        }

        $data->save();
        return redirect()->route('users.index')->with(
            'alert-success','Data berhasil diubah!');
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_users)
    {
        $data = User::find($id_users);
        $data->delete();
        return redirect()->back()->with(['success' => '<strong>' . $data->username . '</strong> Telah Dihapus!']);
    }
}
