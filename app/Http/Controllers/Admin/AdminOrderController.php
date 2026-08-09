<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::with(['user','items'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user','items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
}
