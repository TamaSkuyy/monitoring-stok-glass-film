<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->integer('stok_awal')->default(0);
            $table->integer('stok_akhir')->default(0);
            $table->string('reorder_point');
            $table->integer('stok_maksimal')->default(0);
            $table->integer('stok_minimal')->default(0);
            $table->text('type')->nullable();
            $table->text('kategori')->nullable();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade'); // Relasi ke vendor
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
