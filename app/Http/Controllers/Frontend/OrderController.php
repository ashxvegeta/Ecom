<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Enums\OrderStatus;
use App\Models\ProductItem;
use Illuminate\Support\Facades\DB;
use App\Notifications\OrderCancelledNotification;


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
    return DB::transaction(function () use ($id) {
        // 1. Lock the order row for update and load items
        $order = auth()->user()->orders()
            ->where('id', $id)
            ->with('items')
            ->lockForUpdate()
            ->firstOrFail();

        // 2. Prevent duplicate cancellation
        if ($order->order_status === OrderStatus::CANCELLED) {
            return redirect()->back()->with('error', 'This order is already cancelled.');
        }

        // 3. Prevent cancelling delivered orders
        if ($order->order_status === OrderStatus::DELIVERED) {
            return redirect()->back()->with('error', 'Delivered orders cannot be cancelled.');
        }

        // 4. Update status
        $order->order_status = OrderStatus::CANCELLED;
        $order->save();

        $order->user->notify(new OrderCancelledNotification($order));

        // 5. Restore stock for each item
        foreach ($order->items as $orderItem) {
            if ($orderItem->product_item_id) {
                ProductItem::where('id', $orderItem->product_item_id)
                    ->increment('stock', $orderItem->quantity);
            }
        }

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    });
}


}
