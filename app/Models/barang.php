<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    //
    protected $fillable = [
        'kode',
        'images',
        'deskripsi',
        'nama',
        'quantity',
        'kategori',
    ];

    public function peminjaman(){
        return $this->hasMany(peminjaman::class,'barang_id','id');
    }
}
