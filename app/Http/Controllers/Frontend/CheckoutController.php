<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Services\CartService;

use App\Actions\Order\PlaceOrderAction;

use App\Http\Requests\PlaceOrderRequest;

use App\Models\Order;

class CheckoutController extends Controller
{


    public function __construct(
            private CartService $cartService
    ) {}

    public function index()
    {    

        $checkoutdata = $this->cartService->getCheckoutData();
        return view('frontend.checkout.index',compact('checkoutdata'));

    }

    public function placeOrder(placeOrderRequest $request, PlaceOrderAction $placeOrderAction)
    {
        $order = $placeOrderAction->execute($request->validated());
        return redirect()->route('order.success', $order->id);
    }

   
}