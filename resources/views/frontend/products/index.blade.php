@extends('layouts.frontend')

@section('title', 'Products - TechZone')

@section('content')

{{-- Page Header --}}
<section style="background: #f5f5f7; padding: 40px 0;">
    <div class="container">
        <h2 class="font-weight-bold" style="color: #1d1d1f; font-size: 32px;">All Products</h2>
        <p style="color: #86868b;">Discover our latest collection of electronics</p>
    </div>
</section>

{{-- Products Section --}}
<form method="GET" action="/products-list" id="filterForm">
<section style="padding: 40px 0; background: #ffffff;">
    <div class="container">
        <div class="row">

            {{-- Left Sidebar Filters --}}
            <div class="col-md-3 mb-4">

                {{-- Categories Filter --}}
                <div class="p-4 bg-white shadow-sm mb-4" style="border-radius: 16px;">
                    <h6 class="font-weight-bold mb-3" style="color: #1d1d1f;">Categories</h6>
                        @foreach($categories as $category)
                        <div class="form-check mb-2">
                            <input class="form-check-input filter-checkbox" 
                                type="checkbox" 
                                name="category_id[]" 
                                value="{{ $category->id }}"
                                {{ in_array($category->id, request('category_id', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" style="color: #86868b; font-size: 14px;">
                                {{ $category->name }}
                            </label>
                        </div>
                        @endforeach
                </div>

                {{-- Brands Filter --}}
                <div class="p-4 bg-white shadow-sm mb-4" style="border-radius: 16px;">
                                <h6 class="font-weight-bold mb-3" style="color: #1d1d1f;">Brands</h6>
                            @foreach($brands as $brand)
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox"  type="checkbox" name="brand_id[]" value="{{ $brand->id }}"
                        {{ in_array($brand->id, request('brand_id', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" style="color: #86868b; font-size: 14px;">
                        {{ $brand->name }}
                    </label>
                </div>
                @endforeach
                </div>

                {{-- Price Filter --}}
                <div class="p-4 bg-white shadow-sm" style="border-radius: 16px;">
                    <h6 class="font-weight-bold mb-3" style="color: #1d1d1f;">Price Range</h6>
                    <input type="range" class="form-control-range" min="0" max="200000" value="{{ request('max_price', 200000) }}" name="max_price"  onchange="document.getElementById('filterForm').submit()">
                    <div class="d-flex justify-content-between mt-2">
                        <span style="color: #86868b; font-size: 13px;">₹0</span>
                        <span style="color: #86868b; font-size: 13px;">₹2,00,000</span>
                    </div>
                </div>

            </div>

            {{-- Right Products Grid --}}
            <div class="col-md-9">

                {{-- Sort Bar --}}
                <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white shadow-sm" style="border-radius: 12px;">
                    <p class="mb-0" style="color: #86868b; font-size: 14px;">Showing <strong>24</strong> products</p>
                <select class="form-control" name="sort"  style="width: auto; font-size: 14px; border-radius: 8px;" onchange="document.getElementById('filterForm').submit()">
                        <!-- <option  value= "">Sort by: Featured</option> -->
                        <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected': ''}}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected': ''}}>Price: High to Low</option>
                        <option value ="newest">Newest First</option>
                </select>
                </div>

                {{-- Products Grid --}}
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden; cursor: pointer;">
                            <div style="background: #f5f5f7; padding: 20px; text-align: center;">
                                @if($product->productImages->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->productImages->first()->image_path) }}"  style="height:150px;width:150px;">
                                @endif
                            </div>
                            <div class="card-body p-3">
                                <p style="color: #86868b; font-size: 11px; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 1px;">
                                    {{$product->brand->name}}
                                </p>
                                <h6 class="font-weight-bold" style="color: #1d1d1f; font-size: 16px;">{{$product->name}}</h6>
                                <p class="font-weight-bold mt-2" style="color: #1d1d1f; font-size: 18px;">{{ optional($product->productItems->first())->price ?? 'N/A' }}</p>
                                <button class="btn btn-dark btn-block btn-sm" style="border-radius: 20px; font-size: 13px;">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
</section>
</form>

<script>
    document.querySelectorAll('.filter-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    });
</script>

@endsection