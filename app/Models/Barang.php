<?php

// app/Models/Barang.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang', 'kode_barang', 'stok_awal', 'stok_akhir', 'reorder_point', 'stok_maksimal', 'stok_minimal', 'type', 'kategori', 'vendor_id'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function checkReorderPoint()
    {
        if ($this->stok_awal <= $this->reorder_point) {
            $this->triggerReorderNotification();
        }
    }

    protected function triggerReorderNotification()
    {
        Log::info("Reorder point tercapai untuk barang: {$this->nama_barang}");
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_barang', 'barang_id', 'order_id')
            ->withPivot('Jumlah_Order');
    }
}

