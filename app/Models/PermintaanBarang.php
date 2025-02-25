<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanBarang extends Model
{

    protected $fillable = ['invoice', 'barang_id', 'cabang_id', 'jumlah', 'kategori', 'keterangan', 'status'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
