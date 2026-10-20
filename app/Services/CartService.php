<?php
namespace App\Services;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Collection;

class CartService{

   public function add(int  $productId,int $quantity){
        $product = Product::with(['productItems','productImages','brand'])->findOrFail($productId);
        $productItem = $product->productItems->first();
        if($productItem->stock<$quantity){
            return false;
        }

        if(auth()->check()) {
            $cartItem = Cart::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $quantity);
            } else {
                Cart::create([
                    'user_id'         => auth()->id(),
                    'product_id'      => $productId,
                    'product_item_id' => $productItem?->id,
                    'quantity'        => $quantity,
                    'price'           => $productItem?->price ?? 0,
                ]);
            }
            return true;
        }

        $cart =  session()->get('cart',[]);
        if(isset($cart[$productId])){
           $cart[$productId]['quantity'] += $quantity;
        }else{
            $cart[$productId] = [
            'product_item_id' => $productItem?->id,
            'brand'      =>$product->brand->name ?? '',
            'product_id' => $productId,
            'name'       => $product->name,
            'price'      => $productItem?->price ?? 0,
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
   
    if (session()->has('buy_now')) {
        $buyNow = session()->get('buy_now');
        $product = Product::with(['productImages', 'brand', 'productItems'])->find($buyNow['product_id']);
        if ($product && $product->productItems->isNotEmpty()) {
            $item = $product->productItems->first();
            return [
                [
                    'product_id'      => $product->id,
                    'product_item_id' => $item->id,
                    'name'            => $product->name,
                    'price'           => $item->price,
                    'quantity'        => $buyNow['quantity'],
                    'image'           => optional($product->productImages->first())->image_path ?? '',
                    'brand'           => $product->brand->name ?? '',
                ]
            ];
        }
    }


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

    if (session()->has('buy_now')) {
        $buyNow = session()->get('buy_now');
        $product = Product::with(['productItems'])->find($buyNow['product_id']);
        if ($product && $product->productItems->isNotEmpty()) {
            $item = $product->productItems->first();
            return collect([
                [
                    'product_id'      => $product->id,
                    'product_item_id' => $item->id,
                    'name'            => $product->name,
                    'price'           => $item->price,
                    'quantity'        => $buyNow['quantity'],
                ]
            ]);
        }
    }

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

    public function clearCart(?int $userId = null): void
    {
        if (session()->has('buy_now')) {
        session()->forget('buy_now');
        return;
    }
        session()->forget('cart');

        $userId = $userId ?? auth()->id();
        if ($userId) {
            Cart::where('user_id', $userId)->delete();
        }
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