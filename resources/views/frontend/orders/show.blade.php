@extends('layouts.frontend')

@section('title', 'Order Details - TechZone')

@section('content')

{{-- Page Header --}}
<section style="background: #f5f5f7; padding: 30px 0;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="font-weight-bold mb-1" style="color: #1d1d1f; font-size: 32px;">Order #TZ-001</h2>
                <p class="mb-0" style="color: #86868b;">Placed on 15 July 2024</p>
            </div>
            <span class="badge badge-warning" style="border-radius: 20px; padding: 8px 16px; font-size: 14px;">Pending</span>
        </div>
    </div>
</section>

{{-- Order Detail Section --}}
<section style="padding: 40px 0; background: #ffffff;">
    <div class="container">
        <div class="row">

            {{-- Left --}}
            <div class="col-md-8 mb-4">

                {{-- Order Tracking --}}
                <div class="p-4 shadow-sm mb-4" style="border-radius: 16px; border: 1px solid #e5e5e5;">
                    <h5 class="font-weight-bold mb-4" style="color: #1d1d1f;">Order Tracking</h5>
                    <div class="d-flex justify-content-between align-items-center">

                        {{-- Step 1 --}}
                        <div class="text-center">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #1d1d1f; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 16px;">✓</div>
                            <p class="mt-2 mb-0" style="font-size: 12px; color: #1d1d1f; font-weight: 600;">Order Placed</p>
                            <p style="font-size: 11px; color: #86868b;">15 Jul 2024</p>
                        </div>

                        <div style="flex: 1; height: 2px; background: #1d1d1f; margin: 0 10px; margin-bottom: 30px;"></div>

                        {{-- Step 2 --}}
                        <div class="text-center">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #1d1d1f; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 16px;">✓</div>
                            <p class="mt-2 mb-0" style="font-size: 12px; color: #1d1d1f; font-weight: 600;">Confirmed</p>
                            <p style="font-size: 11px; color: #86868b;">15 Jul 2024</p>
                        </div>

                        <div style="flex: 1; height: 2px; background: #e5e5e5; margin: 0 10px; margin-bottom: 30px;"></div>

                        {{-- Step 3 --}}
                        <div class="text-center">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #e5e5e5; color: #86868b; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 16px;">📦</div>
                            <p class="mt-2 mb-0" style="font-size: 12px; color: #86868b; font-weight: 600;">Shipped</p>
                            <p style="font-size: 11px; color: #86868b;">Pending</p>
                        </div>

                        <div style="flex: 1; height: 2px; background: #e5e5e5; margin: 0 10px; margin-bottom: 30px;"></div>

                        {{-- Step 4 --}}
                        <div class="text-center">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #e5e5e5; color: #86868b; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 16px;">🏠</div>
                            <p class="mt-2 mb-0" style="font-size: 12px; color: #86868b; font-weight: 600;">Delivered</p>
                            <p style="font-size: 11px; color: #86868b;">Pending</p>
                        </div>

                    </div>
                </div>

                {{-- Order Items --}}
                <div class="p-4 shadow-sm mb-4" style="border-radius: 16px; border: 1px solid #e5e5e5;">
                    <h5 class="font-weight-bold mb-4" style="color: #1d1d1f;">Order Items</h5>

                    <div class="d-flex align-items-center mb-3">
                        <div style="background: #f5f5f7; border-radius: 10px; padding: 12px; min-width: 80px; text-align: center;">
                            <img src="https://via.placeholder.com/60x50/f5f5f7/1d1d1f?text=P" class="img-fluid">
                        </div>
                        <div class="ml-3 flex-grow-1">
                            <p style="color: #86868b; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Apple</p>
                            <h6 class="font-weight-bold mb-1" style="color: #1d1d1f;">iPhone 16 Pro</h6>
                            <p class="mb-0" style="color: #86868b; font-size: 13px;">SKU: IPH-16-PRO-BLK · Qty: 1</p>
                        </div>
                        <span class="font-weight-bold" style="color: #1d1d1f; font-size: 16px;">₹1,29,999</span>
                    </div>

                </div>

                {{-- Shipping Address --}}
                <div class="p-4 shadow-sm" style="border-radius: 16px; border: 1px solid #e5e5e5;">
                    <h5 class="font-weight-bold mb-3" style="color: #1d1d1f;">Shipping Address</h5>
                    <p class="mb-1 font-weight-bold" style="color: #1d1d1f;">John Doe</p>
                    <p class="mb-1" style="color: #86868b; font-size: 14px;">123, ABC Street, Andheri West</p>
                    <p class="mb-1" style="color: #86868b; font-size: 14px;">Mumbai, Maharashtra - 400001</p>
                    <p class="mb-0" style="color: #86868b; font-size: 14px;">📞 +91 98765 43210</p>
                </div>

            </div>

            {{-- Right — Payment Summary --}}
            <div class="col-md-4">
                <div class="p-4 shadow-sm" style="border-radius: 16px; background: #f5f5f7; position: sticky; top: 20px;">
                    <h5 class="font-weight-bold mb-4" style="color: #1d1d1f;">Payment Summary</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span style="color: #86868b; font-size: 14px;">Subtotal</span>
                        <span style="color: #1d1d1f; font-weight: 500;">₹1,29,999</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span style="color: #86868b; font-size: 14px;">Delivery</span>
                        <span style="color: #34c759; font-weight: 500; font-size: 14px;">FREE</span>
                    </div>

                    <hr style="border-color: #e5e5e5;">

                    <div class="d-flex justify-content-between mb-4">
                        <span style="color: #1d1d1f; font-weight: 700; font-size: 16px;">Total</span>
                        <span style="color: #1d1d1f; font-weight: 700; font-size: 20px;">₹1,29,999</span>
                    </div>

                    <div class="p-3 mb-3" style="background: #ffffff; border-radius: 12px;">
                        <p class="mb-1" style="color: #86868b; font-size: 12px;">Payment Method</p>
                        <p class="mb-0 font-weight-bold" style="color: #1d1d1f; font-size: 14px;">💵 Cash on Delivery</p>
                    </div>

                    <div class="p-3" style="background: #ffffff; border-radius: 12px;">
                        <p class="mb-1" style="color: #86868b; font-size: 12px;">Payment Status</p>
                        <span class="badge badge-warning" style="border-radius: 20px; padding: 5px 10px;">Pending</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection