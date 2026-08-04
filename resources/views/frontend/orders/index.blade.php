@extends('layouts.frontend')

@section('title', 'My Orders - TechZone')

@section('content')

{{-- Page Header --}}
<section style="background: #f5f5f7; padding: 30px 0;">
    <div class="container">
        <h2 class="font-weight-bold" style="color: #1d1d1f; font-size: 32px;">My Orders</h2>
        <p style="color: #86868b;">Track and manage your orders</p>
    </div>
</section>

{{-- Orders Section --}}
<section style="padding: 40px 0; background: #ffffff;">
    <div class="container">


    <!-- @php
echo "<pre>";
print_r($orders->toArray()); // Debugging line to check the orders data
    @endphp -->


        @foreach($orders as $order)
        <div class="p-4 mb-4 shadow-sm" style="border-radius: 16px; border: 1px solid #e5e5e5;">

            {{-- Order Header --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="font-weight-bold mb-1" style="color: #1d1d1f;">Order #TZ-00{{ $order->id }}</h6>
                    <p class="mb-0" style="color: #86868b; font-size: 13px;">Placed on {{ $order->created_at->format('d M Y') }}</p>
                </div>
                <div class="text-right">
                @php
                    $status = $order->order_status->value;

                    if ($status === 'pending') {
                        $badge = 'badge badge-warning';
                    } elseif ($status === 'shipped') {
                        $badge = 'badge badge-info';
                    } elseif ($status === 'delivered') {
                        $badge = 'badge badge-success';
                    } else {
                        $badge = 'badge badge-secondary';
                    }
                @endphp

                <span class="{{ $badge }}" style="border-radius: 20px; padding: 6px 12px; font-size: 12px;">
                    {{ ucfirst($status) }}
                </span>
</div>
            </div>

            <hr style="border-color: #e5e5e5;">

            {{-- Order Items --}}
            <div class="d-flex align-items-center mb-3">
                <div style="background: #f5f5f7; border-radius: 10px; padding: 10px; min-width: 70px; text-align: center;">
                    <img height="80px" width="70px" src="{{asset('storage/' . ($order->items->first()->product->productImages->first()->image_path ?? 'https://via.placeholder.com/55x45/f5f5f7/1d1d1f?text=P')) }}" class="img-fluid">
                </div>
                <div class="ml-3 flex-grow-1">
                    <h6 class="font-weight-bold mb-1" style="color: #1d1d1f; font-size: 15px;">{{ $order->items->first()->product_name ?? 'Product Name' }}</h6>
                    <p class="mb-0" style="color: #86868b; font-size: 13px;">Apple · Qty: {{ $order->items->first()->quantity ?? 1 }}</p>
                </div>
                <span class="font-weight-bold" style="color: #1d1d1f; font-size: 15px;">₹{{ number_format($order->items->first()->total ?? 0, 2) }}</span>
            </div>

            <hr style="border-color: #e5e5e5;">

            {{-- Order Footer --}}
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span style="color: #86868b; font-size: 13px;">Total: </span>
                    <span class="font-weight-bold" style="color: #1d1d1f; font-size: 16px;">₹{{ number_format($order->grand_total, 2) }}</span>
                    <span class="ml-2" style="color: #86868b; font-size: 13px;">· {{ $order->payment_method->label() }}</span>
                </div>
                <a href="/orders/{{ $order->id }}" class="btn btn-outline-dark btn-sm" style="border-radius: 20px; font-size: 13px; padding: 6px 16px;">
                    View Details
                </a>
            </div>

        </div>
        @endforeach

    </div>
</section>

@endsection