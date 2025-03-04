<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    //
    protected $fillable = [
        'anggota_id',
        'barang_id',
        'quantity',
        'status',
    ];

    public function barang(){
        return $this->belongsTo(Barang::class,'barang_id','id');
    }
    public function anggota(){
        return $this->belongsTo(User::class,'anggota_id','id');
    }
}
