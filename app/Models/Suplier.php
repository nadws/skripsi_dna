<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $fillable = ['nama', 'alamat', 'telp', 'keterangan', 'cabang_id', 'kategori_id'];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriAsset::class, 'kategori_id');
    }
}
