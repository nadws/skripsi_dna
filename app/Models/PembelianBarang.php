<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembelianBarang extends Model
{
    protected $table = 'pembelian_barangs';
    protected $fillable = [
        'invoice',
        'barang_id',
        'cabang_id',
        'suplier_id',
        'jumlah',
        'harga_satuan',
        'status',
    ];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'suplier_id');
    }
}
