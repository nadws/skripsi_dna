<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\PermintaanBarang;
use Illuminate\Http\Request;

class LaporanPermintaanInventaris extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Data Permintaan Iventaris',
            'cabang' => Cabang::all(),
        ];
        return view('laporan.permintaan-iventaris.index', $data);
    }
    public function getdata(Request $r)
    {
        $data = [
            'title' => 'Laporan Data Permintaan Iventaris',
            'permintaan' => PermintaanBarang::where('cabang_id', $r->cabang)->orderBy('id', 'desc')->get(),
        ];
        return view('laporan.permintaan-iventaris.getData', $data);
    }
    public function print(Request $r)
    {
        $data = [
            'title' => 'Laporan Data Permintaan Iventaris',
            'permintaan' => PermintaanBarang::where('cabang_id', $r->cabang)->orderBy('id', 'desc')->get(),
            'cabang' => Cabang::where('id', $r->cabang)->first(),
        ];
        return view('laporan.permintaan-iventaris.print', $data);
    }
}
