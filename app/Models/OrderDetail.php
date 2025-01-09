<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'barang_id',
        'jumlah',
        'subtotal',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

}
