@extends('layouts.frontend')

@section('title', 'Cart - TechZone')

@section('content')

{{-- Page Header --}}
<section style="background: #f5f5f7; padding: 30px 0;">
    <div class="container">
        <h2 class="font-weight-bold" style="color: #1d1d1f; font-size: 32px;">Your Cart</h2>
        <p style="color: #86868b;">3 items in your cart</p>
    </div>
</section>

{{-- Cart Section --}}
<section style="padding: 40px 0; background: #ffffff;">
    <div class="container">
        <div class="row">

            {{-- Left — Cart Items --}}
            <div class="col-md-8 mb-4">

                {{-- Cart Item 1 --}}
                @for($i = 1; $i <= 3; $i++)
                <div class="d-flex align-items-center p-4 mb-3 bg-white shadow-sm" style="border-radius: 16px;">

                    {{-- Product Image --}}
                    <div style="background: #f5f5f7; border-radius: 12px; padding: 15px; min-width: 100px; text-align: center;">
                        <img src="https://via.placeholder.com/80x70/f5f5f7/1d1d1f?text=Product"
                             class="img-fluid">
                    </div>

                    {{-- Product Info --}}
                    <div class="ml-4 flex-grow-1">
                        <p style="color: #86868b; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Apple</p>
                        <h6 class="font-weight-bold" style="color: #1d1d1f; font-size: 16px;">iPhone 16 Pro</h6>
                        <p style="color: #86868b; font-size: 13px; margin-bottom: 0;">SKU: IPH-16-PRO-BLK</p>
                    </div>

                    {{-- Quantity --}}
                    <div class="d-flex align-items-center mx-4">
                        <button class="btn btn-outline-dark btn-sm" style="border-radius: 50%; width: 30px; height: 30px; padding: 0;">−</button>
                        <span class="mx-3 font-weight-bold">1</span>
                        <button class="btn btn-outline-dark btn-sm" style="border-radius: 50%; width: 30px; height: 30px; padding: 0;">+</button>
                    </div>

                    {{-- Price --}}
                    <div class="text-right" style="min-width: 100px;">
                        <p class="font-weight-bold mb-1" style="color: #1d1d1f; font-size: 16px;">₹1,29,999</p>
                        <a href="#" style="color: #ff3b30; font-size: 13px; text-decoration: none;">
                            <i class="bi bi-trash"></i> Remove
                        </a>
                    </div>

                </div>
                @endfor

                {{-- Continue Shopping --}}
                <div class="mt-3">
                    <a href="/products" style="color: #1d1d1f; font-size: 14px; text-decoration: none;">
                        ← Continue Shopping
                    </a>
                </div>

            </div>

            {{-- Right — Order Summary --}}
            <div class="col-md-4">
                <div class="p-4 shadow-sm" style="border-radius: 16px; background: #f5f5f7; position: sticky; top: 20px;">
                    <h5 class="font-weight-bold mb-4" style="color: #1d1d1f;">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-3">
                        <span style="color: #86868b; font-size: 14px;">Subtotal (3 items)</span>
                        <span style="color: #1d1d1f; font-weight: 500;">₹3,89,997</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span style="color: #86868b; font-size: 14px;">Delivery</span>
                        <span style="color: #34c759; font-weight: 500; font-size: 14px;">FREE</span>
                    </div>

                    <hr style="border-color: #e5e5e5;">

                    <div class="d-flex justify-content-between mb-4">
                        <span style="color: #1d1d1f; font-weight: 700; font-size: 16px;">Total</span>
                        <span style="color: #1d1d1f; font-weight: 700; font-size: 18px;">₹3,89,997</span>
                    </div>

                    <a href="/checkout" class="btn btn-dark btn-block btn-lg" style="border-radius: 25px; font-size: 15px; padding: 14px;">
                        Proceed to Checkout
                    </a>

                    <div class="text-center mt-3">
                        <small style="color: #86868b;">
                            🔒 Secure checkout
                        </small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection