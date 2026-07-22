<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index(){
       $products = Product::with(['brand', 'productItems', 'productImages'])->where('featured',1)->where('status',1)->paginate(5);
        return view('frontend.products.index', compact('products'));
    }

}
