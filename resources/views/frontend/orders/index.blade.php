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

        @for($i = 1; $i <= 4; $i++)
        <div class="p-4 mb-4 shadow-sm" style="border-radius: 16px; border: 1px solid #e5e5e5;">

            {{-- Order Header --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h6 class="font-weight-bold mb-1" style="color: #1d1d1f;">Order #TZ-00{{ $i }}</h6>
                    <p class="mb-0" style="color: #86868b; font-size: 13px;">Placed on 15 July 2024</p>
                </div>
                <div class="text-right">
                    @if($i == 1)
                        <span class="badge badge-warning" style="border-radius: 20px; padding: 6px 12px; font-size: 12px;">Pending</span>
                    @elseif($i == 2)
                        <span class="badge badge-info" style="border-radius: 20px; padding: 6px 12px; font-size: 12px;">Shipped</span>
                    @elseif($i == 3)
                        <span class="badge badge-success" style="border-radius: 20px; padding: 6px 12px; font-size: 12px;">Delivered</span>
                    @else
                        <span class="badge badge-danger" style="border-radius: 20px; padding: 6px 12px; font-size: 12px;">Cancelled</span>
                    @endif
                </div>
            </div>

            <hr style="border-color: #e5e5e5;">

            {{-- Order Items --}}
            <div class="d-flex align-items-center mb-3">
                <div style="background: #f5f5f7; border-radius: 10px; padding: 10px; min-width: 70px; text-align: center;">
                    <img src="https://via.placeholder.com/55x45/f5f5f7/1d1d1f?text=P" class="img-fluid">
                </div>
                <div class="ml-3 flex-grow-1">
                    <h6 class="font-weight-bold mb-1" style="color: #1d1d1f; font-size: 15px;">iPhone 16 Pro</h6>
                    <p class="mb-0" style="color: #86868b; font-size: 13px;">Apple · Qty: 1</p>
                </div>
                <span class="font-weight-bold" style="color: #1d1d1f; font-size: 15px;">₹1,29,999</span>
            </div>

            <hr style="border-color: #e5e5e5;">

            {{-- Order Footer --}}
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span style="color: #86868b; font-size: 13px;">Total: </span>
                    <span class="font-weight-bold" style="color: #1d1d1f; font-size: 16px;">₹1,29,999</span>
                    <span class="ml-2" style="color: #86868b; font-size: 13px;">· Cash on Delivery</span>
                </div>
                <a href="/orders/{{ $i }}" class="btn btn-outline-dark btn-sm" style="border-radius: 20px; font-size: 13px; padding: 6px 16px;">
                    View Details
                </a>
            </div>

        </div>
        @endfor

    </div>
</section>

@endsection