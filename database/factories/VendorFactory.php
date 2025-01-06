<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'kode_vendor' => $this->faker->unique()->numerify('VEND###'), // Format kode_vendor
            'nama_vendor' => $this->faker->company(),
            'kontak' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
        ];
    }
}
