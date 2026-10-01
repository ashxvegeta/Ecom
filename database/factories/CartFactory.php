<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition()
    {
        return [
            'user_id'         => User::factory(),
            'product_id'      => Product::factory(),
            'product_item_id' => ProductItem::factory(),
            'quantity'        => 1,
            'price'           => 1000,
        ];
    }
}