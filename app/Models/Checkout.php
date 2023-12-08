<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $table = 'checkout';
    protected $fillable = [
        'user_id',
        'toko_id',
        'pesanan_id',
        'produk',
        'produk_id',
        'harga',
        'jumlah',
        'keterangan',
        'status',
        'total',
    ];
}
