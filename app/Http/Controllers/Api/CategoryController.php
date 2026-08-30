<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    //get categories list
    public function index(){
       $categories = Cache::remember('categories.active',3600,function(){
           return Category::where('status', 1)->get();
        }); 
        if($categories->isEmpty()){
            return response()->json([
                'success' => false,
                'message'    => 'No categories found',
            ],404);
        }
        return response()->json([
            'success' => true,
            'data'    => $categories,
        ]);
    }

}
