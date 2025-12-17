<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Disposal;
use Illuminate\Http\Request;

class LaporanDisposal extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Data Disposal Iventaris',
            'cabang' => Cabang::all(),
        ];
        return view('laporan.disposal.index', $data);
    }
    public function getdata(Request $r)
    {
        $data = [
            'title' => 'Laporan Data Disposal Iventaris',
            'disposal' => Disposal::where('cabang_id', $r->cabang)
                ->whereBetween('tgl_disposal', [$r->tgl_awal, $r->tgl_akhir])
                ->orderBy('id', 'desc')->get(),
        ];
        return view('laporan.disposal.getData', $data);
    }
    public function print(Request $r)
    {
        $data = [
            'title' => 'Laporan Data Disposal Iventaris',
            'disposal' => Disposal::where('cabang_id', $r->cabang)
                ->whereBetween('tgl_disposal', [$r->tgl_awal, $r->tgl_akhir])
                ->orderBy('id', 'desc')->get(),
            'cabang' => Cabang::where('id', $r->cabang)->first(),
        ];
        return view('laporan.disposal.print', $data);
    }
}
