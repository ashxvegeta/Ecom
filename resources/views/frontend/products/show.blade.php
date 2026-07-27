@extends('layouts.frontend')

@section('title', 'iPhone 16 Pro - TechZone')

@section('content')

{{-- Breadcrumb --}}
<section style="background: #f5f5f7; padding: 15px 0;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="background: transparent; padding: 0; font-size: 13px;">
                <li class="breadcrumb-item"><a href="/" style="color: #86868b; text-decoration: none;">Home</a></li>
                <li class="breadcrumb-item"><a href="/products" style="color: #86868b; text-decoration: none;">Products</a></li>
                <li class="breadcrumb-item active" style="color: #1d1d1f;">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</section>

{{-- Product Detail --}}
<section style="padding: 60px 0; background: #ffffff;">
    <div class="container">
        <div class="row">

            {{-- Left — Product Images --}}
            <div class="col-md-6 mb-4">
                {{-- Main Image --}}
                <div class="text-center p-5 mb-3" style="background: #f5f5f7; border-radius: 20px;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-1UnazwrGHIYnUVCpVF6oJQrMGyGx9FGYBf3bkFr5ZOl02QbHmDFIMPA&s=1000" alt="iPhone 16 Pro"
                         class="img-fluid" style="border-radius: 12px; max-height: 350px;">
                </div>
                {{-- Thumbnail Images --}}
                <div class="d-flex gap-2 justify-content-center">
                    @foreach($product->productImages as  $image)
                    <div class="p-2" style="background: #f5f5f7; border-radius: 10px; cursor: pointer; border: 2px solid {{ $loop->first  ? '#1d1d1f' : 'transparent' }}; width: 80px; text-align: center;">
                        <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid">
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right — Product Info --}}
            <div class="col-md-6">

                {{-- Brand --}}
                <p style="color: #86868b; font-size: 13px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">{{ $product->brand->name }}</p>

                {{-- Name --}}
                <h1 style="color: #1d1d1f; font-size: 36px; font-weight: 700; letter-spacing: -1px;">{{ $product->name }}</h1>

                {{-- Price --}}
                <div class="my-4">
                    <span style="font-size: 32px; font-weight: 700; color: #1d1d1f;">{{formatPrice($product->productItems->first()->price)}}</span>
                </div>

                {{-- Stock --}}
                <div class="mb-4">
                    <span class="badge badge-success" style="font-size: 13px; padding: 6px 12px; border-radius: 20px;">
                        {{$product->productItems->first()->stock > 0 ? '✓ In Stock':'Out of Stock'}}   
                    </span>
                </div>

                {{-- SKU --}}
                <p style="color: #86868b; font-size: 13px;">{{ $product->productItems->first()->sku }}</p>

                <hr style="border-color: #e5e5e5;">

                {{-- Quantity --}}
                <div class="mb-4">
                    <label style="color: #1d1d1f; font-weight: 600; font-size: 14px;">Quantity</label>
                   <div class="d-flex align-items-center mt-2">
    <button class="btn btn-outline-dark btn-sm qty-minus" 
            style="border-radius: 50%; width: 36px; height: 36px; padding: 0;">−</button>
    
    <input type="number"  readonly
           class="qty-input mx-2" 
           value="1" 
           min="1"
           style="width: 50px; text-align: center; border: 1px solid #e5e5e5; border-radius: 8px; padding: 4px;">
    
    <button class="btn btn-outline-dark btn-sm qty-plus"
            style="border-radius: 50%; width: 36px; height: 36px; padding: 0;">+</button>
</div>
                </div>

                {{-- Buttons --}}
                <div class="mb-4">
                    <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                     <input type="hidden" name="quantity" value="1" class="qty-hidden">
                    <button type="submit"  class="btn btn-dark btn-lg btn-block mb-3" style="border-radius: 25px; font-size: 16px; padding: 14px;">
                        <i class="bi bi-bag"></i> Add to Cart
                    </button>
                  
                    <button class="btn btn-outline-dark btn-lg btn-block" style="border-radius: 25px; font-size: 16px; padding: 14px;">
                        ⚡ Buy Now
                    </button>
                      </form>
                </div>

                <hr style="border-color: #e5e5e5;">

                {{-- Features --}}
                <div class="mt-3">
                    <div class="d-flex align-items-center mb-2">
                        <span style="color: #1d1d1f; font-size: 14px;">🚚 Free delivery on orders above ₹999</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span style="color: #1d1d1f; font-size: 14px;">↩️ 7 day easy returns</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <span style="color: #1d1d1f; font-size: 14px;">🔒 Secure payment</span>
                    </div>
                </div>

            </div>
        </div>

        {{-- Description --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="p-5" style="background: #f5f5f7; border-radius: 20px;">
                    <h4 class="font-weight-bold mb-4" style="color: #1d1d1f;">Product Description</h4>
                    <p style="color: #86868b; font-size: 15px; line-height: 1.8;">
                        {{ $product->description }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Specifications --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="p-5" style="background: #ffffff; border-radius: 20px; border: 1px solid #e5e5e5;">
                    <h4 class="font-weight-bold mb-4" style="color: #1d1d1f;">Specifications</h4>
                    <table class="table" style="font-size: 14px;">
                        <tbody>
                            <tr>
                                <td style="color: #86868b; width: 30%;">Brand</td>
                                <td style="color: #1d1d1f; font-weight: 500;">{{ $product->brand->name }}</td>
                            </tr>
                            <tr>
                                <td style="color: #86868b;">Display</td>
                                <td style="color: #1d1d1f; font-weight: 500;">6.3-inch Super Retina XDR</td>
                            </tr>
                            <tr>
                                <td style="color: #86868b;">Processor</td>
                                <td style="color: #1d1d1f; font-weight: 500;">A18 Pro Chip</td>
                            </tr>
                            <tr>
                                <td style="color: #86868b;">RAM</td>
                                <td style="color: #1d1d1f; font-weight: 500;">8GB</td>
                            </tr>
                            <tr>
                                <td style="color: #86868b;">Storage</td>
                                <td style="color: #1d1d1f; font-weight: 500;">256GB</td>
                            </tr>
                            <tr>
                                <td style="color: #86868b;">Battery</td>
                                <td style="color: #1d1d1f; font-weight: 500;">4685 mAh</td>
                            </tr>
                            <tr>
                                <td style="color: #86868b;">OS</td>
                                <td style="color: #1d1d1f; font-weight: 500;">iOS 18</td>
                            </tr>
                            <tr>
                                <td style="color: #86868b;">Color</td>
                                <td style="color: #1d1d1f; font-weight: 500;">Black Titanium</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        <div class="row mt-5">
            <div class="col-12">
                <h4 class="font-weight-bold mb-4" style="color: #1d1d1f;">Related Products</h4>
                <div class="row">
                    @foreach($related_products as $products)
                     <div class="col-md-3 mb-4">
                <a href="/products/{{$products->slug}}" style="text-decoration:none;">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden;">
                    <div style="background: #f5f5f7; padding: 20px; text-align: center;">
                    @if($products->productImages->isNotEmpty())
                        <img src="{{ asset('storage/' . $products->productImages->first()->image_path) }}"  style="height:150px;width:150px;">
                    @endif
                    </div>
                    <div class="card-body p-4">
                        <p style="color: #86868b; font-size: 12px; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 1px;">{{$products->brand->name}}</p>
                        <h6 class="font-weight-bold" style="color: #1d1d1f; font-size: 16px;">{{$products->name}}</h6>
                        <p class="font-weight-bold mt-2" style="color: #1d1d1f; font-size: 18px;">{{ optional($products->productItems->first())->price?formatPrice($products->productItems->first()->price):'price not available' }}</p>
                        <button class="btn btn-dark btn-block mt-2" style="border-radius: 25px; font-size: 14px;">
                            Add to Cart
                        </button>
                    </div>
                </div>
                </a>
            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
  document.querySelectorAll('.qty-minus').forEach(function(btn) {
    btn.addEventListener('click', function() {
        let input = this.parentElement.querySelector('.qty-input');
        let hidden = document.querySelector('.qty-hidden'); // ← directly dhundho
        if(parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            hidden.value = input.value;
        }
    });
});

document.querySelectorAll('.qty-plus').forEach(function(btn) {
    btn.addEventListener('click', function() {
        let input = this.parentElement.querySelector('.qty-input');
        let hidden = document.querySelector('.qty-hidden'); // ← directly dhundho
        input.value = parseInt(input.value) + 1;
        hidden.value = input.value;
    });
});
</script>
@endsection 
@endsection