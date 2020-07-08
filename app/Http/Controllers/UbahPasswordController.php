<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class UbahPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function ubah_password()
    // {
    //     $mahasiswa = Mahasiswa::leftJoin('users', 'mahasiswa.id_users', 'users.id_users')
    //                         ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
    //                         ->select('mahasiswa.id_mahasiswa', 'mahasiswa.id_users', 'users.id_users', 'mahasiswa.nama', 'mahasiswa.foto','roles.id_roles', 'roles.roles', 'mahasiswa.no_hp', 'mahasiswa.email', 'mahasiswa.pengalaman', 'mahasiswa.kemampuan', 'mahasiswa.nim', 'mahasiswa.cv')
    //                         ->first();
    //     return view('ubah_password', compact('mahasiswa'));
    // }
    public function index()
    {
      
    }
    // public function showchangePassword(){
    //     return view('ubah_password');
    // }

        

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
        //
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