<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000000;">
    <div class="container">

        <a class="navbar-brand font-weight-bold" href="/" style="font-size: 20px; letter-spacing: 1px;">
            ⚡ TechZone
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/" style="color: #f5f5f7; font-size: 14px;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/products-list" style="color: #f5f5f7; font-size: 14px;">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/mobiles" style="color: #f5f5f7; font-size: 14px;">Mobiles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/laptops" style="color: #f5f5f7; font-size: 14px;">Laptops</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/accessories" style="color: #f5f5f7; font-size: 14px;">Accessories</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto align-items-center">

                <form method="GET" action="/products-list" class="mr-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}" style="border-radius: 20px 0 0 20px; background: #2d2d2f; border: none; color: white; font-size: 13px; width: 220px; height: 32px; margin-top: 2px;">
                        <div class="input-group-append">
                            <button class="btn btn-light btn-sm" type="submit" style="border-radius: 0 20px 20px 0;">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Cart --}}
                <li class="nav-item">
                    <a class="nav-link" href="/cart" style="color: #f5f5f7;">
                        <i class="bi bi-bag"></i>
                        @php
                            if (auth()->check()) {
                                $cartcount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                            } else {
                                $cartItems = session()->get('cart', []);
                                $cartcount = collect($cartItems)->sum('quantity');
                            }
                        @endphp
                        @if($cartcount > 0)
                        <span class="badge badge-light" style="font-size: 10px;">{{ $cartcount }}</span>
                        @endif
                    </a>
                </li>

                @auth
                {{-- Bell Notification --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" data-toggle="dropdown" style="color: #f5f5f7;">
                        <i class="bi bi-bell"></i>
                        <span id="nav-notification-badge" class="badge badge-danger {{ auth()->user()->unreadNotifications->count() > 0 ? '' : 'd-none' }}" style="font-size: 10px;">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="width: 300px;">
                        <h6 class="dropdown-header">Notifications</h6>
                        @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                            <a class="dropdown-item" href="{{ route('notifications.read', $notification->id) }}">
                                <div class="d-flex align-items-start">
                                    <span style="width: 8px; height: 8px; background: #007bff; border-radius: 50%; margin-top: 5px; margin-right: 8px; flex-shrink: 0;"></span>
                                    <div>
                                        <p class="mb-0" style="font-size: 13px; white-space: normal; word-wrap: break-word;">
                                            {{ $notification->data['message'] ?? 'New notification' }}
                                        </p>
                                        <small style="color: #86868b;">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="dropdown-item mb-0" style="color: #86868b; font-size: 13px;">No unread notifications</p>
                        @endforelse
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-center" href="/notifications" style="font-size: 13px;">
                            View all notifications →
                        </a>
                    </div>
                </li>

                {{-- User Dropdown --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" style="color: #f5f5f7; font-size: 14px;">
                        <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="/orders">My Orders</a>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </div>
                </li>

                @else

                {{-- Guest --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login') ? 'active font-weight-bold text-white' : '' }}" href="{{ route('login') }}" style="color: #f5f5f7; font-size: 14px;">
                        <i class="bi bi-person"></i> Login
                    </a>
                </li>
                <li class="nav-item ml-lg-2 mt-2 mt-lg-0">
                    <a class="btn btn-sm px-3" href="{{ route('register') }}" style="border-radius: 20px; font-size: 13px; font-weight: 600; color: #000000; background-color: #ffffff; border: 1px solid #ffffff; transition: all 0.2s;">
                        Register
                    </a>
                </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

@auth
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function refreshNotificationBadge() {
            fetch('{{ route('notifications.unreadCount') }}')
                .then(function(res) {
                    if (res.ok) return res.json();
                    throw new Error('Network error');
                })
                .then(function(data) {
                    var badge = document.getElementById('nav-notification-badge');
                    if (badge && typeof data.count !== 'undefined') {
                        if (data.count > 0) {
                            badge.textContent = data.count;
                            badge.classList.remove('d-none');
                        } else {
                            badge.classList.add('d-none');
                        }
                    }
                })
                .catch(function(err) {});
        }

        // Check for new notifications every 10 seconds in the background
        setInterval(refreshNotificationBadge, 10000);
    });
</script>
@endauth
