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
                <li class="breadcrumb-item active" style="color: #1d1d1f;">iPhone 16 Pro</li>
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
                    @for($i = 1; $i <= 3; $i++)
                    <div class="p-2" style="background: #f5f5f7; border-radius: 10px; cursor: pointer; border: 2px solid {{ $i == 1 ? '#1d1d1f' : 'transparent' }}; width: 80px; text-align: center;">
                        <img src="https://via.placeholder.com/60x50/f5f5f7/1d1d1f?text=img" class="img-fluid">
                    </div>
                    @endfor
                </div>
            </div>

            {{-- Right — Product Info --}}
            <div class="col-md-6">

                {{-- Brand --}}
                <p style="color: #86868b; font-size: 13px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">Apple</p>

                {{-- Name --}}
                <h1 style="color: #1d1d1f; font-size: 36px; font-weight: 700; letter-spacing: -1px;">iPhone 16 Pro</h1>

                {{-- Price --}}
                <div class="my-4">
                    <span style="font-size: 32px; font-weight: 700; color: #1d1d1f;">₹1,29,999</span>
                </div>

                {{-- Stock --}}
                <div class="mb-4">
                    <span class="badge badge-success" style="font-size: 13px; padding: 6px 12px; border-radius: 20px;">
                        ✓ In Stock
                    </span>
                </div>

                {{-- SKU --}}
                <p style="color: #86868b; font-size: 13px;">SKU: IPH-16-PRO-BLK</p>

                <hr style="border-color: #e5e5e5;">

                {{-- Quantity --}}
                <div class="mb-4">
                    <label style="color: #1d1d1f; font-weight: 600; font-size: 14px;">Quantity</label>
                    <div class="d-flex align-items-center mt-2">
                        <button class="btn btn-outline-dark" style="border-radius: 50%; width: 36px; height: 36px; padding: 0;">−</button>
                        <span class="mx-3 font-weight-bold" style="font-size: 18px;">1</span>
                        <button class="btn btn-outline-dark" style="border-radius: 50%; width: 36px; height: 36px; padding: 0;">+</button>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="mb-4">
                    <button class="btn btn-dark btn-lg btn-block mb-3" style="border-radius: 25px; font-size: 16px; padding: 14px;">
                        <i class="bi bi-bag"></i> Add to Cart
                    </button>
                    <button class="btn btn-outline-dark btn-lg btn-block" style="border-radius: 25px; font-size: 16px; padding: 14px;">
                        ⚡ Buy Now
                    </button>
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
                        The iPhone 16 Pro features a stunning 6.3-inch Super Retina XDR display with ProMotion technology.
                        Powered by the A18 Pro chip, it delivers exceptional performance for all your tasks.
                        With the advanced camera system, capture stunning photos and videos in any condition.
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
                                <td style="color: #1d1d1f; font-weight: 500;">Apple</td>
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
                    @for($i = 1; $i <= 4; $i++)
                    <div class="col-md-3 mb-4">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden; cursor: pointer;">
                            <div style="background: #f5f5f7; padding: 20px; text-align: center;">
                                <img src="https://via.placeholder.com/200x150/f5f5f7/1d1d1f?text=Product"
                                    class="img-fluid" style="border-radius: 8px;">
                            </div>
                            <div class="card-body p-3">
                                <p style="color: #86868b; font-size: 11px; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 1px;">Apple</p>
                                <h6 class="font-weight-bold" style="color: #1d1d1f; font-size: 15px;">iPhone 15 Pro</h6>
                                <p class="font-weight-bold mt-1" style="color: #1d1d1f; font-size: 16px;">₹99,999</p>
                                <button class="btn btn-dark btn-block btn-sm" style="border-radius: 20px; font-size: 13px;">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
@endsection