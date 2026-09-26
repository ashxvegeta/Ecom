<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Services\CartService;

use App\Services\RazorpayService;

use App\Actions\Order\PlaceOrderAction;

use App\Http\Requests\PlaceOrderRequest;

use App\Models\Order;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{


    public function __construct(
            private CartService $cartService,
            private RazorpayService $razorpayService
    ) {}

    public function index()
    {    

        $checkoutdata = $this->cartService->getCheckoutData();
        return view('frontend.checkout.index',compact('checkoutdata'));

    }

       public function placeOrder(PlaceOrderRequest $request, PlaceOrderAction $action)
    {

 
        
        if($request->payment_method == 'cod') {
            $order = $action->execute($request->validated());
            return redirect()->route('order.success', $order->id);
        }
        

        // Razorpay verify
        $verified = $this->razorpayService->verifyPayment(
            $request->razorpay_order_id,
            $request->razorpay_payment_id,
            $request->razorpay_signature
        );

        if(!$verified) {
            return redirect()->back()->with('error', 'Payment verification failed!');
        }
        

        $order = $action->execute($request->validated());
        return redirect()->route('order.success', $order->id);
    }

    public function initiateRazorpay(Request $request)
    {
        $subtotal = $this->cartService->subtotal();
        $razorpayOrder = $this->razorpayService->createOrder($subtotal);

        return response()->json([
            'order_id' => $razorpayOrder['id'],
            'amount'   => $razorpayOrder['amount'],
            'key'      => config('services.razorpay.key_id'),
        ]);
    }

}