@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="row">

    {{-- Total Orders --}}
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p style="color: #86868b; font-size: 13px; margin-bottom: 5px;">Total Orders</p>
                        <h3 class="font-weight-bold" style="color: #1d1d1f;">{{ $totalOrders }}</h3>
                    </div>
                    <div style="background: #f5f5f7; border-radius: 12px; padding: 12px;">
                        <i class="bi bi-bag-check" style="font-size: 24px; color: #1d1d1f;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Revenue --}}
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p style="color: #86868b; font-size: 13px; margin-bottom: 5px;">Total Revenue</p>
                        <h3 class="font-weight-bold" style="color: #1d1d1f;">{{ formatPrice($totalRevenue) }}</h3>
                    </div>
                    <div style="background: #f5f5f7; border-radius: 12px; padding: 12px;">
                        <i class="bi bi-currency-rupee" style="font-size: 24px; color: #1d1d1f;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Products --}}
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p style="color: #86868b; font-size: 13px; margin-bottom: 5px;">Total Products</p>
                        <h3 class="font-weight-bold" style="color: #1d1d1f;">{{ $totalProducts }}</h3>
                    </div>
                    <div style="background: #f5f5f7; border-radius: 12px; padding: 12px;">
                        <i class="bi bi-box" style="font-size: 24px; color: #1d1d1f;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Customers --}}
    <div class="col-md-3 mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p style="color: #86868b; font-size: 13px; margin-bottom: 5px;">Total Customers</p>
                        <h3 class="font-weight-bold" style="color: #1d1d1f;">{{ $totalCustomers }}</h3>
                    </div>
                    <div style="background: #f5f5f7; border-radius: 12px; padding: 12px;">
                        <i class="bi bi-people" style="font-size: 24px; color: #1d1d1f;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Recent Orders --}}
<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-body p-4">
        <h5 class="font-weight-bold mb-4" style="color: #1d1d1f;">Recent Orders</h5>
        <table class="table">
            <thead>
                <tr style="color: #86868b; font-size: 13px;">
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr style="font-size: 14px;">
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                    <td>{{ formatPrice($order->grand_total) }}</td>
                    <td>
                        <span class="badge badge-{{ $order->order_status == 'pending' ? 'warning' : ($order->order_status == 'delivered' ? 'success' : 'info') }}"
                              style="border-radius: 20px; padding: 5px 10px;">
                            {{ ucfirst($order->order_status->value) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="/admin/orders/{{ $order->id }}" class="btn btn-sm btn-outline-dark" style="border-radius: 8px;">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection