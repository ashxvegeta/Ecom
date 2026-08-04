@extends('layouts.frontend')

@section('title', 'Order Placed - TechZone')

@section('content')

<section style="padding: 80px 0; background: #ffffff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">

                {{-- Success Icon --}}
                <div style="width: 80px; height: 80px; background: #34c759; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 30px;">
                    <i class="bi bi-check-lg" style="color: white; font-size: 40px;"></i>
                </div>

                {{-- Heading --}}
                <h2 class="font-weight-bold mb-3" style="color: #1d1d1f;">Order Placed Successfully!</h2>
                <p style="color: #86868b; font-size: 16px;">Thank you for your order. We'll send you a confirmation email shortly.</p>

                {{-- Order Number --}}
                <div class="p-4 my-4" style="background: #f5f5f7; border-radius: 16px;">
                    <p style="color: #86868b; font-size: 14px; margin-bottom: 5px;">Order Number</p>
                    <h4 class="font-weight-bold" style="color: #1d1d1f;">{{ $order->order_number }}</h4>
                </div>

                {{-- Order Summary --}}
                <div class="p-4 mb-4 text-left" style="background: #f5f5f7; border-radius: 16px;">
                    <h6 class="font-weight-bold mb-3" style="color: #1d1d1f;">Order Summary</h6>

                    @foreach($order->items as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span style="color: #86868b; font-size: 14px;">{{ $item->product_name }} x{{ $item->quantity }}</span>
                        <span style="color: #1d1d1f; font-size: 14px;">{{ formatPrice($item->total) }}</span>
                    </div>
                    @endforeach

                    <hr style="border-color: #e5e5e5;">

                    <div class="d-flex justify-content-between">
                        <span class="font-weight-bold" style="color: #1d1d1f;">Total</span>
                        <span class="font-weight-bold" style="color: #1d1d1f;">{{ formatPrice($order->grand_total) }}</span>
                    </div>
                </div>

                {{-- Shipping Address --}}
                <div class="p-4 mb-4 text-left" style="background: #f5f5f7; border-radius: 16px;">
                    <h6 class="font-weight-bold mb-3" style="color: #1d1d1f;">Shipping Address</h6>
                    <p class="mb-1" style="color: #1d1d1f;">{{ $order->first_name }} {{ $order->last_name }}</p>
                    <p class="mb-1" style="color: #86868b; font-size: 14px;">{{ $order->address }}</p>
                    <p class="mb-1" style="color: #86868b; font-size: 14px;">{{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}</p>
                    <p class="mb-0" style="color: #86868b; font-size: 14px;">📞 {{ $order->phone }}</p>
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('orders.index') }}" class="btn btn-dark" style="border-radius: 25px; padding: 10px 30px;">
                        View My Orders
                    </a>
                    <a href="/" class="btn btn-outline-dark" style="border-radius: 25px; padding: 10px 30px;">
                        Continue Shopping
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection