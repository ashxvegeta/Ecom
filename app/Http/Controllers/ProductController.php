<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with( 
        ['brand',
        'categories',
        'productImages',
        'productItems'])->get();
        


        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
          $brands = Brand::all();
          $categories=Category::all();
          return view('products.create',compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(StoreProductRequest $request)
    {

        DB::transaction(function() use ($request) {
           
            $slug = Str::slug($request->name);

            if (Product::where('slug', $slug)->exists()) {
                $slug = $slug . '-' . time();
            }

            $product = Product::create([
                'name' => $request->name,
                'slug' => $slug,
                'brand_id' => $request->brand_id,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'status' => $request->status,
                'featured' => $request->featured ?? 0,
            ]);

            // Product Item
            $product->productItems()->create([
                'sku' => $request->sku,
                'price' => $request->price,
                'stock' => $request->stock,
                'status' => 1,
            ]);

            // Categories
            if($request->category_ids) {
            
                $product->categories()->attach($request->category_ids);
            }

            // Product Images
            if($request->hasFile('images')){
          
                foreach($request->file('images') as $index => $image){
                    $path = $image->store('products', 'public');
                    $product->productImages()->create([
                        'image_path' => $path,
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        });

        return redirect()->route('products.index')->with('success', 'Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
