@extends('layouts.frontend')

@section('title', 'Home - TechZone Electronics')

@section('content')

{{-- Hero Section --}}
<section style="background: linear-gradient(135deg, #1d1d1f 0%, #2d2d2f 100%); color: white; padding: 100px 0;">
    <div class="container text-center">
        <p style="color: #86868b; font-size: 14px; letter-spacing: 3px; text-transform: uppercase;">New Arrivals 2024</p>
        <h1 style="font-size: 64px; font-weight: 700; letter-spacing: -2px; line-height: 1.1;">Latest Tech.</h1>
        <h1 style="font-size: 64px; font-weight: 700; letter-spacing: -2px; line-height: 1.1; color: #86868b;">Unbeatable Prices.</h1>
        <p style="color: #86868b; font-size: 18px; margin: 25px 0;">Discover the best electronics at TechZone.</p>
        <a href="#" class="btn btn-light btn-lg mr-3" style="border-radius: 25px; padding: 12px 35px; font-size: 15px; font-weight: 500;">Shop Now</a>
        <a href="#" class="btn btn-outline-light btn-lg" style="border-radius: 25px; padding: 12px 35px; font-size: 15px;">Learn More</a>
    </div>
</section>

{{-- Categories Section --}}
<section style="background: #f5f5f7; padding: 70px 0;">
    <div class="container">
        <h2 class="text-center font-weight-bold mb-2" style="color: #1d1d1f; font-size: 32px;">Shop by Category</h2>
        <p class="text-center mb-5" style="color: #86868b; font-size: 16px;">Find exactly what you're looking for</p>
        <div class="row justify-content-center">

            <div class="col-md-2 col-4 text-center mb-4">
                <div class="p-4 bg-white shadow-sm" style="border-radius: 20px; cursor: pointer; transition: transform 0.2s;">
                    <div style="font-size: 40px;">📱</div>
                    <p class="mt-2 mb-0" style="font-size: 13px; color: #1d1d1f; font-weight: 600;">Mobiles</p>
                </div>
            </div>

            <div class="col-md-2 col-4 text-center mb-4">
                <div class="p-4 bg-white shadow-sm" style="border-radius: 20px; cursor: pointer;">
                    <div style="font-size: 40px;">💻</div>
                    <p class="mt-2 mb-0" style="font-size: 13px; color: #1d1d1f; font-weight: 600;">Laptops</p>
                </div>
            </div>

            <div class="col-md-2 col-4 text-center mb-4">
                <div class="p-4 bg-white shadow-sm" style="border-radius: 20px; cursor: pointer;">
                    <div style="font-size: 40px;">🖥️</div>
                    <p class="mt-2 mb-0" style="font-size: 13px; color: #1d1d1f; font-weight: 600;">Monitors</p>
                </div>
            </div>

            <div class="col-md-2 col-4 text-center mb-4">
                <div class="p-4 bg-white shadow-sm" style="border-radius: 20px; cursor: pointer;">
                    <div style="font-size: 40px;">⌨️</div>
                    <p class="mt-2 mb-0" style="font-size: 13px; color: #1d1d1f; font-weight: 600;">Keyboards</p>
                </div>
            </div>

            <div class="col-md-2 col-4 text-center mb-4">
                <div class="p-4 bg-white shadow-sm" style="border-radius: 20px; cursor: pointer;">
                    <div style="font-size: 40px;">🎧</div>
                    <p class="mt-2 mb-0" style="font-size: 13px; color: #1d1d1f; font-weight: 600;">Accessories</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Featured Products --}}
<section style="padding: 70px 0; background: #ffffff;">
    <div class="container">
        <h2 class="text-center font-weight-bold mb-2" style="color: #1d1d1f; font-size: 32px;">Featured Products</h2>
        <p class="text-center mb-5" style="color: #86868b; font-size: 16px;">Handpicked for you</p>
        <div class="row">

            @for($i = 1; $i <= 4; $i++)
            <div class="col-md-3 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden;">
                    <div style="background: #f5f5f7; padding: 20px; text-align: center;">
                        <img src="https://via.placeholder.com/250x180/f5f5f7/1d1d1f?text=Product" 
                             class="img-fluid" style="border-radius: 12px;">
                    </div>
                    <div class="card-body p-4">
                        <p style="color: #86868b; font-size: 12px; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 1px;">Apple</p>
                        <h6 class="font-weight-bold" style="color: #1d1d1f; font-size: 16px;">iPhone 16 Pro</h6>
                        <p class="font-weight-bold mt-2" style="color: #1d1d1f; font-size: 18px;">₹1,29,999</p>
                        <button class="btn btn-dark btn-block mt-2" style="border-radius: 25px; font-size: 14px;">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
            @endfor

        </div>
        <div class="text-center mt-4">
            <a href="/products" class="btn btn-dark btn-lg" style="border-radius: 25px; padding: 12px 45px;">
                View All Products
            </a>
        </div>
    </div>
</section>

{{-- Why TechZone --}}
<section style="background: #f5f5f7; padding: 70px 0;">
    <div class="container">
        <h2 class="text-center font-weight-bold mb-2" style="color: #1d1d1f; font-size: 32px;">Why TechZone?</h2>
        <p class="text-center mb-5" style="color: #86868b; font-size: 16px;">We make tech shopping easy</p>
        <div class="row text-center">

            <div class="col-md-3 mb-4">
                <div class="p-4 bg-white shadow-sm" style="border-radius: 20px;">
                    <div style="font-size: 40px;">🚚</div>
                    <h6 class="font-weight-bold mt-3" style="color: #1d1d1f;">Free Delivery</h6>
                    <p style="color: #86868b; font-size: 14px; margin: 0;">On orders above ₹999</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="p-4 bg-white shadow-sm" style="border-radius: 20px;">
                    <div style="font-size: 40px;">🔒</div>
                    <h6 class="font-weight-bold mt-3" style="color: #1d1d1f;">Secure Payment</h6>
                    <p style="color: #86868b; font-size: 14px; margin: 0;">100% secure transactions</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="p-4 bg-white shadow-sm" style="border-radius: 20px;">
                    <div style="font-size: 40px;">↩️</div>
                    <h6 class="font-weight-bold mt-3" style="color: #1d1d1f;">Easy Returns</h6>
                    <p style="color: #86868b; font-size: 14px; margin: 0;">7 day return policy</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="p-4 bg-white shadow-sm" style="border-radius: 20px;">
                    <div style="font-size: 40px;">🎧</div>
                    <h6 class="font-weight-bold mt-3" style="color: #1d1d1f;">24/7 Support</h6>
                    <p style="color: #86868b; font-size: 14px; margin: 0;">Always here to help</p>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection