<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000000;">
    <div class="container">

        <a class="navbar-brand font-weight-bold" href="#" style="font-size: 20px; letter-spacing: 1px;">
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

            <ul class="navbar-nav ml-auto">
                <form method="GET" action="/products-list" class="mr-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}" style="border-radius: 20px 0 0 20px; background: #2d2d2f; border: none; color: white; font-size: 13px; width: 220px;height: 32px;margin-top: 2px;">
            <div class="input-group-append">
                <button class="btn btn-light btn-sm" type="submit" style="border-radius: 0 20px 20px 0;">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </form>x
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #f5f5f7;">
                        <i class="bi bi-bag"></i>
                        <span class="badge badge-light" style="font-size: 10px;">0</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" style="color: #f5f5f7; font-size: 14px;">
                        <i class="bi bi-person"></i> Login
                    </a>
                </li>
            </ul>

            

        </div>
    </div>
</nav>

