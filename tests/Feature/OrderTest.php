<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function authenticated_user_can_place_order()
    {
        //1 User banao - login k lia
        $user = User::factory()->create();
        //2 brand banao
        $brand = Brand::factory()->create();
        //2 category banao
        $category = Category::factory()->create();
        //2 product banao
        $prodduct = Product::factory()->create([
            'brand_id' => $brand->id,
            'status' => 1,
        ]);

        $prodductItem = ProductItem::factory()->create([
            'product_id' => $prodduct->id,
            'price' => 100,
            'stock' => 10,
        ]);
        //3. cart session me product add karo
        session(['cart' => [
            $prodduct->id => [
                'product_item_id' => $prodductItem->id,
                'brand' => $brand->name,
                'product_id' => $prodduct->id,
                'name' => $prodduct->name,
                'price' => $prodductItem->price,
                'quantity' => 2,
                'image' => null,
            ],
        ]]);
           // 4. Order place karo
        $response = $this->actingAs($user)->post('/checkout/place-order', [
                'first_name'     => 'Test',
                'last_name'      => 'User',
                'email'          => $user->email,
                'phone'          => '9876543210',
                'address'        => '123 Test Street',
                'city'           => 'Mumbai',
                'state'          => 'Maharashtra',
                'pincode'        => '400001',
                'payment_method' => 'cod',
        ]);
        // 5. Assert karo
        // Redirect hua?
        $response->assertStatus(302); // Redirect after successful order placement


        //  Order database me save hua?
        $this->assertDatabaseHas('orders', [
            'user_id'        => $user->id,
            'first_name'     => 'Test',
            'last_name'      => 'User',
            'payment_method' => 'cod',
        ]);

        // Order items database me save hua?
        $this->assertDatabaseHas('order_items', [
            'product_id' => $prodduct->id,
            'quantity'   => 2,
            'price'      => 100,
        ]);
     
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function guest_cannot_place_order()
    {
        $response = $this->post('/checkout/place-order', [
            'first_name'     => 'Test',
            'last_name'      => 'User',
            'email'          => 'test@test.com',
            'phone'          => '9876543210',
            'address'        => '123 Test Street',
            'city'           => 'Mumbai',
            'state'          => 'Maharashtra',
            'pincode'        => '400001',
            'payment_method' => 'cod',
        ]);

        // Login pe redirect hona chahiye
        $response->assertRedirect('/login');
    }

   
  
}