<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Actions\Order\PlaceOrderAction;
use App\Http\Requests\PlaceOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderitemResource;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class OrderController extends Controller
{
    #[OA\Post(
        path: '/api/orders',
        summary: 'Place a new order',
        tags: ['Orders'],
        security: [['sanctum' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'first_name', type: 'string', example: 'John'),
                    new OA\Property(property: 'last_name', type: 'string', example: 'Doe'),
                    new OA\Property(property: 'email', type: 'string', example: 'john@example.com'),
                    new OA\Property(property: 'phone', type: 'string', example: '9876543210'),
                    new OA\Property(property: 'address', type: 'string', example: '123 Tech Street, Silicon Valley'),
                    new OA\Property(property: 'city', type: 'string', example: 'Mumbai'),
                    new OA\Property(property: 'state', type: 'string', example: 'Maharashtra'),
                    new OA\Property(property: 'pincode', type: 'string', example: '400001'),
                    new OA\Property(property: 'payment_method', type: 'string', enum: ['cod', 'razorpay'], example: 'cod'),
                    new OA\Property(property: 'shipping_charge', type: 'number', example: 50.00)
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Order placed successfully'),
            new OA\Response(response: 422, description: 'Validation errors'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function placeOrder(PlaceOrderRequest $request, PlaceOrderAction $action)
    {
        try {
            $order = $action->execute($request->validated());
            return response()->json([
                'status'  => true,
                'message' => 'Order placed successfully',
                'data'    => [
                    'order_id'     => $order->id,
                    'order_number' => $order->order_number,
                    'grand_total'  => $order->grand_total,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    #[OA\Get(
        path: '/api/orderslist',
        summary: 'Get logged-in user order history',
        tags: ['Orders'],
        security: [['sanctum' => []]],
        responses: [
            new OA\Response(response: 200, description: 'List of user orders'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function orderList()
    {
        $orders = auth()->user()->orders()->with('items.product.productImages', 'items.product.brand')->get();
        return response()->json([
            'status' => true,
            'data'   => OrderResource::collection($orders)
        ]);
    }

    #[OA\Get(
        path: '/api/ordersdetails/{id}',
        summary: 'Get order details by order ID',
        tags: ['Orders'],
        security: [['sanctum' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, description: 'Order ID', schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Order details found'),
            new OA\Response(response: 404, description: 'Order not found'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function orderDetails($id)
    {
        $order = auth()->user()->orders()->with([
            'items.product.productImages',
            'items.product.brand',
        ])->findOrFail($id);
        return response()->json([
            'status' => true,
            'data'   => new OrderResource($order)
        ]);
    }
}
