<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Cabang;
use App\Models\Stok;

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
        $asset = Stok::where('cabang_id', $id)->first();
        if (empty($asset)) {
            Cabang::find($id)->delete();
            return redirect()->route('cabang.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('cabang.index')->with('error', 'Data Gagal dihapus karena sudah ada data transaksinya');
        }
    }

    public function getEdit(Request $r)
    {
        $data = [
            'title' => 'Edit User',
            'cabang' => Cabang::find($r->id),

        ];
        return view('superadmin.cabang.edit', $data);
    }

    public function update(Request $r)
    {
        $data = [
            'nama' => $r->nama,
            'alamat' => $r->alamat,
            'ket' => $r->ket
        ];
        Cabang::where('id', $r->id)->update($data);
        return redirect()->route('cabang.index')->with('success', 'Data Berhasil Disimpan');
    }
}
