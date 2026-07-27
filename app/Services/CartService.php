<?php
namespace App\Services;
use App\Models\Product;

class CartService{

   public function add(int  $productId,int $quantity){
        $product  = Product::with(['productItems','productImages'])->findOrFail($productId);
        $cart =  session()->get('cart',[]);
        if(isset($cart[$productId])){
           $cart[$productId]['quantity'] += $quantity;
        }else{
            $cart[$productId] = [
            'product_item_id' => $product->productItems->first()->id,
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

}