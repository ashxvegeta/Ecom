<?php
namespace App\Services;
use App\Models\Product;

class CartService{

   public function add(int  $productId,int $quantity){
        $product = Product::with(['productItems','productImages','brand'])->findOrFail($productId);
        $cart =  session()->get('cart',[]);
        if(isset($cart[$productId])){
           $cart[$productId]['quantity'] += $quantity;
        }else{
            $cart[$productId] = [
            'product_item_id' => $product->productItems->first()->id,
            'brand'      =>$product->brand->name,
            'product_id' => $productId,
            'name'       => $product->name,
            'price'      => $product->productItems->first()->price,
            'quantity'   => $quantity,
            'image'      => $product->productImages->first()?->image_path,
            ];
        }
        session()->put('cart',$cart);
        return true;

    }

    public function removecart(int $productId){
        $cart = session()->get('cart',[]);
        unset($cart[$productId]);
        session()->put('cart',$cart);
        return true;

    }

    public function updateCartQuantity(int $productId,int $quantity){
        
        $cart = session()->get('cart',[]);
        if(!isset($cart[$productId])){
            return false;
        }
        $cart[$productId]['quantity'] = $quantity;
        session()->put('cart',$cart);
        return true;
    }

    public function getCheckoutData(){
       return session()->get('cart',[]);
    }

}