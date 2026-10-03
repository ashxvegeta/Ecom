<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProductRepositoryInterface;
use OpenApi\Attributes as OA;

class ProductController extends Controller
{
    public function __construct(private ProductRepositoryInterface $repository) {}
     
    #[OA\Get(
        path: '/api/products',
        summary: 'Get all products with filters',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(name: 'search', in: 'query', required: false, description: 'Search keyword', schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'category_id', in: 'query', required: false, description: 'Filter by category ID', schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'brand_id', in: 'query', required: false, description: 'Filter by brand ID', schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'max_price', in: 'query', required: false, description: 'Maximum price filter', schema: new OA\Schema(type: 'number')),
            new OA\Parameter(name: 'sort', in: 'query', required: false, description: 'Sort by (e.g. price_asc, price_desc)', schema: new OA\Schema(type: 'string'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'List of filtered products')
        ]
    )]
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category_id', 'brand_id', 'max_price', 'sort']);
        $products = $this->repository->getFilteredProducts($filters);
        return response()->json([
            'success' => true,
            'data'    => $products,
        ]);
    }
    #[OA\Get(
        path: '/api/products/{slug}',
        summary: 'Get single product details by slug',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'slug',
                in: 'path',
                required: true,
                description: 'Unique product slug (e.g. iphone-15-pro)',
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Product details retrieved with related products'),
            new OA\Response(response: 404, description: 'Product not found')
        ]
    )]
    public function show(string $slug)
    {
        $product = $this->repository->getProductBySlug($slug);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        // Related products bhi lo
        $relatedProducts = $this->repository->getRelatedProducts($product);

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = null;
        }

        return response()->json([
            'success' => true,
            'data'    => $product,
            'related' => $relatedProducts,
        ]);
    }
}
