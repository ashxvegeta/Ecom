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
                            <input type="text" class="form-control mt-1" placeholder="John" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">Last Name</label>
                            <input type="text" class="form-control mt-1" placeholder="Doe" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">Email</label>
                        <input type="email" class="form-control mt-1" placeholder="john@example.com" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;">
                    </div>

                    <div class="mb-3">
                        <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">Phone</label>
                        <input type="tel" class="form-control mt-1" placeholder="+91 98765 43210" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;">
                    </div>

                    <div class="mb-3">
                        <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">Address</label>
                        <textarea class="form-control mt-1" rows="3" placeholder="Enter your full address" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">City</label>
                            <input type="text" class="form-control mt-1" placeholder="Mumbai" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">State</label>
                            <input type="text" class="form-control mt-1" placeholder="Maharashtra" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label style="color: #1d1d1f; font-size: 13px; font-weight: 600;">Pincode</label>
                            <input type="text" class="form-control mt-1" placeholder="400001" style="border-radius: 10px; border: 1px solid #e5e5e5; font-size: 14px;">
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
                            <input type="radio" name="payment" id="cod" checked style="width: 18px; height: 18px;">
                            <label for="cod" class="ml-3 mb-0" style="cursor: pointer;">
                                <span class="font-weight-bold" style="color: #1d1d1f; font-size: 15px;">💵 Cash on Delivery</span>
                                <p class="mb-0" style="color: #86868b; font-size: 13px;">Pay when your order arrives</p>
                            </label>
                        </div>
                    </div>

                    {{-- Razorpay --}}
                    <div class="p-3" style="border: 1px solid #e5e5e5; border-radius: 12px; cursor: pointer;">
                        <div class="d-flex align-items-center">
                            <input type="radio" name="payment" id="razorpay" style="width: 18px; height: 18px;">
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

                    {{-- Items --}}
                    @for($i = 1; $i <= 3; $i++)
                    <div class="d-flex align-items-center mb-3">
                        <div style="background: #ffffff; border-radius: 8px; padding: 8px; min-width: 60px; text-align: center;">
                            <img src="https://via.placeholder.com/45x40/f5f5f7/1d1d1f?text=P" class="img-fluid">
                        </div>
                        <div class="ml-3 flex-grow-1">
                            <p class="mb-0 font-weight-bold" style="color: #1d1d1f; font-size: 13px;">iPhone 16 Pro</p>
                            <p class="mb-0" style="color: #86868b; font-size: 12px;">Qty: 1</p>
                        </div>
                        <span style="color: #1d1d1f; font-weight: 600; font-size: 14px;">₹1,29,999</span>
                    </div>
                    @endfor

                    <hr style="border-color: #e5e5e5;">

                    <div class="d-flex justify-content-between mb-2">
                        <span style="color: #86868b; font-size: 14px;">Subtotal</span>
                        <span style="color: #1d1d1f; font-weight: 500;">₹3,89,997</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span style="color: #86868b; font-size: 14px;">Delivery</span>
                        <span style="color: #34c759; font-weight: 500; font-size: 14px;">FREE</span>
                    </div>

                    <hr style="border-color: #e5e5e5;">

                    <div class="d-flex justify-content-between mb-4">
                        <span style="color: #1d1d1f; font-weight: 700; font-size: 16px;">Total</span>
                        <span style="color: #1d1d1f; font-weight: 700; font-size: 20px;">₹3,89,997</span>
                    </div>

                    <button class="btn btn-dark btn-block btn-lg" style="border-radius: 25px; font-size: 15px; padding: 14px;">
                        Place Order
                    </button>

                    <div class="text-center mt-3">
                        <small style="color: #86868b;">🔒 Secure & Encrypted Payment</small>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection