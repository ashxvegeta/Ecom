@extends('layouts.frontend')

@section('title', 'Checkout - TechZone')

@section('content')

{{-- Page Header --}}
<section style="background: #f5f5f7; padding: 30px 0;">
    <div class="container">
        <h2 class="font-weight-bold" style="color: #1d1d1f; font-size: 32px;">Checkout</h2>
        <p style="color: #86868b;">Complete your order</p>
    </div>
</section>

{{-- Checkout Section --}}
<section style="padding: 40px 0; background: #ffffff;">
    <form action="{{ route('checkout.place-order') }}" method="POST">
        @csrf

        <div class="container">
            <div class="row">

                {{-- Left — Shipping Address --}}
                <div class="col-md-7 mb-4">

                    {{-- Shipping Address --}}
                    <div class="p-4 shadow-sm mb-4" style="border-radius: 16px; background: #ffffff; border: 1px solid #e5e5e5;">
                        <h5 class="font-weight-bold mb-4" style="color: #1d1d1f;">
                            <span class="badge badge-dark mr-2" style="border-radius: 50%; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">1</span>
                            Shipping Address
                        </h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control mt-1" placeholder="John" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control mt-1" placeholder="Doe" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control mt-1" placeholder="john@example.com" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;" required>
                        </div>

                        <div class="mb-3">
                            <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control mt-1" placeholder="+91 98765 43210" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;" required>
                        </div>

                        <div class="mb-3">
                            <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">Address</label>
                            <textarea name="address" class="form-control mt-1" rows="3" placeholder="Enter your full address" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;" required>{{ old('address') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">City</label>
                                <input type="text" name="city" value="{{ old('city') }}" class="form-control mt-1" placeholder="Mumbai" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">State</label>
                                <input type="text" name="state" value="{{ old('state') }}" class="form-control mt-1" placeholder="Maharashtra" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">Pincode</label>
                                <input type="text" name="pincode" value="{{ old('pincode') }}" class="form-control mt-1" placeholder="400001" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;" required>
                            </div>
                        </div>
                    </div>

                    {{-- Payment Method --}}
                    <div class="p-4 shadow-sm" style="border-radius: 16px; background: #ffffff; border: 1px solid #e5e5e5;">
                        <h5 class="font-weight-bold mb-4" style="color: #1d1d1f;">
                            <span class="badge badge-dark mr-2" style="border-radius: 50%; width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center;">2</span>
                            Payment Method
                        </h5>

                        {{-- COD --}}
                        <div class="p-3 mb-3" style="border: 2px solid #1d1d1f; border-radius: 12px; cursor: pointer;">
                            <div class="d-flex align-items-center">
                                <input type="radio" name="payment_method" id="cod" value="cod" checked style="width: 18px; height: 18px;">
                                <label for="cod" class="ml-3 mb-0" style="cursor: pointer;">
                                    <span class="font-weight-bold" style="color: #1d1d1f; font-size: 15px;">💵 Cash on Delivery</span>
                                    <p class="mb-0" style="color: #86868b; font-size: 13px;">Pay when your order arrives</p>
                                </label>
                            </div>
                        </div>

                        {{-- Razorpay --}}
                        <div class="p-3" style="border: 1px solid #e5e5e5; border-radius: 12px; cursor: pointer;">
                            <div class="d-flex align-items-center">
                                <input type="radio" name="payment_method" id="razorpay" value="online" style="width: 18px; height: 18px;">
                                <label for="razorpay" class="ml-3 mb-0" style="cursor: pointer;">
                                    <span class="font-weight-bold" style="color: #1d1d1f; font-size: 15px;">💳 Razorpay</span>
                                    <p class="mb-0" style="color: #86868b; font-size: 13px;">Credit/Debit Card, UPI, Net Banking</p>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Right — Order Summary --}}
                <div class="col-md-5">
                    <div class="p-4 shadow-sm" style="border-radius: 16px; background: #f5f5f7; position: sticky; top: 20px;">
                        <h5 class="font-weight-bold mb-4" style="color: #1d1d1f;">Order Summary</h5>

                        @php $totalprice = 0; @endphp

                        @foreach($checkoutdata as $checkout)
                            <div class="d-flex align-items-center mb-3">
                                <div style="background: #ffffff; border-radius: 8px; padding: 8px; min-width: 60px; text-align: center;">
                                    <img src="{{ asset('storage/' . $checkout['image']) }}" class="img-fluid" style="height:55px; min-width:60px;">
                                </div>
                                <div class="ml-3 flex-grow-1">
                                    <p class="mb-0 font-weight-bold" style="color: #1d1d1f; font-size: 13px;">{{ $checkout['name'] }}</p>
                                    <p class="mb-0" style="color: #86868b; font-size: 12px;">{{ $checkout['brand'] }} × {{ $checkout['quantity'] }}</p>
                                </div>
                                <span style="color: #1d1d1f; font-weight: 600; font-size: 14px;">
                                    {{ formatPrice($checkout['price'] * $checkout['quantity']) }}
                                </span>
                            </div>
                            @php $totalprice += $checkout['price'] * $checkout['quantity']; @endphp
                        @endforeach

                        <hr style="border-color: #e5e5e5;">

                        <div class="d-flex justify-content-between mb-2">
                            <span style="color: #86868b; font-size: 14px;">Subtotal</span>
                            <span style="color: #1d1d1f; font-weight: 500;">{{ formatPrice($totalprice) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span style="color: #86868b; font-size: 14px;">Delivery</span>
                            <span style="color: #34c759; font-weight: 500; font-size: 14px;">FREE</span>
                        </div>

                        <hr style="border-color: #e5e5e5;">

                        <div class="d-flex justify-content-between mb-4">
                            <span style="color: #1d1d1f; font-weight: 700; font-size: 16px;">Total</span>
                            <span style="color: #1d1d1f; font-weight: 700; font-size: 20px;">{{ formatPrice($totalprice) }}</span>
                        </div>

                        {{-- Hidden shipping charge --}}
                        <input type="hidden" name="shipping_charge" value="0">

                        <button type="submit" class="btn btn-dark btn-block btn-lg" style="border-radius: 25px; font-size: 15px; padding: 14px;">
                            Place Order
                        </button>

                        <div class="text-center mt-3">
                            <small style="color: #86868b;">🔒 Secure & Encrypted Payment</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</section>

@endsection