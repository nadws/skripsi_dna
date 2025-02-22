<?php

namespace App\Http\Controllers;

use App\Models\KategoriAsset;
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
}
