<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanBarang extends Model
{

    protected $fillable = ['invoice', 'barang_id', 'cabang_id', 'jumlah', 'kategori', 'keterangan', 'status', 'ket_presiden', 'tgl_permintaan'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function pembelian()
    {
        return $this->belongsTo(PembelianBarang::class, 'invoice', 'invoice');
    }
    public function overstock()
    {
        return $this->belongsTo(OverBarang::class, 'invoice', 'invoice');
    }
}
