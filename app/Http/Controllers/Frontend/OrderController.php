<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

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

}
