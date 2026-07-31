<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Services\CartService;

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
}