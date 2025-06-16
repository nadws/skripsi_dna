<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'cabang_id',
        'kategori_id',
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriAsset::class, 'kategori_id');
    }
}
