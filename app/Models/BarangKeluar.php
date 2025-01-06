<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'vendor_id', 'jumlah', 'tanggal_keluar'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($barangKeluar) {
            $barang = $barangKeluar->barang;
            $barang->stok_awal -= $barangKeluar->jumlah;
            $barang->save();
            $barang->checkReorderPoint();
        });
    }
}
