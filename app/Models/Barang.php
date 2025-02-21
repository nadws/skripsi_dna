<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{

    protected $fillable = [
        'kode',
        'nama_barang',
        'merek',
        'image',
        'cabang_id'
    ];
    public static function getBarang($cabang_id)
    {
        if ($cabang_id == 0) {
            $where = "";
        } else {
            $where = "WHERE b.cabang_id = $cabang_id";
        }
        return DB::select("SELECT a.*, (Coalesce(b.debit, 0) - Coalesce(b.kredit, 0)) as stok,
        (SELECT harga FROM stoks WHERE barang_id = a.id ORDER BY created_at DESC LIMIT 1) AS harga_terbaru
            FROM barangs as a
                left join (
                    SELECT barang_id, sum(debit) as debit, sum(kredit) as kredit
                    FROM stoks as b
                    $where
                    group by b.barang_id
                ) as b on a.id = b.barang_id
            
        ");
    }
}
