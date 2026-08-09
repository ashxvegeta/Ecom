<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    //get home page
    public function index(){
        $categories  = 
        Cache::remember('categories.listing', 3600, function() {
            return Category::whereNull('parent_id')->where('status',1)->get();
        });
        $featured_products = Cache::remember('products.featured', 3600, function() {
            return Product::with(['brand', 'productItems', 'productImages'])->where('featured',1)->where('status',1)->latest()->take(8)->get();
        });
        return view('frontend.home.index', compact('categories', 'featured_products'));

    }
}
