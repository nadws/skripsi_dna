<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\PerbaikanAsset;
use Illuminate\Http\Request;

class LaporanPerbaikanIventaris extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Data Perbaikan Iventaris',
            'cabang' => Cabang::all(),
        ];
        return view('laporan.perbaikan-iventaris.index', $data);
    }
    public function getdata(Request $r)
    {
        dd($r);
        $data = [
            'title' => 'Laporan Data Perbaikan Iventaris',
            'perbaikan' => PerbaikanAsset::where('cabang_id', $r->cabang)
                ->whereBetween('tgl_perbaikan', [$r->tgl_awal, $r->tgl_akhir])
                ->orderBy('id', 'desc')->get()
        ];
        return view('laporan.perbaikan-iventaris.getData', $data);
    }
    public function print(Request $r)
    {
        $data = [
            'title' => 'Laporan Data Perbaikan Iventaris',
            'perbaikan' => PerbaikanAsset::where('cabang_id', $r->cabang)->orderBy('id', 'desc')->get(),
            'cabang' => Cabang::where('id', $r->cabang)->first(),
        ];
        return view('laporan.perbaikan-iventaris.print', $data);
    }
}
