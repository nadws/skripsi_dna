<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class LaporanCabang extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Data Cabang',
            'cabang' => Cabang::orderBY('id', 'desc')->get()
        ];

        return view('laporan.cabang.index', $data);
    }
    public function print()
    {
        $data = [
            'title' => 'Laporan Data Cabang',
            'cabang' => Cabang::orderBY('id', 'desc')->get()
        ];

        return view('laporan.cabang.print', $data);
    }
}
