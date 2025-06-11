<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class laporanKaryawan extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Data Karyawan',
            'cabang' => Cabang::all(),
        ];
        return view('laporan.karyawan.index', $data);
    }

    public function getKaryawan(Request $r)
    {
        $data = [
            'title' => 'Daftar Barang',
            'karyawan' =>  Karyawan::where('cabang_id', $r->cabang)->orderBy('id', 'desc')->get(),
        ];
        return view('laporan.karyawan.getKaryawan', $data);
    }
    public function print(Request $r)
    {
        $data = [
            'title' => 'Laporan Data Karyawan',
            'karyawan' =>  Karyawan::where('cabang_id', $r->cabang)->orderBy('id', 'desc')->get(),
            'cabang' => Cabang::where('id', $r->cabang)->first()
        ];
        return view('laporan.karyawan.print', $data);
    }
}
