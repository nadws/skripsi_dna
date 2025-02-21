<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Cabang;
use App\Models\Departemen;

class KaryawanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Karyawan',
            'karyawan' => Karyawan::orderBy('id', 'desc')->get(),
            'cabang' => Cabang::all(),
            'departemen' => Departemen::all()
        ];
        return view('karyawan.index', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'cabang_id' => $request->cabang_id,
            'departemen_id' => $request->departemen_id,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_gabung' => $request->tgl_gabung,
            'alamat' => $request->alamat,
        ];
        Karyawan::create($data);
        return redirect()->route('karyawan.index')->with('success', 'Data Berhasil Disimpan');
    }
}
