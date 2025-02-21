<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $fillable = [
        'barang_id',
        'tanggal',
        'debit',
        'kredit',
        'cabang_id',
        'ket',
        'harga',
    ];
}
