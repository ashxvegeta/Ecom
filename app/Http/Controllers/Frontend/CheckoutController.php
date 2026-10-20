<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Services\CartService;

use App\Services\RazorpayService;

use App\Actions\Order\PlaceOrderAction;

use App\Http\Requests\PlaceOrderRequest;

use App\Models\Order;
    
use Illuminate\Http\Request;

use App\Models\Product;

class CheckoutController extends Controller
{


    public function __construct(
            private CartService $cartService,
            private RazorpayService $razorpayService
    ) {}

    public function index()
    {    
        $checkoutdata = $this->cartService->getCheckoutData();
        if(empty($checkoutdata)){
            return redirect()->route('home');
        }
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
        // Payment ID save karo
        $order->payment_id = $request->razorpay_payment_id;
        $order->save();
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

    public function buyNow(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'nullable|integer|min:1',
    ]);

    $productId = (int) $request->product_id;
    $quantity  = (int) ($request->quantity ?? 1);

    // Stock check
    $product = Product::with('productItems')->findOrFail($productId);
    $productItem = $product->productItems->first();

    if (!$productItem || $productItem->stock < $quantity) {
        return redirect()->back()->with('error', 'Product is out of stock!');
    }

    // Save only in temporary session (DO NOT touch database Cart)
    session()->put('buy_now', [
        'product_id' => $productId,
        'quantity'   => $quantity,
    ]);

    return redirect()->route('checkout');
}


}