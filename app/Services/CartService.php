<?php
namespace App\Services;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Collection;

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
        if(auth()->check()) {
            $deleted =  Cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->delete();
            return  $deleted >0 ;
        }else{
            $cart = session()->get('cart',[]);
            unset($cart[$productId]);
            session()->put('cart',$cart);
            return true;
        }
    }

    public function updateCartQuantity(int $productId,int $quantity){
        
     if(auth()->check()) {
        Cart::where('user_id', auth()->id())
        ->where('product_id', $productId)
         ->update(['quantity' => $quantity]);
     }else{
        $cart = session()->get('cart',[]);
        if(!isset($cart[$productId])){
            return false;
        }
        $cart[$productId]['quantity'] = $quantity;
        session()->put('cart',$cart);
     }
        return true;
    }

   public function getCheckoutData(): array
{
    if(auth()->check()) {
       $cart = Cart::where('user_id', auth()->id())
            ->with(['product.productImages', 'product.brand', 'productItem'])
            ->get();

     
        return $cart->map(function($item) {
            return [
                'product_id'      => $item->product_id,
                'product_item_id' => $item->product_item_id,
                'name'            => $item->product->name,
                'price'           => $item->price,
                'quantity'        => $item->quantity,
                'image' => optional($item->product->productImages->first())->image_path ?? '',
                'brand'           => $item->product->brand->name ?? '',
            ];
        })->toArray();
    }
    
    return session()->get('cart', []);
}
    public function getCart(): Collection
    {
        if(auth()->check()){
           return  Cart::where('user_id', auth()->id())->with(['product', 'productItem'])->get()
             ->map(function($item) {
                return [
                    'product_id'      => $item->product_id,
                    'product_item_id' => $item->product_item_id,
                    'name'            => $item->product->name,
                    'price'           => $item->price,
                    'quantity'        => $item->quantity,
                ];
            });
        }

       return collect(session()->get('cart', []));
    }

        public function subtotal(): float
    {
        $cart = $this->getCheckoutData();


        return collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

        public function clearCart()
    {
        session()->forget('cart');
    }

 public function syncSessionCartToDb(): void
{
    $sessionCart = session()->get('cart', []);
    
    foreach($sessionCart as $productId => $item) {
        Cart::updateOrCreate(
            [
                'user_id'    => auth()->id(),
                'product_id' => $productId,
            ],
            [
                'product_item_id' => $item['product_item_id'],
                'quantity'        => $item['quantity'],
                'price'           => $item['price'],
            ]
        );
    }
    
    session()->forget('cart');
}

}