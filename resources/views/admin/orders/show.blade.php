@extends('layouts.admin')

@section('title', 'Order Detail')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="font-weight-bold mb-1" style="color: #1d1d1f;">{{ $order->order_number }}</h5>
        <p style="color: #86868b; font-size: 13px; margin: 0;">{{ $order->created_at->format('d M Y, h:i A') }}</p>
    </div>
    <div class="d-flex align-items-center">
        @if($order->order_status === \App\Enums\OrderStatus::CANCELLED)
                       <span class="badge badge-danger" style="border-radius: 20px; padding: 8px 16px; font-size: 14px;">
                ✕ Cancelled
            </span>

        @else
        {{-- Status Update Form --}}
        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="d-flex align-items-center">
            @csrf
            @method('PATCH')
            <select name="order_status" class="form-control mr-2" style="border-radius: 8px; font-size: 14px; width: auto;">
                @foreach(App\Enums\OrderStatus::cases() as $status)
                    <option value="{{ $status->value }}" {{ $order->order_status == $status ? 'selected' : '' }}>
                        {{ $status->label() }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-dark" style="border-radius: 8px;">
                Update Status
            </button>
        </form>
        @endif
        
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-dark ml-2" style="border-radius: 8px;">
            ← Back
        </a>
    </div>
</div>
@if($order->order_status === \App\Enums\OrderStatus::CANCELLED)
    <div class="alert alert-danger mb-4 d-flex align-items-center" style="border-radius: 12px; background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 16px 20px;">
        <span style="font-size: 24px; margin-right: 15px;">⚠️</span>
        <div>
            <h6 class="font-weight-bold mb-1" style="color: #991b1b;">Order Cancelled by Customer</h6>
            <p class="mb-0" style="font-size: 13px; color: #7f1d1d;">
                This order was cancelled on {{ $order->updated_at->format('d M Y, h:i A') }}. <strong>Do not pack or dispatch this order.</strong>
                @if($order->payment_method->value === 'razorpay' && $order->payment_status->value === 'paid')
                    <br><span class="badge badge-warning text-dark mt-1 font-weight-bold">Refund Needed</span> Paid online via Razorpay. Please initiate refund in your Razorpay dashboard.
                @endif
            </p>
        </div>
    </div>
@endif
<div class="row">

    {{-- Left — Order Items --}}
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="font-weight-bold mb-4" style="color: #1d1d1f;">Order Items</h6>
                <table class="table">
                    <thead>
                        <tr style="color: #86868b; font-size: 13px;">
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr style="font-size: 14px;">
                            <td class="font-weight-bold">{{ $item->product_name }}</td>
                            <td>{{ formatPrice($item->price) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="font-weight-bold">{{ formatPrice($item->total) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Payment Summary --}}
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="font-weight-bold mb-4" style="color: #1d1d1f;">Payment Summary</h6>
                <div class="d-flex justify-content-between mb-2">
                    <span style="color: #86868b;">Subtotal</span>
                    <span>{{ formatPrice($order->subtotal) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span style="color: #86868b;">Shipping</span>
                    <span style="color: #34c759;">{{ $order->shipping_charge > 0 ? formatPrice($order->shipping_charge) : 'FREE' }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span class="font-weight-bold">Total</span>
                    <span class="font-weight-bold">{{ formatPrice($order->grand_total) }}</span>
                </div>
                <div class="mt-3">
                    <span style="color: #86868b; font-size: 13px;">Payment Method: </span>
                    <span class="font-weight-bold">{{ strtoupper($order->payment_method->label()) }}</span>
                </div>
                <div class="mt-2">
                    <span style="color: #86868b; font-size: 13px;">Payment Status: </span>
                    <span class="badge badge-{{ $order->payment_status->color() }}" style="border-radius: 20px;">
                        {{ $order->payment_status->label() }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right — Customer Info --}}
    <div class="col-md-4">

        {{-- Customer --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="font-weight-bold mb-3" style="color: #1d1d1f;">Customer Info</h6>
                <p class="mb-1 font-weight-bold">{{ $order->user->name }}</p>
                <p class="mb-1" style="color: #86868b; font-size: 13px;">{{ $order->email }}</p>
                <p class="mb-0" style="color: #86868b; font-size: 13px;">{{ $order->phone }}</p>
            </div>
        </div>

        {{-- Shipping Address --}}
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="font-weight-bold mb-3" style="color: #1d1d1f;">Shipping Address</h6>
                <p class="mb-1 font-weight-bold">{{ $order->first_name }} {{ $order->last_name }}</p>
                <p class="mb-1" style="color: #86868b; font-size: 13px;">{{ $order->address }}</p>
                <p class="mb-1" style="color: #86868b; font-size: 13px;">{{ $order->city }}, {{ $order->state }}</p>
                <p class="mb-0" style="color: #86868b; font-size: 13px;">{{ $order->pincode }}</p>
            </div>
        </div>

        {{-- Order Status --}}
        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-body p-4">
                <h6 class="font-weight-bold mb-3" style="color: #1d1d1f;">Order Status</h6>
                <span class="badge badge-{{ $order->order_status->color() }}" style="border-radius: 20px; padding: 8px 16px; font-size: 14px;">
                    {{ $order->order_status->label() }}
                </span>
            </div>
        </div>

    </div>
</div>

@endsection