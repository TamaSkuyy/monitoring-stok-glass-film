<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Pastikan ada vendor terlebih dahulu
        // if (Vendor::count() === 0) {
        //     $this->call(VendorSeeder::class);
        // }

        // Membuat 50 barang menggunakan factory
        Barang::factory(36)->create();
    }
}
