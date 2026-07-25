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

class ProductController extends Controller
{
    //

    public function __construct(
            private ProductRepositoryInterface $repository
    ) {}

    public function index(ProductFilterRequest $request){

        $filters = $request->only(['search', 'category_id', 'brand_id', 'max_price', 'sort']);
        
        $products = $this->repository->getFilteredProducts($filters);
        
        $categories = Category::where('status', 1)->get();
        $brands     = Brand::where('status', 1)->get();
        return view('frontend.products.index', compact('products','categories','brands'));
    }

}
