<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Cache;
use OpenApi\Attributes as OA;

class BrandController extends Controller
{
    #[OA\Get(
        path: '/api/brands',
        summary: 'Get all active brands',
        tags: ['Brands'],
        responses: [
            new OA\Response(response: 200, description: 'List of brands'),
            new OA\Response(response: 404, description: 'No brands found')
        ]
    )]
    public function index()
    {
        $brands = Cache::remember('brands.active', 3600, function () {
            return Brand::where('status', 1)->get();
        });

        if ($brands->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No brands found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $brands,
        ]);
    }
}
