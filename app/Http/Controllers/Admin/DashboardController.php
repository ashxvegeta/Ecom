<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalOrders    = Order::count();
        $totalRevenue   = Order::sum('grand_total');
        $totalProducts  = Product::count();
        $totalCustomers = User::where('is_admin', 0)->count();
        $recentOrders   = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue', 
            'totalProducts',
            'totalCustomers',
            'recentOrders'
        ));
    }
}
