<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'link',
        'user_id',
        'read',
        'icon',
        'status'
    ];
}
