<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use OpenApi\Attributes as OA;

class CategoryController extends Controller
{
    #[OA\Get(
        path: '/api/categories',
        summary: 'Get all active categories',
        tags: ['Categories'],
        responses: [
            new OA\Response(response: 200, description: 'Success'),
            new OA\Response(response: 404, description: 'No categories found')
        ]
    )]
    public function index()
    {
        $categories = Cache::remember('categories.active', 3600, function () {
            return Category::where('status', 1)->get();
        });

        if ($categories->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No categories found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $categories,
        ]);
    }
}
