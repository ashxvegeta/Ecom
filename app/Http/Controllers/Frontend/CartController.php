<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    //

     public function __construct(
        private CartService $cartService
    ) {}


    public function addToCart(Request $request){
        $this->cartService->add($request->product_id,$request->quantity ?? 1); 
        
        return redirect()->back()->with('success','Product added to cart!');
    }
}
