<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Mah extends Controller
{
    public function admin()
    {
        return view('admin.admin');
    }
    public function index()
    {
        return view('admin.mahasiswa.daftar_mahasiswa');
    }
    public function index1()
    {
        return view('admin.mahasiswa.detail_mahasiswa');
    }
    public function index2()
    {
        return view('admin.dosen.daftar_dosen');
    }
    public function showdosen()
    {
        return view('admin.dosen.detail_dosen');
    }
    
    public function indexpartner()
    {
        return view('admin.perusahaan.daftar_partner');
    }
    public function showpartner()
    {
        return view('admin.perusahaan.detail_partner');
    }
    public function indexpkelompok()
    {
        return view('admin.kelompok.persetujuan_kelompok');
    }
    public function UsulanPKL()
    {
        return view('admin.usulan.usulan_pkl');
    }
    public function detailUsulan()
    {
        return view('admin.usulan.detail_usulan');
    }
    public function detailKelompok()
    {
        return view('admin.kelompok.detailKelompok');
    }

    public function indexakun()
    {
        return view('admin.akun.daftar_akun');
    }

    public function addakun()
    {
        return view('admin.akun.add_akun');
    }
    public function editakun()
    {
        return view('admin.akun.edit_akun');
    }
    public function periodeListing()
    {
        return view('admin.periode.periodeListing');
    }
    public function AddNewPeriode()
    {
        return view('admin.periode.add_new_periode');
    }
    public function EditPeriode()
    {
        return view('admin.periode.edit_periode');
    }
    public function magangListing()
    {
        return view('admin.magang.magangListing');
    }
    public function detailMagang()
    {
        return view('admin.magang.detailMagang');
    }
    public function presentasiKelompok()
    {
        return view('admin.presentasi.presentasi_kelompok');
    }
    public function addpresentasiKelompok()
    {
        return view('admin.presentasi.add_presentasi');
    }
    public function editpresentasiKelompok()
    {
        return view('admin.presentasi.edit_presentasi');
    }
    public function lowonganPKL()
    {
        return view('admin.lowongan.lowongan');
    }
    public function detaillowonganPKL()
    {
        return view('admin.lowongan.detail_lowongan');
    }
    public function addlowonganPKL()
    {
        return view('admin.lowongan.add_lowongan');
    }
    public function editlowonganPKL()
    {
        return view('admin.lowongan.edit_lowongan');
    }

}

