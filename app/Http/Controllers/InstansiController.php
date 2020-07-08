<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Instansi;
use App\User;
use App\Periode;
use App\Lowongan;
use App\Role;

class InstansiController extends Controller
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
    
    public function index()
    {
        $instansi = Instansi::get();
        return view('admin.instansi.daftar_instansi',compact('instansi'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_instansi)
    {
        $periode =  Periode::select('id_periode', 'tahun_periode')->get();
        $instansi = Instansi::findOrFail($id_instansi);
        $role = Instansi::leftJoin('users', 'instansi.id_users', 'users.id_users')
                        ->leftJoin('roles', 'users.id_roles', 'roles.id_roles')
                        ->select('instansi.id_instansi', 'roles.roles')
                        ->where('instansi.id_instansi', '=', $id_instansi)
                        ->first();
        $lowongan = Lowongan::leftJoin('instansi', 'lowongan.id_instansi', 'instansi.id_instansi')
                            ->leftJoin('periode', 'lowongan.id_periode', 'periode.id_periode')
                            ->select('lowongan.id_lowongan', 'lowongan.pekerjaan', 'lowongan.persyaratan', 'lowongan.slot', 'lowongan.id_instansi', 'instansi.id_instansi', 'instansi.nama')
                            ->where('lowongan.id_instansi', '=', $id_instansi)
                            ->first();
        return view('admin.instansi.detail_instansi',compact('role', 'periode','instansi', 'lowongan'));
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