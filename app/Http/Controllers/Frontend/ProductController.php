<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use  App\Models\Category;
use  App\Models\Brand;
use  App\Models\ProductItem;
use  App\Http\Requests\ProductFilterRequest;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    //

    public function __construct(
            private ProductRepositoryInterface $repository
    ) {}

    public function index(ProductFilterRequest $request){
        $filters = $request->only(['search', 'category_id', 'brand_id', 'max_price', 'sort']);
        $products = $this->repository->getFilteredProducts($filters);
        $categories = Cache::remember('categories.active',3600,function(){
           return Category::where('status', 1)->get();
        });
        $brands = Cache::remember('brands.active',3600,function(){
           return Brand::where('status', 1)->get();
        });
        return view('frontend.products.index', compact('products','categories','brands'));
    }
    

    public function show(string $slug){
        $product = $this->repository->getProductBySlug($slug);
        $related_products = $this->repository->getRelatedProducts($product);
        return view('frontend.products.show',compact('product','related_products'));
    }

}
