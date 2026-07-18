<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Product\CreateProductAction;
use App\Http\Requests\UpdateProductRequest;
use App\Actions\Product\UpdateProductAction;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private ProductRepositoryInterface $productRepository)
    {
        // Dependency injection of the ProductRepositoryInterface
    }

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
        public function store(StoreProductRequest $request, CreateProductAction $action)
    {

       $action->execute($request->validated(), $request->file('images'), $request->category_ids);

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


$products = Product::with( 
        ['brand',
        'categories',
        'productImages',
        'productItems'])->where('id', $id)->first();

$brands = Brand::all();
$categories = Category::all();


// echo "<pre>";
//     print_r($products->toArray()); // Debugging line to check the price value

 return view('products.edit',compact('products','brands','categories'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, UpdateProductAction $action, string $id)
    {
       



        $product = Product::findOrFail($id);
        

        $action->execute($product, $request->validated(), $request->file('images') ?? [], $request->input('category_ids') ?? []);




        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);
        // database se delete karne se pehle, pehle image paths ko variable mein save karo
        $imagepath =  $product->productImages()->pluck('image_path')->toArray();
        $product->productImages()->delete();
        // ab storage se delete karo
        Storage::disk('public')->delete($imagepath);
        // ab product ko delete karo
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
