<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\KategoriAsset;
use App\Models\PerbaikanAsset;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Vendor',
            'vendor' => Vendor::orderBy('id', 'desc')->get(),
            'kategori' => KategoriAsset::all(),
            'cabang' => Cabang::all(),
        ];
        return view('superadmin.vendor.index', $data);
    }

    public function store(Request $r)
    {
        $data = [
            'nama' => $r->nama,
            'telepon' => $r->telepon,
            'alamat' => $r->alamat,
            'kategori_id' => $r->kategori_id,
            'cabang_id' => $r->cabang_id
        ];
        Vendor::create($data);

        return redirect()->route('vendor.index')->with('success', 'Data berhasil disimpan');
    }

    public function delete($id)
    {
        $perbaikan = PerbaikanAsset::where('vandor_id', $id)->first();
        if (empty($perbaikan)) {
            Vendor::find($id)->delete();
            return redirect()->route('vendor.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('vendor.index')->with('error', 'Data Gagal dihapus karena sudah ada data transaksinya');
        }
    }

    public function getEdit(Request $r)
    {
        $data = [
            'title' => 'Edit Suplier',
            'vendor' => Vendor::find($r->id),
            'kategori' => KategoriAsset::all(),
            'cabang' => Cabang::all(),

        ];
        return view('superadmin.vendor.edit', $data);
    }

    public function update(Request $r)
    {
        $data = [
            'nama' => $r->nama,
            'telepon' => $r->telepon,
            'alamat' => $r->alamat,
            'kategori_id' => $r->kategori_id,
            'cabang_id' => $r->cabang_id
        ];
        Vendor::where('id', $r->id)->update($data);

        return redirect()->route('vendor.index')->with('success', 'Data berhasil disimpan');
    }
}
