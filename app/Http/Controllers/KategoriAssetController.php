<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriAsset;
use App\Models\Suplier;
use App\Models\Vendor;
use Illuminate\Http\Request;

class KategoriAssetController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kategori Asset',
            'kategori_asset' => KategoriAsset::orderBy('id', 'desc')->get()
        ];
        return view('superadmin.kategori-asset.index', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'kategori' => $request->kategori
        ];
        KategoriAsset::create($data);
        return redirect()->route('kategori.index')->with('success', 'Data berhasil disimpan');
    }

    public function delete($id)
    {
        $asset = Barang::where('kategori_id', $id)->first();
        $suplier = Suplier::where('kategori_id', $id)->first();
        $vendor = Vendor::where('kategori_id', $id)->first();
        if (empty($asset) || empty($suplier) || empty($vendor)) {
            KategoriAsset::find($id)->delete();
            return redirect()->route('kategori.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Data Gagal dihapus karena sudah ada data transaksinya');
        }
    }

    public function getEdit(Request $r)
    {
        $data = [
            'title' => 'Edit User',
            'kategori' => KategoriAsset::find($r->id),

        ];
        return view('superadmin.kategori-asset.edit', $data);
    }

    public function update(Request $request)
    {
        $data = [
            'kategori' => $request->kategori
        ];
        KategoriAsset::where('id', $request->id)->update($data);
        return redirect()->route('kategori.index')->with('success', 'Data berhasil disimpan');
    }
}
