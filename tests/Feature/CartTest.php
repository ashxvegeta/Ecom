<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductItem;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function user_can_add_product_to_cart()
    {
         // 1. Product banao
        $brand = Brand::factory()->create();
        $product = Product::factory()->create([
            'brand_id' => $brand->id,
            'status' => 1,
        ]);
        $productItem = ProductItem::factory()->create([
            'product_id' => $product->id,
            'price' => 100,
            'stock' => 10,
        ]);

        // 2. POST /cart/add
        $response = $this->post('/cart/add', [
            'product_id' => $product->id,
            'product_item_id' => $productItem->id,
            'quantity' => 2,
        ]);

        // 3. Cart session me product add hua hai ya nahi check karo
        $this->assertEquals(2,session('cart.' . $product->id . '.quantity'));
        $response->assertStatus(302);
    }


    #[\PHPUnit\Framework\Attributes\Test]
    public function user_can_remove_item_from_cart()
    {
         // 1. Product banao
        $brand = Brand::factory()->create();
        $product = Product::factory()->create([
            'brand_id' => $brand->id,
            'status' => 1,
        ]);
        $productItem = ProductItem::factory()->create([
            'product_id' => $product->id,
            'price' => 100,
            'stock' => 10,
        ]);

        // 2. Cart session me product add karo
        session(['cart.' . $product->id => [
            'product_id' => $product->id,
            'quantity'   => 1,
            'price'      => $productItem->price,
        ]]);
        // 2. POST /cart/remove
        $response = $this->post(route('cart.remove', $product->id), [
            'product_id' => $product->id,
            'product_item_id' => $productItem->id,
        ]);

        //3 Assert — cart empty ho gayi
        $this->assertNull(session('cart.' . $product->id));
        $response->assertStatus(302);
    }


}
