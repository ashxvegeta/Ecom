<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        'name'              => $this->faker->words(3, true),
        'slug'              => $this->faker->slug(),
        'short_description' => $this->faker->sentence(),
        'description'       => $this->faker->paragraph(),
        'brand_id'          => Brand::factory(),
        'status'            => 1,
        'featured'          => 0,
        ];
    }
}
