<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_barang' => $this->faker->unique()->randomNumber(5),
            'nama_barang' => $this->faker->word(),
            'stok_awal' => $this->faker->numberBetween(1, 100),
            'stok_akhir' => $this->faker->numberBetween(1, 100),
            'reorder_point' => $this->faker->word(),
            'stok_maksimal' => $this->faker->numberBetween(100, 200),
            'stok_minimal' => $this->faker->numberBetween(1, 50),
            'type' => $this->faker->randomElement(['Pcs', 'Box', 'Roll']),
            'kategori' => $this->faker->randomElement(['Retail', 'Suzuki', 'Tango']),
            'vendor_id' => Vendor::factory(), // Relasi ke Vendor
        ];
    }
}
