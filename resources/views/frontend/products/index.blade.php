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
<section style="padding: 40px 0; background: #ffffff;">
    <div class="container">
        <div class="row">

            {{-- Left Sidebar Filters --}}
            <div class="col-md-3 mb-4">

                {{-- Categories Filter --}}
                <div class="p-4 bg-white shadow-sm mb-4" style="border-radius: 16px;">
                    <h6 class="font-weight-bold mb-3" style="color: #1d1d1f;">Categories</h6>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="cat1">
                        <label class="form-check-label" for="cat1" style="color: #86868b; font-size: 14px;">
                            📱 Mobiles
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="cat2">
                        <label class="form-check-label" for="cat2" style="color: #86868b; font-size: 14px;">
                            💻 Laptops
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="cat3">
                        <label class="form-check-label" for="cat3" style="color: #86868b; font-size: 14px;">
                            🖥️ Monitors
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="cat4">
                        <label class="form-check-label" for="cat4" style="color: #86868b; font-size: 14px;">
                            ⌨️ Keyboards
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="cat5">
                        <label class="form-check-label" for="cat5" style="color: #86868b; font-size: 14px;">
                            🎧 Accessories
                        </label>
                    </div>
                </div>

                {{-- Brands Filter --}}
                <div class="p-4 bg-white shadow-sm mb-4" style="border-radius: 16px;">
                    <h6 class="font-weight-bold mb-3" style="color: #1d1d1f;">Brands</h6>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="brand1">
                        <label class="form-check-label" for="brand1" style="color: #86868b; font-size: 14px;">Apple</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="brand2">
                        <label class="form-check-label" for="brand2" style="color: #86868b; font-size: 14px;">Samsung</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="brand3">
                        <label class="form-check-label" for="brand3" style="color: #86868b; font-size: 14px;">Dell</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="brand4">
                        <label class="form-check-label" for="brand4" style="color: #86868b; font-size: 14px;">HP</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="brand5">
                        <label class="form-check-label" for="brand5" style="color: #86868b; font-size: 14px;">Logitech</label>
                    </div>
                </div>

                {{-- Price Filter --}}
                <div class="p-4 bg-white shadow-sm" style="border-radius: 16px;">
                    <h6 class="font-weight-bold mb-3" style="color: #1d1d1f;">Price Range</h6>
                    <input type="range" class="form-control-range" min="0" max="200000" value="100000">
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
                    <select class="form-control" style="width: auto; font-size: 14px; border-radius: 8px;">
                        <option>Sort by: Featured</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest First</option>
                    </select>
                </div>

                {{-- Products Grid --}}
                <div class="row">
                    @for($i = 1; $i <= 9; $i++)
                    <div class="col-md-4 mb-4">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; overflow: hidden; cursor: pointer;">
                            <div style="background: #f5f5f7; padding: 20px; text-align: center;">
                                <img src="https://via.placeholder.com/200x150/f5f5f7/1d1d1f?text=Product"
                                     class="img-fluid" style="border-radius: 8px;">
                            </div>
                            <div class="card-body p-3">
                                <p style="color: #86868b; font-size: 11px; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 1px;">Apple</p>
                                <h6 class="font-weight-bold" style="color: #1d1d1f; font-size: 15px;">iPhone 16 Pro</h6>
                                <p class="font-weight-bold mt-1" style="color: #1d1d1f; font-size: 16px;">₹1,29,999</p>
                                <button class="btn btn-dark btn-block btn-sm" style="border-radius: 20px; font-size: 13px;">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" style="border-radius: 8px; margin: 0 3px;">Previous</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#" style="border-radius: 8px; margin: 0 3px; background: #1d1d1f; border-color: #1d1d1f;">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" style="border-radius: 8px; margin: 0 3px;">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" style="border-radius: 8px; margin: 0 3px;">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" style="border-radius: 8px; margin: 0 3px;">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection