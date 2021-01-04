<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Kode;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('depan');
    }

    public function create()
    {
        return view('create_pegawai');
    }

    public function store(Request $request)
    {
        $pegawai = new Pegawai;
        $lihat = Kode::find(1);

        $qq = $lihat->nilai;
        $ni = $qq + 1;

        $nika = date('y', strtotime($request->tgl_masuk)) . date('m', strtotime($request->tgl_masuk)) . date('y', strtotime($request->tgl_lahir)) . '-00' . $ni;

        $pegawai->nik = $nika;
        $pegawai->nama = $request->nama;
        $pegawai->tgl_masuk = $request->tgl_masuk;
        $pegawai->tgl_lahir = $request->tgl_lahir;
        $pegawai->save();

        // $u_kode->nilai = $ni;
        // $u_kode->update($request->all());

        return $pegawai;
    }
}
