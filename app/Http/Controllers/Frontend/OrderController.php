<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Enums\OrderStatus;
use App\Models\ProductItem;

class OrderController extends Controller
{
    //

     public function orderSuccess($id)
    {
        $order = auth()->user()->orders()->with('items')->findOrFail($id);
        return view('frontend.orders.success', compact('order'));
    }

    public function orderIndex()
    {
        $orders = auth()->user()->orders()->with('items.product.productImages')->get();
        return view('frontend.orders.index', compact('orders'));
    }

    public function orderShow($id)
    {
        $order = auth()->user()->orders()->with([
            'items.product.productImages',
            'items.product.brand',
        ])->findOrFail($id);
        return view('frontend.orders.show', compact('order'));
    }

    public function cancelOrder($id)
    {
        $order = auth()->user()->orders()->findOrFail($id);
            // Prevent cancelling if already cancelled (avoids adding stock twice)
    if ($order->order_status === OrderStatus::CANCELLED) {
        return redirect()->back()->with('error', 'This order is already cancelled.');
    }
        $order->order_status = OrderStatus::CANCELLED;
        $order->save();
        $orderItems = $order->items()->get();
        // 2. Restore stock for each item
        foreach ($order->items as $orderItem) {
            if ($orderItem->product_item_id) {
                ProductItem::where('id', $orderItem->product_item_id)->increment('stock', $orderItem->quantity);
            }
        }
        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }

}
