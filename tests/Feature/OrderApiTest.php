<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
  

    use  RefreshDatabase;
    // Test 1 — Login user orders dekh sakta hai
    public function test_authenticated_user_can_get_orders()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user,'sanctum')->getJson('/api/orderslist');
        $response->assertStatus(200)->assertJson(['status'=>true]);
    }

    //Test 2 - Bina login orders nahi dekh sakta 
    public function test_unauthenticated_user_can_get_orders(){
        $response = $this->getJson('/api/orderslist');
        $response->assertStatus(401);
    }

    //test 3 order details 
    public function test_user_can_get_order_details(){
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id'=>$user->id]);
        $response = $this->actingAs($user, 'sanctum')->getJson('/api/ordersdetails/' . $order->id);
        $response->assertStatus(200)->assertJson(['status' => true]);

    }

    // test 4 Doosre user ka order nahi dekh sakta
    public function test_user_cannot_get_order_details(){
        $user1 =  User::factory()->create();
        $user2 = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user2->id]);
        $response =  $this->actingAs($user1,'sanctum')->getJson('/api/ordersdetails/'.$order->id);
        $response->assertStatus(404);
    }

    
}
