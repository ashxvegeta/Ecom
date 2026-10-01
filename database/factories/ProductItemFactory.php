<?php

namespace Database\Factories;

use App\Models\ProductItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductItem>
 */
class ProductItemFactory extends Factory
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
        'product_id' => Product::factory(),
        'sku'        => $this->faker->unique()->word(),
        'price'      => $this->faker->randomFloat(2, 1000, 100000),
        'stock'      => 10,
        'status'     => 1,
        ];
    }
}
