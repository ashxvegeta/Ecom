@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="font-weight-bold mb-0" style="color: #1d1d1f;">All Orders</h5>
            <span style="color: #86868b; font-size: 14px;">Total:  orders</span>
        </div>

        <table class="table">
            <thead>
                <tr style="color: #86868b; font-size: 13px;">
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Products</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr style="font-size: 14px;">
                    <td>{{ $order->order_number }}</td>
                    <td>
                        <p class="mb-0 font-weight-bold">{{ $order->first_name }} {{ $order->last_name }}</p>
                        <small style="color: #86868b;">{{ $order->email }}</small>
                    </td>
                    <td>
                        @foreach($order->items as $item)
                            <small>{{ $item->product_name }} x{{ $item->quantity }}</small><br>
                        @endforeach
                    </td>
                    <td class="font-weight-bold">{{ formatPrice($order->grand_total) }}</td>
                    <td>
                        <span class="badge badge-secondary" style="border-radius: 20px;">
                            {{ strtoupper($order->payment_method->label()) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-{{ $order->order_status->color() }}"
                              style="border-radius: 20px; padding: 5px 10px;">
                            {{ $order->order_status->label() }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" 
                           class="btn btn-sm btn-dark" style="border-radius: 8px;">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
                @if($orders->isEmpty())
                <tr>
                    <td colspan="8" class="text-center" style="color: #86868b;">No orders found</td>
                </tr>
                @endif
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links('vendor.pagination.bootstrap-4') }}
        </div>

    </div>
</div>

@endsection