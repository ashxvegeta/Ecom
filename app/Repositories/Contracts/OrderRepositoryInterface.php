<?php
namespace App\Repositories\Contracts;
use App\Models\Order;
use Illuminate\Support\Collection;  

interface OrderRepositoryInterface
{
    public function createOrder(array $data): Order;
    public function createOrderItems(Order $order, Collection $cart):void;
    public function reduceStock(Collection $cart):void;
}