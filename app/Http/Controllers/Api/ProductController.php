<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductRepositoryInterface;
class ProductController extends Controller
{
    //

    public function __construct( private ProductRepositoryInterface $repository
    ) {}
    
    public function index(Request $request){
        $filters = $request->only(['search', 'category_id', 'brand_id', 'max_price', 'sort']);
        $products = $this->repository->getFilteredProducts($filters);
        return response()->json([
            'success' => true,
            'data'    => $products,
        ]);
    }

    public function show(string $slug){
        $product = $this->repository->getProductBySlug($slug);
        if(!$product){
            return response()->json([
                'success' => false,
                'message'    => 'Product not found',
            ],404);
        }   
         // Related products bhi lo
         $relatedProducts = $this->repository->getRelatedProducts($product);

        if($relatedProducts->isEmpty()){
            $relatedProducts = null;
        }
        return response()->json([
            'success' => true,
            'data'    => $product,
            'related' => $relatedProducts,
        ]);
    }
}
