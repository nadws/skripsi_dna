<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabang;
use App\Models\Departemen;
use Illuminate\Support\Facades\Auth;

class DepartemenCOntroller extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Departemen',
            'departemen' => Departemen::orderBY('id', 'desc')->get(),
            'cabang' => Cabang::all(),
            'cabang_id' => Auth::user()->cabang_id,
        ];

        return view('departemen.index', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'cabang_id' => $request->cabang_id
        ];
        Departemen::create($data);
        return redirect()->route('departemen.index')->with('success', 'Data Berhasil Disimpan');
    }
}
