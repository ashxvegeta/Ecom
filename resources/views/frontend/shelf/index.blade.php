@extends('layouts.frontend')

@section('title', 'My Shelf - TechZone')

@section('content')

{{-- Header --}}
<section style="background: #f5f5f7; padding: 15px 0;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="background: transparent; padding: 0; font-size: 13px;">
                <li class="breadcrumb-item"><a href="/" style="color: #86868b; text-decoration: none;">Home</a></li>
                <li class="breadcrumb-item active" style="color: #1d1d1f;">My Shelf</li>
            </ol>
        </nav>
    </div>
</section>

<section style="padding: 60px 0; background: #ffffff; min-height: 60vh;">
    <div class="container">

        <h2 style="color: #1d1d1f; font-weight: 700; margin-bottom: 30px;">
            <i class="bi bi-bookmark-fill"></i> My Shelf
        </h2>

        {{-- AUTH: DB se products --}}
        @auth
            @if($products->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-bookmark" style="font-size: 60px; color: #86868b;"></i>
                    <p class="mt-3" style="color: #86868b; font-size: 16px;">Shelf empty hai! Kuch products save karo.</p>
                    <a href="/products" class="btn btn-dark mt-2" style="border-radius: 25px; padding: 10px 30px;">Browse Products</a>
                </div>
            @else
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-4 mb-4" id="shelf-card-{{ $product->id }}">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden;">
                            <a href="/products/{{ $product->slug }}" style="text-decoration: none;">
                                <div style="background: #f5f5f7; padding: 20px; text-align: center;">
                                    @if($product->productImages->isNotEmpty())
                                        <img src="{{ asset('storage/' . $product->productImages->first()->image_path) }}"
                                             style="height: 150px; width: 150px; object-fit: contain;">
                                    @endif
                                </div>
                                <div class="card-body p-4">
                                    <p style="color: #86868b; font-size: 12px; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 1px;">
                                        {{ $product->brand->name }}
                                    </p>
                                    <h6 class="font-weight-bold" style="color: #1d1d1f; font-size: 16px;">
                                        {{ $product->name }}
                                    </h6>
                                    <p class="font-weight-bold mt-2" style="color: #1d1d1f; font-size: 18px;">
                                        {{ formatPrice($product->productItems->first()->price) }}
                                    </p>
                                </div>
                            </a>
                            <div class="px-4 pb-4">
                                <button class="btn btn-danger btn-block shelf-remove-btn"
                                        data-id="{{ $product->id }}"
                                        style="border-radius: 25px;">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        @endauth

        {{-- GUEST: localStorage se JS fill karega --}}
        @guest
            <div id="guest-shelf-container">
                <div class="text-center py-5">
                    <i class="bi bi-arrow-clockwise" style="font-size: 40px; color: #86868b;"></i>
                    <p class="mt-2" style="color: #86868b;">Loading...</p>
                </div>
            </div>
        @endguest

    </div>
</section>

@endsection

@section('scripts')
<script>

{{-- AUTH: Remove button --}}
@auth
document.querySelectorAll('.shelf-remove-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const productId = this.dataset.id;

        fetch(`/shelf/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(() => {
            document.getElementById(`shelf-card-${productId}`).remove();
            if (window.changeShelfBadge) window.changeShelfBadge(-1);

            // Agar koi card nahi bacha toh empty state dikhao
            const remaining = document.querySelectorAll('[id^="shelf-card-"]');
            if (remaining.length === 0) {
                document.querySelector('.row').innerHTML = `
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-bookmark" style="font-size: 60px; color: #86868b;"></i>
                        <p class="mt-3" style="color: #86868b; font-size: 16px;">Shelf empty ho gayi!</p>
                        <a href="/products" class="btn btn-dark mt-2" style="border-radius: 25px; padding: 10px 30px;">Browse Products</a>
                    </div>`;
            }
        });
    });
});
@endauth

{{-- GUEST: localStorage se products fetch karo --}}
@guest
(function() {
    const ids = JSON.parse(localStorage.getItem('shelf') || '[]');
    const container = document.getElementById('guest-shelf-container');

    if (ids.length === 0) {
        container.innerHTML = `
            <div class="text-center py-5">
                <i class="bi bi-bookmark" style="font-size: 60px; color: #86868b;"></i>
                <p class="mt-3" style="color: #86868b; font-size: 16px;">Shelf empty hai! Kuch products save karo.</p>
                <a href="/products" class="btn btn-dark mt-2" style="border-radius: 25px; padding: 10px 30px;">Browse Products</a>
            </div>`;
        return;
    }

    fetch('/shelf/fetch', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ ids: ids })
    })
    .then(res => res.json())
    .then(products => {
        if (products.length === 0) {
            container.innerHTML = `<p style="color: #86868b;">Koi product nahi mila.</p>`;
            return;
        }

        container.innerHTML = `<div class="row">` + products.map(p => `
            <div class="col-md-4 mb-4" id="shelf-card-${p.id}">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden;">
                    <a href="/products/${p.slug}" style="text-decoration: none;">
                        <div style="background: #f5f5f7; padding: 20px; text-align: center;">
                            ${p.image ? `<img src="/storage/${p.image}" style="height: 150px; width: 150px; object-fit: contain;">` : ''}
                        </div>
                        <div class="card-body p-4">
                            <h6 class="font-weight-bold" style="color: #1d1d1f; font-size: 16px;">${p.name}</h6>
                            <p class="font-weight-bold mt-2" style="color: #1d1d1f; font-size: 18px;">${p.price}</p>
                        </div>
                    </a>
                    <div class="px-4 pb-4">
                        <button class="btn btn-danger btn-block guest-remove-btn"
                                data-id="${p.id}"
                                style="border-radius: 25px;">
                            <i class="bi bi-trash"></i> Remove
                        </button>
                    </div>
                </div>
            </div>
        `).join('') + `</div>`;

        // Guest remove buttons
        document.querySelectorAll('.guest-remove-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const pid = parseInt(this.dataset.id);
                let ids = JSON.parse(localStorage.getItem('shelf') || '[]');
                ids = ids.filter(id => id !== pid);
                localStorage.setItem('shelf', JSON.stringify(ids));
                document.getElementById(`shelf-card-${pid}`).remove();
                if (window.setShelfBadge) window.setShelfBadge(ids.length);
            });
        });
    });
})();
@endguest

</script>
@endsection