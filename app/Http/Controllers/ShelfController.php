<?php

namespace App\Http\Controllers;

use App\Models\Shelf;
use App\Models\Product;
use Illuminate\Http\Request;

class ShelfController extends Controller
{


    public function index()
    {
        $products = collect();

        if (auth()->check()) {
            $products = auth()->user()->shelvedProducts()->with('productImages', 'brand', 'productItems')->get();
        }

        return view('frontend.shelf.index', compact('products'));
    }

    // Auth: add to shelf
    public function store(Product $product)
    {
        

        Shelf::firstOrCreate([
            'user_id'    => auth()->id(),
            'product_id' => $product->id,
        ]);

        return response()->json(['message' => 'Added to shelf']);
    }

    // Auth: remove from shelf
    public function destroy(Product $product)
    {
        Shelf::where('user_id', auth()->id())
             ->where('product_id', $product->id)
             ->delete();

        return response()->json(['message' => 'Removed from shelf']);
    }

    // Auth: check karo product shelf mein hai ya nahi
    public function check(Product $product)
    {
        $saved = Shelf::where('user_id', auth()->id())
                      ->where('product_id', $product->id)
                      ->exists();

        return response()->json(['saved' => $saved]);
    }

    // Login ke baad localStorage sync
    public function sync(Request $request)
    {
        $productIds = array_filter($request->input('product_ids', []), 'is_numeric');

        foreach ($productIds as $productId) {
            Shelf::firstOrCreate([
                'user_id'    => auth()->id(),
                'product_id' => (int) $productId,
            ]);
        }

        return response()->json(['message' => 'Synced']);
    }

    // Guest: IDs bhejo, products wapas lo
    public function fetchByIds(Request $request)
    {
        $ids = array_filter((array) $request->input('ids', []), 'is_numeric');

        $products = Product::with('productImages', 'productItems')
            ->whereIn('id', $ids)
            ->get()
            ->map(fn ($p) => [
                'id'    => $p->id,
                'name'  => $p->name,
                'slug'  => $p->slug,
                'image' => optional($p->productImages->first())->image_path,
                'price' => formatPrice(optional($p->productItems->first())->price ?? 0),
            ]);

        return response()->json($products);
    }
}