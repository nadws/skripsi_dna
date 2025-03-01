<?php

namespace App\Http\Controllers;

use App\Models\PermintaanBarang;
use App\Models\Stok;
use Illuminate\Http\Request;

class AccPengajuanPermintaanassetController extends Controller
{
    public function index(){
        $data = [
            'title' => "Pengajuan Permintaan Asset",
            'permintaan' => PermintaanBarang::orderBy('id', 'desc')->get(),
        ];
        return view('accpermintaanasset.index',$data);
    }

    public function getEdit(Request $r){
        $data = [
            'p' => PermintaanBarang::where('id',$r->id)->first()
        ];
        return view('accpermintaanasset.accpermintaan',$data);
    }

    public function edit(Request $r){
        if($r->tombol == 'tolak'){
            PermintaanBarang::where('id',$r->id)->update(['status'=>'rejected']);
        } else
        {
            PermintaanBarang::where('id',$r->id)->update(['status'=>'approved']);
            $permintaan = PermintaanBarang::where('id',$r->id)->first();

            if ($permintaan->kategori == 'pembelian') {
                $data2 = [
                    'barang_id' => $permintaan->barang_id,
                    'debit' => $permintaan->jumlah,
                    'kredit' => 0,
                    'ket' => 'Stok Masuk Pembelian',
                    'cabang_id' => $permintaan->cabang_id,
                    'harga' => $permintaan->pembelian->harga_satuan,
                    'tanggal' => date('Y-m-d')
                ];
                Stok::create($data2);
            } else {
                $data2 = [
                    'barang_id' => $permintaan->barang_id,
                    'debit' => $permintaan->jumlah,
                    'kredit' => 0,
                    'ket' => 'Stok Masuk Overstok',
                    'cabang_id' => $permintaan->cabang_id,
                    'harga' => $permintaan->overstock->harga_satuan,
                    'tanggal' => date('Y-m-d')
                ];
                Stok::create($data2);
                $data3 = [
                    'barang_id' => $permintaan->barang_id,
                    'debit' => 0,
                    'kredit' => $permintaan->jumlah,
                    'ket' => 'Stok Keluar Overstok',
                    'cabang_id' => $permintaan->overstock->dari_cabang_id,
                    'harga' => $permintaan->overstock->harga_satuan,
                    'tanggal' => date('Y-m-d')
                ];
                Stok::create($data3);
            }
            

        }

        return redirect()->route('accpermintaan.index')->with('success', 'Data Berhasil Disimpan');
    }
}
