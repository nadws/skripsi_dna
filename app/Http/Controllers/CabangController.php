<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cabang;

class CabangController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Cabang',
            'cabang' => Cabang::orderBY('id', 'desc')->get()
        ];

        return view('superadmin.cabang.index', $data);
    }

    public function store(Request $r)
    {
        $data = [
            'nama' => $r->nama,
            'alamat' => $r->alamat,
            'ket' => $r->ket
        ];
        Cabang::create($data);
        return redirect()->route('cabang.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function delete($id)
    {
        Cabang::find($id)->delete();
        return redirect()->route('cabang.index')->with('success', 'Data Berhasil Dihapus');
    }
}
