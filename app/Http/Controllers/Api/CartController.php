<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Http\Resources\CartResource;
use App\Services\CartService;
use OpenApi\Attributes as OA;

class CartController extends Controller
{
    public function __construct(private CartService $cartService) {}

    #[OA\Get(
        path: '/api/cart',
        summary: 'Get user cart items',
        tags: ['Cart'],
        security: [['sanctum' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Cart items retrieved successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->with(['product.productImages', 'product.brand', 'productItem'])
            ->get();

        return response()->json([
            'status' => true,
            'data'   => CartResource::collection($cart)
        ]);
    }

    #[OA\Post(
        path: '/api/cart/sync',
        summary: 'Sync cart items from local to database',
        tags: ['Cart'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'cart',
                        type: 'array',
                        items: new OA\Items(
                            properties: [
                                new OA\Property(property: 'product_id', type: 'integer', example: 1),
                                new OA\Property(property: 'product_item_id', type: 'integer', example: 1),
                                new OA\Property(property: 'quantity', type: 'integer', example: 2),
                                new OA\Property(property: 'price', type: 'number', example: 49999.00)
                            ]
                        )
                    )
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Cart synced successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function sync(Request $request)
    {
        $cartItems = $request->cart ?? [];
        foreach ($cartItems as $item) {
            Cart::updateOrCreate(
                [
                    'user_id'         => auth()->id(),
                    'product_id'      => $item['product_id'],
                    'product_item_id' => $item['product_item_id'],
                ],
                [
                    'quantity' => $item['quantity'],
                    'price'    => $item['price'],
                ]
            );
        }
        return response()->json([
            'status'  => true,
            'message' => 'Cart synced successfully'
        ]);
    }

    #[OA\Post(
        path: '/api/cart/remove/{id}',
        summary: 'Remove an item from cart',
        tags: ['Cart'],
        security: [['sanctum' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Cart item ID to remove', schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Item removed from cart'),
            new OA\Response(response: 404, description: 'Item not found in cart'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function removeFromCart(int $id)
    {
        $removed = $this->cartService->removecart($id);
        if (!$removed) {
            return response()->json([
                'status'  => false,
                'message' => 'Item not found'
            ], 404);
        }
        return response()->json([
            'status'  => true,
            'message' => 'Cart removed successfully'
        ]);
    }
}
