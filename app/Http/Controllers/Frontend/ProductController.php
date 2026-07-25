<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use  App\Models\Category;
use  App\Models\Brand;
use  App\Models\ProductItem;
use  App\Http\Requests\ProductFilterRequest;

class ProductController extends Controller
{
    //
    public function index(ProductFilterRequest $request){
   
        $search      = $request->input('search');
        $categoryIds = $request->input('category_id', []);
        $brandIds    = $request->input('brand_id', []);
        $sort        = $request->input('sort');
        $maxprice    = $request->input('max_price');
        

        $query = Product::with(['brand', 'productItems', 'productImages'])->where('status', 1);

        if ($search != '') {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($maxprice != '') {
            $query->whereHas('productItems',function($q) use ($maxprice){
               $q->where('price', '<=',$maxprice);
            });
        }

        if (!empty($categoryIds)) {
            $query->whereHas('categories', function($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            });
        }

        if (!empty($brandIds)) {
            $query->whereIn('brand_id', $brandIds);
        }

        if($sort!=''){
            if($sort == 'price_asc'){
               $query->orderBy(ProductItem::select('price')->whereColumn('product_id','products.id')->orderBy('price', 'asc')->limit(1),'asc');
            }elseif($sort == 'price_desc'){
                  $query->orderBy(ProductItem::select('price')->whereColumn('product_id','products.id')->orderBy('price', 'desc')->limit(1),'desc');
            }else{
                $query->latest();
            }
        }

        $products   = $query->paginate(5);
        $categories = Category::where('status', 1)->get();
        $brands     = Brand::where('status', 1)->get();
        return view('frontend.products.index', compact('products','categories','brands'));
    }

}
