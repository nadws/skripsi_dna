<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverBarang extends Model
{
    protected $table = 'over_barangs';
    protected $fillable = ['invoice', 'barang_id', 'ke_cabang_id', 'dari_cabang_id', 'jumlah', 'harga_satuan', 'status'];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'dari_cabang_id');
    }
}
