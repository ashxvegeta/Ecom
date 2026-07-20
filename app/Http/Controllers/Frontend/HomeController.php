<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    //get home page
    public function index(){
        $categories  = Category::whereNull('parent_id')->where('status',1)->get();
        $featured_products = Product::with(['brand', 'productItems', 'productImages'])->where('featured',1)->where('status',1)->latest()->take(8)->get();
        return view('frontend.home.index', compact('categories', 'featured_products'));

    }
}
