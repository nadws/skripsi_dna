<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\KategoriAsset;
use App\Models\PembelianBarang;
use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Suplier',
            'suplier' => Suplier::all(),
            'kategori' => KategoriAsset::all(),
            'cabang' => Cabang::all(),
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
            'cabang_id' => $request->cabang_id,
            'kategori_id' => $request->kategori_id
        ]);
        return redirect()->route('suplier.index')->with('success', 'Data Suplier Berhasil Ditambahkan');
    }

    public function delete($id)
    {
        $pembelian = PembelianBarang::where('suplier_id', $id)->first();
        if (empty($pembelian)) {
            Suplier::find($id)->delete();
            return redirect()->route('suplier.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('suplier.index')->with('error', 'Data Gagal dihapus karena sudah ada data transaksinya');
        }
    }

    public function getEdit(Request $r)
    {
        $data = [
            'title' => 'Edit Suplier',
            'suplier' => Suplier::find($r->id),
            'kategori' => KategoriAsset::all(),
            'cabang' => Cabang::all(),

        ];
        return view('superadmin.suplier.edit', $data);
    }

    public function update(Request $request)
    {
        Suplier::where('id', $request->id)->update([
            'nama' => $request->nama,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'cabang_id' => $request->cabang_id,
            'kategori_id' => $request->kategori_id
        ]);
        return redirect()->route('suplier.index')->with('success', 'Data Suplier Berhasil Ditambahkan');
    }
}
