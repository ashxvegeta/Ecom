<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Actions\Order\PlaceOrderAction;
use App\Http\Requests\PlaceOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderitemResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
 
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
        
            return response()->json([
                'status'  => false,
                'message' => 'Invalid payment method'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

     public function orderList()
    {
        $orders = auth()->user()->orders()->with('items.product.productImages', 'items.product.brand')->get();
        return response()->json([
            'status' => true,
            'data'   =>  OrderResource::collection($orders)
        ]);
    }

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
