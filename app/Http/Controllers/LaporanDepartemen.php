<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Departemen;
use Illuminate\Http\Request;

class LaporanDepartemen extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Data Departmen',
            'cabang' => Cabang::all(),
        ];
        return view('laporan.departemen.index', $data);
    }

    public function getdepartemen(Request $r)
    {
        $data = [
            'title' => 'Laporan Data Departmen',
            'departemen' => Departemen::where('cabang_id', $r->cabang)->orderBY('id', 'desc')->get(),
        ];
        return view('laporan.departemen.getDepartemen', $data);
    }
    public function print(Request $r)
    {
        $data = [
            'title' => 'Laporan Data Departmen',
            'departemen' => Departemen::where('cabang_id', $r->cabang)->orderBY('id', 'desc')->get(),
            'cabang' => Cabang::where('id', $r->cabang)->first()
        ];
        return view('laporan.departemen.print', $data);
    }
}
