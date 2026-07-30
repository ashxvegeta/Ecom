@extends('layouts.frontend')

@section('title', 'Cart - TechZone')

@section('content')

{{-- Page Header --}}
<section style="background: #f5f5f7; padding: 30px 0;">
    <div class="container">
        <h2 class="font-weight-bold" style="color: #1d1d1f; font-size: 32px;">Your Cart</h2>
        <p style="color: #86868b;">{{collect($cart)->sum('quantity')}} items in your cart</p>
    </div>
</section>

{{-- Cart Section --}}
<section style="padding: 40px 0; background: #ffffff;">
    <div class="container">
        <div class="row">

            {{-- Left — Cart Items --}}
            <div class="col-md-8 mb-4">
                {{-- Cart Item 1 --}}
                @php
                $totalprice = 0;
                @endphp

                @if(empty($cart))
                {{-- Empty message --}}
                <div class="text-center py-5">
                    <div style="font-size: 60px;">🛒</div>
                    <h4 class="mt-3" style="color: #1d1d1f;">Your cart is empty</h4>
                    <p style="color: #86868b;">Add some products to get started</p>
                    <a href="/" class="btn btn-dark mt-3" style="border-radius: 25px; padding: 10px 30px;">
                        Shop Now
                    </a>
                </div>   
                @else
                @foreach($cart as $productId=>$cartdata)
                <div class="d-flex align-items-center p-4 mb-3 bg-white shadow-sm" style="border-radius: 16px;">

                    {{-- Product Image --}}
                    <div style="background: #f5f5f7; border-radius: 12px; padding: 15px; min-width: 100px; text-align: center;">
                        <img src="{{ asset('storage/' . $cartdata['image']) }}" class="img-fluid" style="height:80px;">
                    </div>

                    {{-- Product Info --}}
                    <div class="ml-4 flex-grow-1">
                        <p style="color: #86868b; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">{{$cartdata['brand']}}</p>
                        <h6 class="font-weight-bold" style="color: #1d1d1f; font-size: 16px;">{{$cartdata['name']}}</h6>
                        <!-- <p style="color: #86868b; font-size: 13px; margin-bottom: 0;">SKU: IPH-16-PRO-BLK</p> -->
                    </div>

                    {{-- Quantity --}}
                    <div class="d-flex align-items-center mx-4">
                    <form method="POST" action="{{ route('cart.update') }}" class="qty-form">
                        @csrf
                    <input type="hidden" name="product_id" value="{{ $productId }}">

                     <input type="hidden" name="quantity" class="qty-hidden" value="{{ $cartdata['quantity'] }}">

                    <button class="btn btn-outline-dark btn-sm qty-minus" style="border-radius: 50%; width: 30px; height: 30px; padding: 0;">−</button>

                        <span class="mx-3 font-weight-bold">{{$cartdata['quantity']}}</span>
                        
                        
                        <button class="btn btn-outline-dark btn-sm qty-plus" style="border-radius: 50%; width: 30px; height: 30px; padding: 0;">+</button>
                    </div>
                    </form>



                    {{-- Price --}}
                    <div class="text-right" style="min-width: 100px;">
                       
                    <p class="font-weight-bold mb-1" style="color: #1d1d1f; font-size: 16px;">{{ formatPrice($cartdata['price']*$cartdata['quantity'])}}</p>
                    <form method="POST" action="{{route('cart.remove',$productId)}}" >
                    @csrf
                    <button type="submit" style="color: #ff3b30; background: none; border: none; font-size: 13px;">
                       <i class="bi bi-trash"></i> Remove
                    </button>
                    </form>
                    </div>

                </div>
                @php
                $totalprice +=  $cartdata['price']*$cartdata['quantity'];
                @endphp
                @endforeach
                @endif
             

                {{-- Continue Shopping --}}
                @if(!empty($cart))
                <div class="mt-3">
                    <a href="/" style="color: #1d1d1f; font-size: 14px; text-decoration: none;">
                        ← Continue Shopping
                    </a>
                </div>
                @endif

            </div>
            @if(!empty($cart))
            {{-- Right — Order Summary --}}
            <div class="col-md-4">
                <div class="p-4 shadow-sm" style="border-radius: 16px; background: #f5f5f7; position: sticky; top: 20px;">
                    <h5 class="font-weight-bold mb-4" style="color: #1d1d1f;">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-3">
                        <span style="color: #86868b; font-size: 14px;">Subtotal ({{collect($cart)->sum('quantity')}}  items)</span>
                        <span style="color: #1d1d1f; font-weight: 500;">{{ formatPrice($totalprice)}}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span style="color: #86868b; font-size: 14px;">Delivery</span>
                        <span style="color: #34c759; font-weight: 500; font-size: 14px;">FREE</span>
                    </div>

                    <hr style="border-color: #e5e5e5;">

                    <div class="d-flex justify-content-between mb-4">
                        <span style="color: #1d1d1f; font-weight: 700; font-size: 16px;">Total</span>
                        <span style="color: #1d1d1f; font-weight: 700; font-size: 18px;">{{ formatPrice($totalprice)}}</span>
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
            @endif

        </div>
    </div>
</section>


@endsection


@section('scripts')
<script>
    // jQuery
    $(document).on('click', '.qty-minus', function() {
        let form = $(this).closest('.qty-form');
        let hidden = form.find('.qty-hidden');
        let display = form.find('.qty-display');
        if(parseInt(hidden.val()) > 1) {
            hidden.val(parseInt(hidden.val()) - 1);
            display.text(hidden.val());
            form.submit();
        }
    });

    // Plus button
    $(document).on('click', '.qty-plus', function() {
        let form = $(this).closest('.qty-form');
        let hidden = form.find('.qty-hidden');
        let display = form.find('.qty-display');
        hidden.val(parseInt(hidden.val()) + 1);
        display.text(hidden.val());
        form.submit();
    });
</script>
@endsection  