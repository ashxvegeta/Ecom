<?php
namespace App\Actions\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;

class PlaceOrderAction
{
    public function __construct(protected OrderRepositoryInterface $orderRepository,protected CartService $cartService)
    {
    }
    

    public function execute(array $data): Order
    {
        return DB::transaction(function () use ($data) {

            // get cart
            $cart = $this->cartService->getCart();
            if (empty($cart)) {
                throw new \Exception('Cart is empty');
            }
              // Calculate totals
            $subtotal = $cart->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });
            $shippingCharge = 0;
            $shippingCharge = $data['shipping_charge'] ?? 0;
            $grandTotal = $subtotal + $shippingCharge;
            // create order
            $orderData = [
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'pincode' => $data['pincode'],
                'subtotal' => $subtotal,
                'shipping_charge' => $shippingCharge,
                'grand_total' => $grandTotal,
                'payment_method' => $data['payment_method'],
                'payment_status' => PaymentStatus::PENDING,  // ← Enum
                'order_status' => OrderStatus::PENDING,  // ← Enum
            ];

            $order = $this->orderRepository->createOrder($orderData);
            // create order items
            $this->orderRepository->createOrderItems($order,$cart);
            // reduce stock
            $this->orderRepository->reduceStock($cart);
            //clear session cart
            $this->cartService->clearCart();

            //fire  event

            return $order;
          
        });
    }

    
}