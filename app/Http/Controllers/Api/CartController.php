<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Http\Resources\CartResource;
use App\Services\CartService;


class CartController extends Controller
{
    //

    public function __construct(private CartService $cartService) {}

    public function index(Request $request){
        $cart = Cart::where('user_id',auth()->id())
        ->with(['product.productImages','product.brand','productItem'])
        ->get();

        return response()->json([
            'status'=>true,
            'data'=>CartResource::collection($cart)
        ]);
    }

    public function sync(Request $request){
        // frontend se aaaya data
        $cartItems = $request->cart;
        foreach($cartItems as $item){
            Cart::updateOrCreate(
            [  // ← pehla array
            'user_id'         => auth()->id(),
            'product_id'      => $item['product_id'],
            'product_item_id' => $item['product_item_id'],
            ],
            [  // ← dusra array
            'quantity' => $item['quantity'],
            'price'    => $item['price'],
            ]
            );
        }
        return response()->json([
            'status'  => true,
            'message' => 'Cart synced successfully'
        ]);
    }

    public function removeFromCart(int $id){
      $removed = $this->cartService->removecart($id);
      if(!$removed){
         return response()->json([
            'status'  => false,
            'message' => 'Item not found'
        ], 404);
      }
      return response()->json([
        'status'=>true,
        'message'=>'Cart removed successfully'
      ]);
     
    }
}
