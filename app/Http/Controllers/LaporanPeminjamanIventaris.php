<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\PeminjamanAsset;
use Illuminate\Http\Request;

class LaporanPeminjamanIventaris extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Data Peminjaman Iventaris',
            'cabang' => Cabang::all(),
        ];
        return view('laporan.peminjaman-iventaris.index', $data);
    }
    public function getData(Request $r)
    {
        $data = [
            'title' => 'Laporan Data Peminjaman Iventaris',
            'peminjaman' => PeminjamanAsset::where('cabang_id', $r->cabang)->orderBy('id', 'desc')->get()
        ];
        return view('laporan.peminjaman-iventaris.getData', $data);
    }
    public function print(Request $r)
    {
        $data = [
            'title' => 'Laporan Data Peminjaman Iventaris',
            'peminjaman' => PeminjamanAsset::where('cabang_id', $r->cabang)->orderBy('id', 'desc')->get(),
            'cabang' => Cabang::where('id', $r->cabang)->first(),
        ];
        return view('laporan.peminjaman-iventaris.print', $data);
    }
}
