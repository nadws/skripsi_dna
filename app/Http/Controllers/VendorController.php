<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Vendor',
            'vendor' => Vendor::orderBy('id', 'desc')->get(),
        ];
        return view('superadmin.vendor.index', $data);
    }

    public function store(Request $r)
    {
        $data = [
            'nama' => $r->nama,
            'telepon' => $r->telepon,
            'alamat' => $r->alamat,
        ];
        Vendor::create($data);

        return redirect()->route('vendor.index')->with('success', 'Data berhasil disimpan');
    }
}
