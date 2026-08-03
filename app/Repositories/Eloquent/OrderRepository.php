<?php
namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Collection;
use App\Models\ProductItem;
use App\Repositories\Contracts\OrderRepositoryInterface;


class OrderRepository implements OrderRepositoryInterface{

   public function createOrder(array $data): Order
   {
       return Order::create($data);
   }


   public function createOrderItems(Order $order, Collection $cart):void{
              
        foreach($cart as $item){
            $order->items()->create([
                'product_id' => $item['product_id'],
                'product_item_id' => $item['product_item_id'] ?? null,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }
   }

   public function reduceStock(Collection $cart):void{
        foreach($cart as $item){
            $productItem = ProductItem::findOrFail($item['product_item_id']);
            if($productItem->stock < $item['quantity']){
                throw new \Exception('Insufficient stock for product: ' . $item['name']);
            }
            $productItem->decrement('stock', $item['quantity']);
        }
   }



}