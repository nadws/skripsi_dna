<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class LaporanSupllier extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Suplier',
            'suplier' => Suplier::all(),

        ];
        return view('laporan.suplier.index', $data);
    }
    public function print()
    {
        $data = [
            'title' => 'Data Suplier',
            'suplier' => Suplier::all(),

        ];
        return view('laporan.suplier.print', $data);
    }
}
