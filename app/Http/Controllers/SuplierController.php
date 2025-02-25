<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Suplier',
            'suplier' => Suplier::all(),
        ];
        return view('superadmin.suplier.index', $data);
    }

    public function store(Request $request)
    {
        Suplier::create([
            'nama' => $request->nama,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('suplier.index')->with('success', 'Data Suplier Berhasil Ditambahkan');
    }
}
