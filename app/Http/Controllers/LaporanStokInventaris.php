<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cabang;
use Illuminate\Http\Request;

class LaporanStokInventaris extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Stok Inventaris',
            'cabang' => Cabang::all(),
        ];
        return view('laporan.stok_inventaris.index', $data);
    }

    public function getStok(Request $r)
    {
        $data = [
            'title' => 'Daftar Barang',
            'barang' =>  Barang::getBarang($r->cabang),
        ];
        return view('laporan.stok_inventaris.getBarang', $data);
    }
    public function print(Request $r)
    {
        $data = [
            'title' => 'Laporan Daftar Barang',
            'barang' =>  Barang::getBarang($r->cabang),
            'cabang' => Cabang::where('id', $r->cabang)->first()
        ];
        return view('laporan.stok_inventaris.print', $data);
    }
}
