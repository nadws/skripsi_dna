<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabang;
use App\Models\Departemen;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class DepartemenCOntroller extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Departemen',
            'departemen' => Departemen::where('cabang_id', Auth::user()->cabang_id)->orderBY('id', 'desc')->get(),
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

    public function delete($id)
    {
        $karyawan = Karyawan::where('departemen_id', $id)->first();
        if (empty($karyawan)) {
            Departemen::find($id)->delete();
            return redirect()->route('departemen.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('departemen.index')->with('error', 'Data Gagal dihapus karena sudah ada data transaksinya');
        }
    }

    public function getEdit(Request $r)
    {
        $data = [
            'title' => 'Edit Suplier',
            'departemen' => Departemen::find($r->id),

        ];
        return view('departemen.edit', $data);
    }

    public function update(Request $r)
    {
        $data = [
            'nama' => $r->nama,
            'cabang_id' => $r->cabang_id
        ];
        Departemen::where('id', $r->id)->update($data);

        return redirect()->route('departemen.index')->with('success', 'Data berhasil disimpan');
    }
}
