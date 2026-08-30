<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
    //get brands list
    public function index(){
        $brands = Cache::remember('brands.active',3600,function(){
           return Brand::where('status', 1)->get();
        });
        if($brands->isEmpty()){
            return response()->json([
                'success' => false,
                'message'    => 'No brands found',
            ],404);
        }
        return response()->json([
            'success' => true,
            'data'    => $brands,
        ]);
    }
}
