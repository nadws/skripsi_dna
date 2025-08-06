<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\KategoriAsset;
use App\Models\Vendor;
use Illuminate\Http\Request;

class LaporanVendor extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Vendor',
            'vendor' => Vendor::orderBy('id', 'desc')->get(),

        ];
        return view('laporan.vendor.index', $data);
    }
    public function print()
    {
        $data = [
            'title' => 'Data Vendor',
            'vendor' => Vendor::orderBy('id', 'desc')->get(),

        ];
        return view('laporan.vendor.print', $data);
    }
}
