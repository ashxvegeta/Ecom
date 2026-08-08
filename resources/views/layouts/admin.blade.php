<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechZone Admin - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f5f5f7; }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #1d1d1f;
            position: fixed;
            top: 0;
            left: 0;
        }
        .sidebar .brand {
            padding: 20px;
            border-bottom: 1px solid #333;
        }
        .sidebar .nav-link {
            color: #86868b;
            padding: 12px 20px;
            font-size: 14px;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #ffffff;
            background: #2d2d2f;
        }
        .sidebar .nav-link i {
            margin-right: 8px;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .topbar {
            background: #ffffff;
            padding: 15px 30px;
            margin-left: 250px;
            border-bottom: 1px solid #e5e5e5;
            position: fixed;
            top: 0;
            right: 0;
            left: 250px;
            z-index: 100;
        }
        .main-content {
            margin-left: 250px;
            margin-top: 60px;
            padding: 30px;
        }
    </style>
    @yield('styles')
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <div class="brand">
            <a href="/" style="color: #ffffff; text-decoration: none; font-size: 18px; font-weight: 700;">
                ⚡ TechZone
            </a>
            <p style="color: #86868b; font-size: 12px; margin: 5px 0 0;">Admin Panel</p>
        </div>

        <nav class="mt-3">
            <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="/admin/orders" class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <i class="bi bi-bag-check"></i> Orders
            </a>
            <a href="/admin/products" class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                <i class="bi bi-box"></i> Products
            </a>
            <a href="/admin/brands" class="nav-link {{ request()->is('admin/brands*') ? 'active' : '' }}">
                <i class="bi bi-tag"></i> Brands
            </a>
            <a href="/admin/categories" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Categories
            </a>
            <hr style="border-color: #333; margin: 10px 20px;">
            <a href="/" class="nav-link">
                <i class="bi bi-house"></i> View Store
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-left w-100" style="color: #86868b;">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </nav>
    </div>

    {{-- Topbar --}}
    <div class="topbar d-flex justify-content-between align-items-center">
        <h6 class="mb-0 font-weight-bold" style="color: #1d1d1f;">@yield('title', 'Dashboard')</h6>
        <div>
            <span style="color: #86868b; font-size: 14px;">
                <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
            </span>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>