<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    //

     public function __construct(
        private CartService $cartService
    ) {}



    public function index(){

    if(auth()->check()) {
        $cartcollection = Cart::where('user_id', auth()->id())
            ->with(['product.productImages', 'product.brand', 'productItem'])
            ->get();
        
        $cart = [];
        foreach($cartcollection as $item){
            $cart[$item->product_id] = [
            'product_item_id' => $item->product_item_id,
            'product_id'      => $item->product_id,
            'name'            => $item->product->name,
            'price'           => $item->price,
            'quantity'        => $item->quantity,
            'brand'           => $item->product->brand->name ?? '',
            'image'           => $item->product->productImages->first()->image_path ?? '',
            ];
        }
    } else {
        $cart = session()->get('cart', []);

    }
        return view('frontend.cart.index',compact('cart'));
    }

    public function addToCart(Request $request){
        $this->cartService->add($request->product_id,$request->quantity ?? 1); 
        return redirect()->back()->with('success','Product added to cart!');
    }

    public function removeFromCart(int $id){
      $this->cartService->removecart($id);
      return redirect()->back()->with('success','Product remove from cart');
     
    }

    public function updateQuantity(Request $request){
        $product_id = $request->product_id;
        $product_quantity = $request->quantity;
        $this->cartService->updateCartQuantity($product_id,$product_quantity);
        return redirect()->back();


    }
}
