<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CartApiTest extends TestCase
{
    use RefreshDatabase;
    // Test 1- login user cart dekh sakta hai
    public function test_authticate_user_can_get_cart()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user,'sanctum')->getJson('/api/cart');
        $response->assertStatus(200)->assertJson(['status'=>true]);
    }

      public function test_unauthticate_user_can_not_get_cart()
    {
        $response = $this->getJson('/api/cart');
        $response->assertStatus(401);
    }

    public function test_user_can_sync_cart()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $productItem = ProductItem::factory()->create([
            'product_id' => $product->id
        ]); 
        
        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/cart/sync', [
                'cart' => [
                    [
                        'product_id'      => $product->id,      // ← real id
                        'product_item_id' => $productItem->id,  // ← real id
                        'quantity'        => 2,
                        'price'           => 1000,
                    ]
                ]
            ]);

        $response->assertStatus(200)
            ->assertJson(['status' => true]);
    }

        public function test_user_can_remove_cart_item()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $productItem = ProductItem::factory()->create([
            'product_id' => $product->id
        ]);

        $cart = Cart::factory()->create([
            'user_id'         => $user->id,
            'product_id'      => $product->id,
            'product_item_id' => $productItem->id,
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/cart/remove/' . $cart->id); // ← POST aur /remove/ add kiya

        $response->assertStatus(200)
            ->assertJson(['status' => true]);
    }
}
