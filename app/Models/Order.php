<?php

// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['kode_order', 'tanggal_order', 'vendor_id', 'total', 'status_order', 'user_id'];

    public function barang(): BelongsToMany
    {
        return $this->belongsToMany(Barang::class, 'order_barang', 'order_id', 'barang_id')
            ->withPivot('Jumlah_Order');
    }
}
