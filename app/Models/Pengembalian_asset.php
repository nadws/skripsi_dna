<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian_asset extends Model
{
    protected $fillable = [
        'peminjaman_id',
        'barang_id',
        'cabang_id',
        'tgl_pengembalian',
        'qty',
    ];
}
